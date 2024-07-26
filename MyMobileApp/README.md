# MyMobileApp
![badge](https://img.shields.io/badge/development-tips-brightgreen)

MyMobileApp est une application Android qui fournit des fonctionnalités de connexion, d'inscription et de détails utilisateur en utilisant OkHttp pour les requêtes réseau. L'application inclut des notifications pour les événements de connexion et d'inscription.

## Commencer

Ces instructions vous aideront à configurer et à exécuter le projet sur votre machine locale pour le développement et les tests.

Source 1: https://m3.material.io/

Source 2: https://developer.android.com/studio/run/emulator-networking

Source 3: https://developer.android.com/develop/ui/compose/tooling/iterative-development

### Prérequis

- Android Studio
- Java 8
- Android SDK
- OkHttp

### Installation

1. Ouvrez le projet dans Android Studio.

![image](https://github.com/user-attachments/assets/4238a27c-de15-4d42-89cf-6d9a862bfe9f)


3. Configurez les URL de l'API dans `build.gradle` :

   ```groovy
   buildConfigField("String", "API_BASE_URL", "\"https://10.0.2.2:8001/\"")
   buildConfigField("String", "LOGIN_API_URL", "\"https://10.0.2.2:8001/api/login\"")
   buildConfigField("String", "SIGNUP_API_URL", "\"https://10.0.2.2:8001/api/signup\"")
   buildConfigField("String", "USER_DETAILS_API_URL", "\"https://10.0.2.2:8001/api/user-details\"")
   ```

### Fichiers de mise en page

Définir les éléments UI pour les activités.

- `activity_login.xml`

![image](https://github.com/user-attachments/assets/4b6d350d-e930-46c3-aaff-2dc96b880af3)

- `activity_signup.xml`
  
![image](https://github.com/user-attachments/assets/cfbe07d8-378d-47c8-8a87-5bdf17b3c0fb)

- `activity_user_details.xml`

- `activity_main.xml`
  
![image](https://github.com/user-attachments/assets/bb7d550e-a64e-428b-8e7f-6cb44315d42a)

Ajouter des image et icon

![image](https://github.com/user-attachments/assets/383c353c-5ff0-4130-9371-a12f0576d306)


![image](https://github.com/user-attachments/assets/95ac6cb6-3490-4eda-b6e3-0514cca95506)

### AndroidManifest.xml

#### Permission

```xml
    <uses-permission android:name="android.permission.INTERNET" />
    <uses-permission android:name="android.permission.POST_NOTIFICATIONS" />
```

#### Activity

```
<activity
    android:name=".MainActivity"
    android:exported="true">
    <intent-filter>
        <action android:name="android.intent.action.MAIN" />
        <category android:name="android.intent.category.LAUNCHER" />
    </intent-filter>
</activity>
<activity android:name=".LoginActivity" android:exported="true">
</activity>
<activity android:name=".SignupActivity" android:exported="true">
</activity>
<activity android:name=".UserDetailsActivity" android:exported="true">
</activity>
```


N'oubliez pas d'ajouter `localhost` et `10.0.2.2` dans votre configuration de sécurité réseau pour permettre le trafic en clair vers ces adresses lors du développement et des tests locaux.

### Astuces pour le développement Android

- Utilisez [Material Design 3](https://m3.material.io/) pour des interfaces utilisateur modernes et réactives.
- Configurez votre émulateur Android pour accéder au réseau de la machine hôte en utilisant [10.0.2.2](https://developer.android.com/studio/run/emulator-networking).
- Profitez du développement itératif avec [Jetpack Compose](https://developer.android.com/develop/ui/compose/tooling/iterative-development) pour créer des UI dynamiques et réactives.

#### Emulator Issue

Pour les laptop un peu plus vieu utiliser ce tutorial

![image](https://github.com/user-attachments/assets/71cbdbf4-7dc2-4a1a-8445-26ff8a6b768e)
![image](https://github.com/user-attachments/assets/12324096-5ef5-4ed7-8c97-4c9d3e02b40c)
![image](https://github.com/user-attachments/assets/bc835fde-765f-434c-a812-06d01dd2a4c0)

