plugins {
    alias(libs.plugins.androidApplication)
}

android {
    namespace = "com.tch099"
    compileSdk = 34

    defaultConfig {
        applicationId = "com.tch099"
        minSdk = 24
        targetSdk = 34
        versionCode = 1
        versionName = "1.0"

        testInstrumentationRunner = "androidx.test.runner.AndroidJUnitRunner"

        android.buildFeatures.buildConfig = true

        buildConfigField("String", "API_BASE_URL", "\"https://10.0.2.2:8001/\"")
        buildConfigField("String", "LOGIN_API_URL", "\"https://10.0.2.2:8001/api/login\"")
        buildConfigField("String", "SIGNUP_API_URL", "\"https://10.0.2.2:8001/api/signup\"")
        buildConfigField("String", "USER_DETAILS_API_URL", "\"https://10.0.2.2:8001/api/user-details\"")
    }

    buildTypes {
        release {
            isMinifyEnabled = false
            buildConfigField("String", "API_BASE_URL", "\"https://10.0.2.2:8001/\"")
            buildConfigField("String", "LOGIN_API_URL", "\"https://10.0.2.2:8001/login\"")
            buildConfigField("String", "SIGNUP_API_URL", "\"https://10.0.2.2:8001/signup\"")
            buildConfigField("String", "USER_DETAILS_API_URL", "\"https://10.0.2.2:8001/user-details\"")
            proguardFiles(
                getDefaultProguardFile("proguard-android-optimize.txt"),
                "proguard-rules.pro"
            )
        }
    }
    compileOptions {
        sourceCompatibility = JavaVersion.VERSION_1_8
        targetCompatibility = JavaVersion.VERSION_1_8
    }
}

dependencies {
    implementation(libs.appcompat)
    implementation(libs.material)
    implementation(libs.activity)
    implementation(libs.constraintlayout)
    implementation(libs.okhttp)
    implementation(libs.okio)
    implementation(libs.dotenv)
    implementation(libs.loggingInterceptor)
    testImplementation(libs.junit)
    androidTestImplementation(libs.ext.junit)
    androidTestImplementation(libs.espresso.core)
}
