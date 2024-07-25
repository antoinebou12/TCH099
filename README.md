# tch099-demo-web-app
This repo will be used as demo php web app to deploy on azure cloud

## Features

- **API Endpoints:** Create custom API endpoints for your application.
- **User Authentication:** Implement user authentication with login, signup, and logout functionality.
- **Database Integration:** Use MySQL database for storing user data and other information.
- **Frontend Pages:** Create frontend pages with HTML, CSS, and JavaScript.
- **Docker Support:** Run the application locally using Docker Compose.

### Epic: User Account and Profile Management

#### User Story: User Signup
As a user, I want to create an account on the platform so that I can access the features.

**Sub-tasks:**
- [x] Design the signup form with fields for username, email, password, role.
- [x] Implement backend logic to handle user data submission and validation.
- [x] Integrate password encryption for secure storage.
- [x] Test the signup process to ensure it works as expected.

#### User Story: User Login
As a user, I want to log in to my account so that I can access my profile and other features.

**Sub-tasks:**
- [x] Design the login form with fields for username/email and password.
- [x] Implement backend authentication logic to verify user credentials.
- [x] Create sessions to maintain user login state.
- [x] Handle incorrect login attempts with appropriate error messages.
- [x] Test the login process for functionality and security.

#### User Story: User Logout
As a user, I want to log out of my account to secure my session.

**Sub-tasks:**
- [x] Add a logout option in the user interface.
- [x] Implement backend logic to destroy user sessions upon logout.
- [x] Redirect users to the homepage or login page after logout.
- [x] Test the logout functionality to ensure sessions are properly terminated.

#### User Story: View Hello World Message
As a user, I want to see a "Hello World" message with my name.

**Sub-tasks:**
- [x] Create a personalized message template.
- [x] Retrieve the user's name from the session data.
- [x] Display the "Hello World" message with the user's name on the page.
- [x] Test the message display for different user scenarios.

#### User Story: View Random Image
As a user, I want to see a random image displayed on the page.

**Sub-tasks:**
- [x] Source a collection from external API of random images.
- [x] Implement logic to randomly select an image from the collection.
- [x] Display the selected image on the user interface.
- [x] Test the random image feature to ensure different images are shown each time.

#### User Story: View User Details
As a user, I want to view my profile details such as username and email address.

**Sub-tasks:**
- [x] Create a user profile page template.
- [x] Implement backend logic to retrieve user details from the database.
- [x] Display the user's username and email address on the profile page.
- [x] Test the profile page to ensure accurate data display.

#### User Story: Admin Login
As an admin, I want to log in to my account to access admin features like viewing all clients.

**Sub-tasks:**
- [x] Design the admin login form with fields for username/email and password.
- [x] Implement backend authentication logic for admin credentials.
- [x] Create admin sessions to maintain login state.
- [x] Develop the admin dashboard to display client information.
- [x] Test the admin login and dashboard functionalities for proper access control.


## Environment Variables

Create a `.env` file in your project root with the following content:

```
DB_HOST=tch099-db
MYSQL_ROOT_PASSWORD=rootpassword
MYSQL_DATABASE=mydatabase
MYSQL_USER=user
MYSQL_PASSWORD=password
```

Follow the prompts provided by Vercel CLI to complete the deployment.

## Docker Usage

To run the application locally using Docker:

```
docker-compose up -d --build
```


## Prerequisites

- Docker
- Docker Compose
- Azure Student Account


## Project Structure

```
/

├── api/                        # Folder containing API endpoint scripts
└── utils/                      # Folder containing utility scripts
    └── utils.php               # Utility functions for the application
│   ├── hello-world.php         # API endpoint for Hello World messages
│   ├── login.php               # API endpoint for user login
│   ├── logout.php              # API endpoint for user logout
│   ├── randomimage.php         # API endpoint to get a random image
│   ├── signup.php              # API endpoint for user signup
│   ├── user_details.php        # API endpoint to fetch user details
│   └── clients.php             # API endpoint to fetch all clients

├── db/                         # Folder containing SQL scripts for database setup
│   ├── 1create.sql              # SQL script for creating database tables
│   ├── 2contraines.sql          # SQL script for adding constraints
│   ├── 3insert.sql              # SQL script for inserting initial data into database tables
│   └── db.py                # Python script to create, alter and inserting initial data into database tables

├── frontend/                   # Folder containing frontend assets and pages
│   ├── css/                    # Folder containing CSS files
│   │   └── styles.css          # Main stylesheet for the frontend
│   ├── images/                 # Folder to store image assets
│   ├── js/                     # Folder containing JavaScript files
│   │   └── script.js           # Main JavaScript file for the frontend
│   └── pages/                  # Folder containing HTML pages
│       ├── hello-world.html    # HTML page for Hello World functionality
│       ├── index.html          # HTML page for the homepage
│       ├── admin.html          # HTML page that see all the clients
│       ├── login.html          # HTML page for the login form
│       ├── random-image.html   # HTML page to display a random image
│       ├── signup.html         # HTML page for the signup form
│       └── 404.html            # HTML page for errors 404 Not Found

├── config.php                  # Main configuration file for the project
├── router.php                  # Main router file for handling URL routing
├── routes.php                  # File defining the routes for the application
├── Dockerfile                  # Dockerfile to build the docker image
├── docker-compose.yml          # Docker Compose configuration file for setting up the development environment
├── nginx.conf                  # nginx configuration for Azure deployment
```


## Actors

- **User:** A user who interacts with the application by logging in, signing up, and accessing various features.
- **Admin:** A user with elevated privileges who can manage users and other aspects of the application.


## Use Case

![Use Case](https://www.plantuml.com/plantuml/dpng/PP51QiGm34NtFeMOVQzGPfZ242WKMjnj4Oam1bi9jaolNyUDgnJlelSYyhzopO99IWm6PraJs4pfUBmjqRCn9TECcU3ouHs3tIw06UpzQn_jflfrTJ1njtMQ-BzyAtAoTLBzwUcxVHfUID27t5_SnSuFh1iFOaee18z499vTt-YYy_EAm3loiaQO8ZhI3Vd5ZPuB4y4j1BW7Jon_cIgkz836jDXFptgIJlGC7MXp9KD5LKCNTMFgzhUg6nDUYPSImmy0)

## Class Diagram

![User Class DB](https://www.plantuml.com/plantuml/dpng/RSnD2W8n38RXVK-HlNY70GyYeGqOIDgQ7rs8TzTk1i5Pvdd3jtcWHQgKAkWE5s7guV0g02Tky42hDpJ0Z77cNetqsrTC9-kejBzavtlIIgJ8Sk0JtP_3zjLbDeH-xsg4GUsA0S5A7gXpUSxsx--oKM-fyW40)

## Seed Database

```
cd db.py # make sure to have a .env in folder with correct variable to the database
python3 -m pip3 install mysql-connector-python python-dotenv
python3 db.py
```

## API Endpoints

### User Authentication

#### Login

**Endpoint:** `/api/login.php`

![Login Sequence Diagram](https://www.plantuml.com/plantuml/dpng/ROv1QyCm38Nl-XMYf_RGvPx3w49M60nQs7OR3CrH6uEZ65l-_xCNvYxGwzEdzxv3L0gQ9WTaT0xu4Ja0-9nPOps9ukOOPb6MuLEsRhvQUHXrShiDKiJZyzThYTOFJ-UNolhHBsWExx4zANrJvFnWPhdOw-sZxm2W-E3-iIwrUF8iU1E1lqkXwaYBvzFREpRaRLD5e9mhstVjKbCcjZleEzolAtwtAUd8aeL9UVZVi99QifYCuHYR2rcN0iE1PKYJ-m40)

**Method:** `POST`

**Request Body:**

```json
{
  "username": "example",
  "password": "password"
}
```

**Response:**

```json
{
  "status": "success",
  "message": "Login successful"
}
```

#### Signup

![Signup Sequence Diagram](https://www.plantuml.com/plantuml/dpng/RP2_JiD03CPtFuNLgHrAzWoeHA4IKoiA6n8o5pSzANLEjlF-v8hK8uZry-_x8-_CINsw3a31HyLtOmL8inP3J2IEgxsEuYpTXwmjzZAbXujVXyqAoN3__7cwQKlBq_6bqEcIVk1P_PTkoUcBZ6TB6EKS-s9f6u0y2RUFfQl6GsB1NsFWVijWwQdnU3YzOKKfLcKD523ZRLEZSX_DMNFNUWDjWzi_GVbonxXRP2p7lTuW9O-Ze4qXi5brfZXCoW0xbcv-zpS0)

**Endpoint:** `/api/signup.php`

**Method:** `POST`

**Request Body:**

```json
{
  "username": "example",
  "password": "password",
  "email": "example@example.com",
  "role": "user"
}
```

**Response:**

```json
{
  "status": "success",
  "message": "Signup successful"
}
```

#### Logout

![Logout](https://www.plantuml.com/plantuml/dpng/NP0nQyCm48Nt-nL7fcH8idiegQi60eK6scw1S9NLH5Gv2UaC_VcrRBUEl3vzzxs7TaaeIdjpG5fyn8za8a3eCgjj81PSxADdCToSU6cvCJ-RgzpSQe6KSFzyFkIeF7Wy7awyTVxYMzc4Q-ZHBZo_z549AnBwf6Gwk_RyPI_vOh2h6W3o85m__5TL-EIi_iRHzHTdPAgeyFZwzevR2lPk1qn0nbLTuV2OEvOhK3MkPvgHJgtM9gL2K6oQSJl3JVxJNm00)

**Endpoint:** `/api/logout.php`

**Method:** `POST`

**Response:**

```json
{
  "status": "success",
  "message": "Logout successful"
}
```

#### User Details

![User Details](https://www.plantuml.com/plantuml/dpng/ROu_Ry8m4CNt-nGd9XY0FKD58qF5r0xjXXHTuojOSYwMVPRQRzyO-eSGrdVtUx-tIKfHS-U1MkqZlYME0126qBKka2ZETh4NPR47cJkn_BawQUSNCwI4ksspBz4OU7pP7sIT4yV6ifBpQHLEuGmCfwOup2KVSuQKtYdn86fx-N37Wbr4fWOe72uV_gGLFWSM_Dy4lvVoTMEgy6dxYciARZ8CRbuBRUeAZwnNwNm1fiRblURpi9_2QTbeiN4fUFh2V8t0XiNcpdy3)

**Endpoint:** `/api/user_details.php`

**Method:** `GET`

**Response:**

```json
{
  "status": "success",
  "data": {
    "username": "example",
    "email": "example@example.com",
    "role": "user"
  }
}
```

### Admin
![Admin](https://www.plantuml.com/plantuml/dpng/TP1DIi0m48NtSugtr4NLHLU1IaLFKEW1GZhIOFfZPhBmzgQD44enYy1yx-LZI2zgewOba7MwHOp2aMZFp3k_srKnR4avtf5SqAW-2ELp2D2ybauq6FWxiIYUxRJubKvS2sBmFhFxAXCLbjFYC_3oTZnxU2GRj4xeEcXCJ01A5KrLrgZwZhKCFhpimVxWtELfrYKG1-6h-DC6-STSivjwuCb7TWhTqBwqV_9reZvV-Nz_0G00)


### Hello World

#### Get Greeting

![Hello World](https://www.plantuml.com/plantuml/dpng/RO_DJiCm48JlVefLnI4vXDnpG2KA1IIaLlo8IoMq98jZuQmjUoDUdxe5L9TUFVFjDrv6mI3pP1NsuWAyH0fAUGnYUkEH1HQhu5Y8XoqN8rdhgYyNx70vocJB1M24rStRNGfox7fpl-NwcF2Zt_TtoG5uJSyvrQ7WEqRQoNh77qOdwg3fMgNIFAYk_fGDh3qndEvIltdgvhe6DkkdPwZHc-DnzOL5rZEfl9tuhcsW7wd_JF87fmqNfUfQgCxStk-pgGDHKEPuUkyCeuafeD1j81B3kYZ_GTcF7qdcmA1_wZ1HZAX9gINnC4_s6m00)

**Endpoint:** `/api/hello-world/$langue`

**Method:** `GET` or `POST`

**Request Query Parameters:**

- `nom` (optional)
- `prenom` (optional)

**Response:**

```json
{
  "nom": "Doe",
  "prenom": "John",
  "langue": "en",
  "message": "Hello World John Doe!"
}
```

### Random Image

![Random Image](https://www.plantuml.com/plantuml/dpng/RP31IiGm48RlynJ3ddOFwzxt85NQIa5GYhqLP6nZ6sWc8Pc-lsaLDUqUP-R_-7uc2q9UPZC1TM8zDa5v01TtkjEEMF1GUikYk6_vw8bxQyxQqA3kHZ7JwO0Ki2pUw_MIWW-lLSkNX76ZMubu-a6gPPzoEGbzK51Hs5d-rCE2VPloHu2b8fxl_wnNV76ASLSEVXCnlbLUyQbummivlMi8c-XDUb3oRsxgv-DfpwKjQoMpPrmz60d8ubVZwxy0)

**Endpoint:** `/api/random-image`

**Method:** `GET`

**Response:**

A random image URL.

## Deployment on Azure with Portal

### Deployment diagram

![Deployement diagram](https://www.plantuml.com/plantuml/dpng/XP5FImCn44Vlyob-vk9fmMjxa2vhiOTQjksg1_6GPaSCngJcZwAotzsD4A5GwTp2UxnCo2n4wMDwDNJMyvEsZCsywUhLzN8EPMG8H595vt4Rs1Cfur8FKNybpsZoGU2RC8vrFKFSwJ4c3LOSFvn_AV2Ft_CEM_Rlx0igyz0kMcHSx_T6Ancriu_560uhLpBAdGpyN-hcSxjUebXJHFLyCPbKuTS-Z0uq49sZSTQoodS6oYz5LLqUNmbJY4NNjTZmM-8GWw3ZNYwSs2It2iCwiTSyvcPi-_53VW00)


- Source 1: https://learn.microsoft.com/en-us/azure/app-service/quickstart-php?tabs=cli&pivots=platform-linux

- Source 2: https://learn.microsoft.com/en-us/azure/app-service/configure-language-php?pivots=platform-linux


### 1. App service create webapp and database

![Create Web App and Database](https://github.com/user-attachments/assets/b2eea129-7197-4f87-aab4-40978f5cd3ad)

### 2. Chose MySQL and PHP

![Create Web App and Database Settings](https://github.com/user-attachments/assets/cacfc5b4-a09d-4ca2-a8b4-e83ab1e005ae)

### 3. Deployment Center to make CD
![Deployement Center](https://github.com/user-attachments/assets/2ac1d270-4c44-4d87-b1b1-95ff3e778379)

### 4. Add Startup Command
```bash
# put this line into the startup command
cp /home/site/wwwroot/nginx.conf /etc/nginx/sites-available/default && service nginx reload
```

![Startup Command](https://github.com/user-attachments/assets/3108acb5-5dc6-48fe-98bd-fab10d182deb)

### 5. Check Environement Variable

![Environement Variable](https://github.com/user-attachments/assets/d2fe5651-4a29-490c-a1e3-c71401e411f5)

### 6. SSH into the container

![SSH](https://github.com/user-attachments/assets/eb93150a-519c-4cc9-973d-f6bff36b8abe)

### 6. Create .ENV file with the right variable based on azure env

```
DB_HOST=tch099-db
MYSQL_ROOT_PASSWORD=rootpassword
MYSQL_DATABASE=mydatabase
MYSQL_USER=user
MYSQL_PASSWORD=password
```

![ENV](https://github.com/user-attachments/assets/e92362e5-2ad2-41a6-8b3b-c4586033251c)
