package com.tch099;

import android.os.Bundle;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;
import androidx.appcompat.app.AppCompatActivity;
import okhttp3.FormBody;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.RequestBody;
import okhttp3.Response;
import java.io.IOException;

public class SignupActivity extends AppCompatActivity {

    private EditText emailField;
    private EditText passwordField;
    private Button signupButton;
    private OkHttpClient client;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup);

        emailField = findViewById(R.id.email);
        passwordField = findViewById(R.id.password);
        signupButton = findViewById(R.id.signup_button);
        client = new OkHttpClient();

        signupButton.setOnClickListener(view -> signupUser());
    }

    private void signupUser() {
        String email = emailField.getText().toString().trim();
        String password = passwordField.getText().toString().trim();

        if (email.isEmpty() || password.isEmpty()) {
            Toast.makeText(this, "Please fill in all fields", Toast.LENGTH_SHORT).show();
            return;
        }

        RequestBody formBody = new FormBody.Builder()
                .add("email", email)
                .add("password", password)
                .build();

        String url = BuildConfig.SIGNUP_API_URL;

        Request request = new Request.Builder()
                .url(url)
                .post(formBody)
                .build();

        new Thread(() -> {
            try (Response response = client.newCall(request).execute()) {
                if (response.isSuccessful()) {
                    runOnUiThread(() -> Toast.makeText(this, "Signup successful", Toast.LENGTH_SHORT).show());
                    // Notification

                } else {
                    runOnUiThread(() -> Toast.makeText(this, "Signup failed: " + response.message(), Toast.LENGTH_SHORT).show());
                    // Notification

                }
            } catch (IOException e) {
                runOnUiThread(() -> Toast.makeText(this, "Error: " + e.getMessage(), Toast.LENGTH_SHORT).show());
                e.printStackTrace();
            }
        }).start();
    }
}
