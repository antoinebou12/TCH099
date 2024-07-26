package com.tch099;

import android.os.Bundle;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;

import okhttp3.Callback;
import okhttp3.Request;
import okhttp3.Response;

public class UserDetailsActivity extends AppCompatActivity {

    private TextView usernameView;
    private TextView emailView;
    private TextView roleView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_user_details);

        usernameView = findViewById(R.id.username);
        emailView = findViewById(R.id.email);
        roleView = findViewById(R.id.role);

        fetchUserDetails();
    }

    private void fetchUserDetails() {
        String userDetailsUrl = BuildConfig.USER_DETAILS_API_URL;

        Request request = HttpClient.Get(userDetailsUrl);

        HttpClient.execute(request, new Callback() {
            @Override
            public void onFailure(@NonNull okhttp3.Call call, @NonNull IOException e) {
                runOnUiThread(() -> {
                    Toast.makeText(UserDetailsActivity.this, "Failed to fetch user details: " + e.getMessage(), Toast.LENGTH_SHORT).show();
                });
            }

            @Override
            public void onResponse(@NonNull okhttp3.Call call, @NonNull Response response) throws IOException {
                runOnUiThread(() -> {
                    if (response.isSuccessful()) {
                        try {
                            assert response.body() != null;
                            String responseData = response.body().string();
                            JSONObject json = new JSONObject(responseData);
                            String username = json.getString("username");
                            String email = json.getString("email");
                            String role = json.getString("role");

                            usernameView.setText(username);
                            emailView.setText(email);
                            roleView.setText(role);
                        } catch (JSONException | IOException e) {
                            e.printStackTrace();
                            Toast.makeText(UserDetailsActivity.this, "Failed to parse user details", Toast.LENGTH_SHORT).show();
                        }
                    } else {
                        Toast.makeText(UserDetailsActivity.this, "Failed to fetch user details: " + response.message(), Toast.LENGTH_SHORT).show();
                    }
                });
            }
        });
    }
}
