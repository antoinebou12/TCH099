# MyMobileApp
![badge](https://img.shields.io/badge/development-tips-brightgreen)

MyMobileApp est une application Android qui fournit des fonctionnalités de connexion, d'inscription et de détails utilisateur en utilisant OkHttp pour les requêtes réseau. L'application inclut des notifications pour les événements de connexion et d'inscription.

## Commencer

Ces instructions vous aideront à configurer et à exécuter le projet sur votre machine locale pour le développement et les tests.

Sources utiles:
- [Material Design 3](https://m3.material.io/)
- [Emulator Networking](https://developer.android.com/studio/run/emulator-networking)
- [Jetpack Compose](https://developer.android.com/develop/ui/compose/tooling/iterative-development)

### Prérequis

- Android Studio
- Java 8
- Android SDK
- OkHttp

### Installation

1. Ouvrez le projet dans Android Studio.

2. Configurez les URL de l'API dans `build.gradle` :

   ```groovy
   buildConfigField("String", "API_BASE_URL", "\"https://10.0.2.2:8001/\"")
   buildConfigField("String", "LOGIN_API_URL", "\"https://10.0.2.2:8001/api/login\"")
   buildConfigField("String", "SIGNUP_API_URL", "\"https://10.0.2.2:8001/api/signup\"")
   buildConfigField("String", "USER_DETAILS_API_URL", "\"https://10.0.2.2:8001/api/user-details\"")
   ```

### Fichiers de mise en page

Définir les éléments UI pour les activités :

- `activity_login.xml`

![image](https://github.com/user-attachments/assets/4b6d350d-e930-46c3-aaff-2dc96b880af3)

- `activity_signup.xml`

![image](https://github.com/user-attachments/assets/cfbe07d8-378d-47c8-8a87-5bdf17b3c0fb)

- `activity_user_details.xml`

- `activity_main.xml`

![image](https://github.com/user-attachments/assets/bb7d550e-a64e-428b-8e7f-6cb44315d42a)

Ajouter des images et des icônes

![image](https://github.com/user-attachments/assets/383c353c-5ff0-4130-9371-a12f0576d306)

### AndroidManifest.xml

#### Permissions

```xml
<uses-permission android:name="android.permission.INTERNET" />
<uses-permission android:name="android.permission.POST_NOTIFICATIONS" />
```

#### Activities

```xml
<activity android:name=".MainActivity" android:exported="true">
    <intent-filter>
        <action android:name="android.intent.action.MAIN" />
        <category android:name="android.intent.category.LAUNCHER" />
    </intent-filter>
</activity>
<activity android:name=".LoginActivity" android:exported="true"></activity>
<activity android:name=".SignupActivity" android:exported="true"></activity>
<activity android:name=".UserDetailsActivity" android:exported="true"></activity>
```

N'oubliez pas d'ajouter `localhost` et `10.0.2.2` dans votre configuration de sécurité réseau pour permettre le trafic en clair vers ces adresses lors du développement et des tests locaux.

### Astuces pour le développement Android

- Utilisez [Material Design 3](https://m3.material.io/) pour des interfaces utilisateur modernes et réactives.
- Configurez votre émulateur Android pour accéder au réseau de la machine hôte en utilisant [10.0.2.2](https://developer.android.com/studio/run/emulator-networking).
- Profitez du développement itératif avec [Jetpack Compose](https://developer.android.com/develop/ui/compose/tooling/iterative-development) pour créer des UI dynamiques et réactives.

#### Emulator Issue

Pour les ordinateurs portables plus anciens, utilisez ce tutoriel

![image](https://github.com/user-attachments/assets/71cbdbf4-7dc2-4a1a-8445-26ff8a6b768e)
![image](https://github.com/user-attachments/assets/12324096-5ef5-4ed7-8c97-4c9d3e02b40c)
![image](https://github.com/user-attachments/assets/bc835fde-765f-434c-a812-06d01dd2a4c0)

# HttpClient

Le `HttpClient` est une classe singleton qui facilite la gestion des requêtes HTTP en utilisant `OkHttpClient`. Il gère automatiquement les cookies et fournit des méthodes pour effectuer des requêtes GET et POST.

## Fonctionnalités

- Instance singleton `OkHttpClient`
- Gestion automatique des cookies
- Méthodes pour effectuer des requêtes GET et POST
- Gestion des callbacks avec notifications utilisateur

## Installation

### Étape 1 : Ajouter les dépendances

Assurez-vous d'avoir les dépendances nécessaires dans votre fichier `build.gradle` :

```gradle
dependencies {
    implementation 'com.squareup.okhttp3:okhttp:4.9.1'
    implementation 'androidx.annotation:annotation:1.2.0'
}
```

### Étape 2 : Créer la classe HttpClient

Créez une nouvelle classe Java `HttpClient` dans votre projet et ajoutez le code suivant :

```java
package com.tch099;

import android.content.Context;
import android.os.Handler;
import android.os.Looper;
import android.util.Log;
import android.widget.Toast;

import androidx.annotation.NonNull;

import java.io.IOException;
import java.net.CookieManager;
import java.net.CookiePolicy;
import java.util.ArrayList;
import java.util.List;
import java.util.concurrent.locks.Lock;
import java.util.concurrent.locks.ReentrantLock;

import okhttp3.Call;
import okhttp3.Callback;
import okhttp3.Cookie;
import okhttp3.CookieJar;
import okhttp3.HttpUrl;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.RequestBody;
import okhttp3.Response;

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

    public static void execute(Request request, Context context, Callback callback) {
        getInstance().newCall(request).enqueue(new Callback() {
            @Override
            public void onFailure(Call call, IOException e) {
                if (callback != null) callback.onFailure(call, e);
                runOnUiThread(context, () -> {
                    showToast(context, "Request failed: " + e.getMessage());
                    Log.e("HttpClient", "Request failed", e);
                });
            }

            @Override
            public void onResponse(Call call, Response response) throws IOException {
                if (callback != null) callback.onResponse(call, response);
                runOnUiThread(context, () -> {
                    if (response.isSuccessful()) {
                        showToast(context, "Request successful");
                    } else {
                        String errorMessage = "Request failed: " + response.message();
                        showToast(context, errorMessage);
                        Log.e("HttpClient", errorMessage);
                    }
                });
            }
        });
    }

    private static void runOnUiThread(Context context, Runnable action) {
        Handler handler = new Handler(Looper.getMainLooper());
        handler.post(action);
    }

    private static void showToast(Context context, String message) {
        Toast.makeText(context, message, Toast.LENGTH_SHORT).show();
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
```

### Étape 3 : Utiliser le HttpClient

#### Faire une requête POST

```java
import okhttp3.Request;
import okhttp3.RequestBody;
import okhttp3.FormBody;

RequestBody formBody = new FormBody.Builder()
        .add("param1", "value1")
        .add("param2", "value2")
        .build();

Request request = HttpClient.Post("https://example.com/api", formBody);

HttpClient

.execute(request, new Callback() {
    @Override
    public void onFailure(Call call, IOException e) {
        runOnUiThread(() -> {
            Toast.makeText(MainActivity.this, "Request failed: " + e.getMessage(), Toast.LENGTH_SHORT).show();
        });
    }

    @Override
    public void onResponse(Call call, Response response) throws IOException {
        runOnUiThread(() -> {
            if (response.isSuccessful()) {
                Toast.makeText(MainActivity.this, "Request successful", Toast.LENGTH_SHORT).show();
            } else {
                Toast.makeText(MainActivity.this, "Request failed: " + response.message(), Toast.LENGTH_SHORT).show();
            }
        });
    }
});
```

#### Faire une requête GET

```java
import okhttp3.Request;

Request request = HttpClient.Get("https://example.com/api");

HttpClient.execute(request, new Callback() {
    @Override
    public void onFailure(Call call, IOException e) {
        runOnUiThread(() -> {
            Toast.makeText(MainActivity.this, "Request failed: " + e.getMessage(), Toast.LENGTH_SHORT).show();
        });
    }

    @Override
    public void onResponse(Call call, Response response) throws IOException {
        runOnUiThread(() -> {
            if (response.isSuccessful()) {
                Toast.makeText(MainActivity.this, "Request successful", Toast.LENGTH_SHORT).show();
            } else {
                Toast.makeText(MainActivity.this, "Request failed: " + response.message(), Toast.LENGTH_SHORT).show();
            }
        });
    }
});
```

### Notes supplémentaires

- **runOnUiThread** : Cette méthode est utilisée pour exécuter des actions sur le thread principal, ce qui est nécessaire pour afficher des toasts et autres mises à jour de l'interface utilisateur.
- **showToast** : Cette méthode est une aide pour afficher des messages toast.
