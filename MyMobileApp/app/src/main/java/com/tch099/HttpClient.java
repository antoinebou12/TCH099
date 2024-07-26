package com.tch099;

import androidx.annotation.NonNull;
import okhttp3.Cookie;
import okhttp3.CookieJar;
import okhttp3.HttpUrl;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.RequestBody;
import okhttp3.Callback;

import java.net.CookieManager;
import java.net.CookiePolicy;
import java.util.ArrayList;
import java.util.List;
import java.util.concurrent.locks.Lock;
import java.util.concurrent.locks.ReentrantLock;

// Singleton
public class HttpClient {
    private static OkHttpClient client;
    private static final CookieManager cookieManager = new CookieManager();
    private static final Lock lock = new ReentrantLock();

    static {
        cookieManager.setCookiePolicy(CookiePolicy.ACCEPT_ALL);
    }

    public static OkHttpClient getInstance() {
        if (client == null) {
            lock.lock();
            try {
                if (client == null) {
                    client = new OkHttpClient.Builder()
                            .cookieJar(new CookieJar() {
                                @Override
                                public void saveFromResponse(@NonNull HttpUrl httpUrl, @NonNull List<Cookie> cookies) {
                                    for (Cookie cookie : cookies) {
                                        cookieManager.getCookieStore().add(httpUrl.uri(), new java.net.HttpCookie(cookie.name(), cookie.value()));
                                    }
                                }

                                @NonNull
                                @Override
                                public List<Cookie> loadForRequest(@NonNull HttpUrl httpUrl) {
                                    List<Cookie> cookies = new ArrayList<>();
                                    for (java.net.HttpCookie httpCookie : cookieManager.getCookieStore().get(httpUrl.uri())) {
                                        cookies.add(Cookie.parse(httpUrl, httpCookie.toString()));
                                    }
                                    return cookies;
                                }
                            })
                            .build();
                }
            } finally {
                lock.unlock();
            }
        }
        return client;
    }

    public static void execute(Request request, Callback callback) {
        getInstance().newCall(request).enqueue(callback);
    }

    public static Request Post(String url, RequestBody formBody) {
        return new Request.Builder()
                .url(url)
                .post(formBody)
                .build();
    }

    public static Request Get(String url) {
        return new Request.Builder()
                .url(url)
                .get()
                .build();
    }
}
