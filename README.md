# tch099-demo-web-app
Ce dépôt sera utilisé comme application web PHP démo à déployer sur le cloud Azure

[Example Anis](https://github.com/AnisBoubaker/TCH056-20242/tree/main/cours13)

## Table des matières

- [Documentation des composants](#documentation-des-composants)
- [Prérequis](#prérequis)
- [Fonctionnalités](#fonctionnalités)
- [Configuration de l'environnement](#configuration-de-lenvironnement)
- [Installation et démarrage](#utilisation-de-docker)
  - [Utilisation de Docker](#utilisation-de-docker)
  - [Initialisation de la base de données](#initialisation-de-la-base-de-données)
- [Structure du projet](#structure-du-projet)
- [Acteurs et cas d'utilisation](#acteurs)
  - [Acteurs](#acteurs)
  - [Cas d'utilisation](#cas-dutilisation)
- [Architecture](#diagramme-de-classe)
  - [Diagramme de classe](#diagramme-de-classe)
  - [Routage de l'application](#routage-de-lapplication)
- [Points de terminaison API](#points-de-terminaison-api)
  - [Authentification utilisateur](#authentification-utilisateur)
  - [Admin](#admin)
  - [Hello World](#hello-world)
  - [Image aléatoire](#image-aléatoire)
- [Déploiement sur Azure](#déploiement-sur-azure-vm)
  - [Déploiement sur VM Azure](#déploiement-sur-azure-vm)
  - [Déploiement via le portail Azure](#déploiement-sur-azure-avec-le-portail)
- [Guide du développeur](#guide-du-développeur)
  - [Comment ajouter une nouvelle route](#comment-ajouter-une-nouvelle-route)
  - [Fonctionnement du routeur](#fonctionnement-du-routeur)
  - [Comment ajouter une nouvelle page](#comment-ajouter-une-nouvelle-page)
  - [Comment ajouter un nouveau point d'API](#comment-ajouter-un-nouveau-point-dapi)
  - [Bonnes pratiques](#bonnes-pratiques)
- [Ressources externes](#ressources-externes)

## Aperçu

Cette application web PHP de démonstration est conçue pour être déployée sur le cloud Azure. Elle comprend une API RESTful, une interface utilisateur frontend et une base de données MySQL.

## Documentation des composants

1. [Base de données](https://github.com/antoinebou12/TCH099/blob/main/db/README.md)
2. [Application mobile](https://github.com/antoinebou12/TCH099/blob/main/MyMobileApp/README.md)
3. [API](https://github.com/antoinebou12/TCH099/blob/main/api/README.md)
4. [Frontend](https://github.com/antoinebou12/TCH099/blob/main/frontend/README.md)

## Prérequis

- Docker
- Docker Compose
- Compte Azure Student

## Configuration de l'environnement

Variables d'environnement nécessaires:

```
DB_HOST=tch099-db
MYSQL_ROOT_PASSWORD=rootpassword
MYSQL_DATABASE=mydatabase
MYSQL_USER=user
MYSQL_PASSWORD=password
```

## Installation et démarrage

### Utilisation de Docker

Pour exécuter l'application localement via Docker:

```bash
docker-compose up -d --build
```

Une fois démarré, vous pourrez accéder aux points d'entrée suivants:

- **Application**: http://localhost:8001
- **Base de données**: mysql:host=localhost;port=3306;dbname=mydatabase
- **PHPMyAdmin**: http://localhost:8060
  - Administrateur: `admin` / `rootpassword`
  - Utilisateur: `user` / `password`

### Initialisation de la base de données

Option 1: Via script Python
```bash
cd db
python3 -m pip install mysql-connector-python python-dotenv
python3 db.py
```

Option 2: Via PHPMyAdmin à l'adresse http://localhost:8060

## Structure du projet

```
├── api/                        # Points de terminaison API
│   ├── hello-world.php         # API Hello World
│   ├── login.php               # API de connexion
│   ├── logout.php              # API de déconnexion
│   ├── randomimage.php         # API d'image aléatoire
│   ├── signup.php              # API d'inscription
│   ├── user_details.php        # API détails utilisateur
│   └── clients.php             # API liste des clients
├── utils/                      # Utilitaires
│   └── utils.php               # Fonctions utilitaires
├── db/                         # Base de données
│   ├── 1create.sql             # Création des tables
│   ├── 2contraines.sql         # Contraintes
│   ├── 3insert.sql             # Données initiales
│   └── db.py                   # Script d'initialisation
├── frontend/                   # Interface utilisateur
│   ├── css/                    # Styles CSS
│   │   └── styles.css          # Feuille de style principale
│   ├── images/                 # Images
│   ├── js/                     # Scripts JavaScript
│   │   └── script.js           # Script principal
│   └── pages/                  # Pages HTML
│       ├── hello-world.html    # Page Hello World
│       ├── index.html          # Page d'accueil
│       ├── admin.html          # Page admin
│       ├── login.html          # Page de connexion
│       ├── random-image.html   # Page d'images aléatoires
│       ├── signup.html         # Page d'inscription
│       └── 404.html            # Page d'erreur 404
├── config.php                  # Configuration principale
├── router.php                  # Gestion du routage
├── routes.php                  # Définition des routes
├── Dockerfile                  # Configuration Docker
├── docker-compose.yml          # Configuration Docker Compose
├── composer.json               # Dépendances PHP
└── nginx.conf                  # Configuration Nginx pour Azure
```

## Acteurs et cas d'utilisation

### Acteurs

- **Utilisateur**: Interagit avec l'application (connexion, inscription, fonctionnalités diverses)
- **Administrateur**: Utilisateur avec privilèges élevés pour la gestion des utilisateurs et de l'application

### Cas d'utilisation

![Cas d'utilisation](https://www.plantuml.com/plantuml/dpng/PP51QiGm34NtFeMOVQzGPfZ242WKMjnj4Oam1bi9jaolNyUDgnJlelSYyhzopO99IWm6PraJs4pfUBmjqRCn9TECcU3ouHs3tIw06UpzQn_jflfrTJ1njtMQ-BzyAtAoTLBzwUcxVHfUID27t5_SnSuFh1iFOaee18z499vTt-YYy_EAm3loiaQO8ZhI3Vd5ZPuB4y4j1BW7Jon_cIgkz836jDXFptgIJlGC7MXp9KD5LKCNTMFgzhUg6nDUYPSImmy0)

## Architecture

### Diagramme de classe

![Diagramme de classe](https://www.plantuml.com/plantuml/dpng/RSnD2W8n38RXVK-HlNY70GyYeGqOIDgQ7rs8TzTk1i5Pvdd3jtcWHQgKAkWE5s7guV0g02Tky42hDpJ0Z77cNetqsrTC9-kejBzavtlIIgJ8Sk0JtP_3zjLbDeH-xsg4GUsA0S5A7gXpUSxsx--oKM-fyW40)

### Routage de l'application

L'application utilise un système de routage pour diriger les requêtes vers les bonnes ressources:

```
Client Request → router.php → routes.php → Frontend/API
```

## Points de terminaison API

### Authentification utilisateur

#### Connexion

**Point de terminaison**: `/api/login.php`  
**Méthode**: `POST`

**Corps de la requête**:
```json
{
  "username": "exemple",
  "password": "motdepasse"
}
```

**Réponse**:
```json
{
  "status": "success",
  "message": "Connexion réussie"
}
```

![Diagramme de séquence - Connexion](https://www.plantuml.com/plantuml/dpng/ROv1QyCm38Nl-XMYf_RGvPx3w49M60nQs7OR3CrH6uEZ65l-_xCNvYxGwzEdzxv3L0gQ9WTaT0xu4Ja0-9nPOps9ukOOPb6MuLEsRhvQUHXrShiDKiJZyzThYTOFJ-UNolhHBsWExx4zANrJvFnWPhdOw-sZxm2W-E3-iIwrUF8iU1E1lqkXwaYBvzFREpRaRLD5e9mhstVjKbCcjZleEzolAtwtAUd8aeL9UVZVi99QifYCuHYR2rcN0iE1PKYJ-m40)

#### Inscription

**Point de terminaison**: `/api/signup.php`  
**Méthode**: `POST`

**Corps de la requête**:
```json
{
  "username": "exemple",
  "password": "motdepasse",
  "email": "exemple@exemple.com",
  "role": "utilisateur"
}
```

**Réponse**:
```json
{
  "status": "success",
  "message": "Inscription réussie"
}
```

![Diagramme de séquence - Inscription](https://www.plantuml.com/plantuml/dpng/RP2_JiD03CPtFuNLgHrAzWoeHA4IKoiA6n8o5pSzANLEjlF-v8hK8uZry-_x8-_CINsw3a31HyLtOmL8inP3J2IEgxsEuYpTXwmjzZAbXujVXyqAoN3__7cwQKlBq_6bqEcIVk1P_PTkoUcBZ6TB6EKS-s9f6u0y2RUFfQl6GsB1NsFWVijWwQdnU3YzOKKfLcKD523ZRLEZSX_DMNFNUWDjWzi_GVbonxXRP2p7lTuW9O-Ze4qXi5brfZXCoW0xbcv-zpS0)

#### Déconnexion

**Point de terminaison**: `/api/logout.php`  
**Méthode**: `POST`

**Réponse**:
```json
{
  "status": "success",
  "message": "Déconnexion réussie"
}
```

![Diagramme de séquence - Déconnexion](https://www.plantuml.com/plantuml/dpng/NP0nQyCm48Nt-nL7fcH8idiegQi60eK6scw1S9NLH5Gv2UaC_VcrRBUEl3vzzxs7TaaeIdjpG5fyn8za8a3eCgjj81PSxADdCToSU6cvCJ-RgzpSQe6KSFzyFkIeF7Wy7awyTVxYMzc4Q-ZHBZo_z549AnBwf6Gwk_RyPI_vOh2h6W3o85m__5TL-EIi_iRHzHTdPAgeyFZwzevR2lPk1qn0nbLTuV2OEvOhK3MkPvgHJgtM9gL2K6oQSJl3JVxJNm00)

#### Détails de l'utilisateur

**Point de terminaison**: `/api/user_details.php`  
**Méthode**: `GET`

**Réponse**:
```json
{
  "status": "success",
  "data": {
    "username": "exemple",
    "email": "exemple@exemple.com",
    "role": "utilisateur"
  }
}
```

![Diagramme de séquence - Détails utilisateur](https://www.plantuml.com/plantuml/dpng/ROu_Ry8m4CNt-nGd9XY0FKD58qF5r0xjXXHTuojOSYwMVPRQRzyO-eSGrdVtUx-tIKfHS-U1MkqZlYME0126qBKka2ZETh4NPR47cJkn_BawQUSNCwI4ksspBz4OU7pP7sIT4yV6ifBpQHLEuGmCfwOup2KVSuQKtYdn86fx-N37Wbr4fWOe72uV_gGLFWSM_Dy4lvVoTMEgy6dxYciARZ8CRbuBRUeAZwnNwNm1fiRblURpi9_2QTbeiN4fUFh2V8t0XiNcpdy3)

### Fonctionnalités API

#### Administration

**Point de terminaison**: `/api/clients.php`  
**Méthode**: `GET`

![Diagramme de séquence - Admin](https://www.plantuml.com/plantuml/dpng/TP1DIi0m48NtSugtr4NLHLU1IaLFKEW1GZhIOFfZPhBmzgQD44enYy1yx-LZI2zgewOba7MwHOp2aMZFp3k_srKnR4avtf5SqAW-2ELp2D2ybauq6FWxiIYUxRJubKvS2sBmFhFxAXCLbjFYC_3oTZnxU2GRj4xeEcXCJ01A5KrLrgZwZhKCFhpimVxWtELfrYKG1-6h-DC6-STSivjwuCb7TWhTqBwqV_9reZvV-Nz_0G00)

#### Hello World

**Point de terminaison**: `/api/hello-world/$langue`  
**Méthode**: `GET` ou `POST`

**Paramètres de requête**:
- `nom` (optionnel)
- `prenom` (optionnel)

**Réponse**:
```json
{
  "nom": "Doe",
  "prenom": "John",
  "langue": "fr",
  "message": "Bonjour le monde John Doe!"
}
```

![Diagramme de séquence - Hello World](https://www.plantuml.com/plantuml/dpng/RO_DJiCm48JlVefLnI4vXDnpG2KA1IIaLlo8IoMq98jZuQmjUoDUdxe5L9TUFVFjDrv6mI3pP1NsuWAyH0fAUGnYUkEH1HQhu5Y8XoqN8rdhgYyNx70vocJB1M24rStRNGfox7fpl-NwcF2Zt_TtoG5uJSyvrQ7WEqRQoNh77qOdwg3fMgNIFAYk_fGDh3qndEvIltdgvhe6DkkdPwZHc-DnzOL5rZEfl9tuhcsW7wd_JF87fmqNfUfQgCxStk-pgGDHKEPuUkyCeuafeD1j81B3kYZ_GTcF7qdcmA1_wZ1HZAX9gINnC4_s6m00)

#### Image aléatoire

**Point de terminaison**: `/api/random-image`  
**Méthode**: `GET`

**Réponse**: Une URL d'image aléatoire.

![Diagramme de séquence - Image aléatoire](https://www.plantuml.com/plantuml/dpng/RP31IiGm48RlynJ3ddOFwzxt85NQIa5GYhqLP6nZ6sWc8Pc-lsaLDUqUP-R_-7uc2q9UPZC1TM8zDa5v01TtkjEEMF1GUikYk6_vw8bxQyxQqA3kHZ7JwO0Ki2pUw_MIWW-lLSkNX76ZMubu-a6gPPzoEGbzK51Hs5d-rCE2VPloHu2b8fxl_wnNV76ASLSEVXCnlbLUyQbummivlMi8c-XDUb3oRsxgv-DfpwKjQoMpPrmz60d8ubVZwxy0)

## Déploiement sur Azure

### Déploiement sur VM Azure

![image](https://github.com/user-attachments/assets/521aef53-e157-4309-a3ce-3292ad022779)

![image](https://github.com/user-attachments/assets/7e67e536-4f69-4f9d-9fa0-3424cffdc6d9)

Après d'avoir créer ta machine virtuel connect par ssh change le user et le ip
```
ssh azureuser@10.20.10.12
```
Enter password

```bash
   git clone https://github.com/antoinebou12/TCH099

   # Installer Docker
   sudo apt-get update
   sudo apt-get install ca-certificates curl
   sudo install -m 0755 -d /etc/apt/keyrings
   sudo curl -fsSL https://download.docker.com/linux/ubuntu/gpg -o /etc/apt/keyrings/docker.asc
   sudo chmod a+r /etc/apt/keyrings/docker.asc

   echo \
     "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/ubuntu \
     $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
     sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
   sudo apt-get update

   sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

   sudo curl -L "https://github.com/docker/compose/releases/download/1.29.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose

   sudo chmod +x /usr/local/bin/docker-compose

   # Démarrer l'application
   cd TCH099
   sudo docker-compose up -d
   ```

### Déploiement sur Azure avec le portail

### Diagramme de déploiement

![Diagramme de déploiement](https://www.plantuml.com/plantuml/dpng/XP5FImCn44Vlyob-vk9fmMjxa2vhiOTQjksg1_6GPaSCngJcZwAotzsD4A5GwTp2UxnCo2n4wMDwDNJMyvEsZCsywUhLzN8EPMG8H595vt4Rs1Cfur8FKNybpsZoGU2RC8vrFKFSwJ4c3LOSFvn_AV2Ft_CEM_Rlx0igyz0kMcHSx_T6Ancriu_560uhLpBAdGpyN-hcSxjUebXJHFLyCPbKuTS-Z0uq49sZSTQoodS6oYz5LLqUNmbJY4NNjTZmM-8GWw3ZNYwSs2It2iCwiTSyvcPi-_53VW00)

- Source 1: [https://learn.microsoft.com/fr-fr/azure/app-service/quickstart-php?tabs=cli&pivots=platform-linux](https://learn.microsoft.com/fr-fr/azure/app-service/quickstart-php?tabs=cli&pivots=platform-linux)
- Source 2: [https://learn.microsoft.com/fr-fr/azure/app-service/configure-language-php?pivots=platform-linux](https://learn.microsoft.com/fr-fr/azure/app-service/configure-language-php?pivots=platform-linux)
- Source 3: [https://learn.microsoft.com/en-us/azure/app-service/tutorial-php-mysql-app#2---set-up-database-connectivity](https://learn.microsoft.com/en-us/azure/app-service/tutorial-php-mysql-app#2---set-up-database-connectivity)

### 1. Créer un service d'application web et une base de données

![Créer un service d'application web et une base de données](https://github.com/user-attachments/assets/b2eea129-7197-4f87-aab4-40978f5cd3ad)

### 2. Choisir MySQL et PHP

![Choisir MySQL et PHP](https://github.com/user-attachments/assets/cacfc5b4-a09d-4ca2-a8b4-e83ab1e005ae)

### 3. Centre de déploiement pour créer la CI/CD

![Centre de déploiement](https://github.com/user-attachments/assets/2ac1d270-4c44-4d87-b1b1-95ff3e778379)

### 4. Ajouter une commande de démarrage
```bash
# mettre cette ligne dans la commande de démarrage
cp /home/site/wwwroot/nginx.conf /etc/nginx/sites-available/default && service nginx reload
```

![Commande de démarrage](https://github.com/user-attachments/assets/3108acb5-5dc6-48fe-98bd-fab10d182deb)

### 5. Vérifier les variables d'environnement

![Variables d'environnement](https://github.com/user-attachments/assets/d2fe5651-4a29-490c-a1e3-c71401e411f5)

### 6. SSH dans le conteneur

![SSH](https://github.com/user-attachments/assets/eb93150a-519c-4cc9-973d-f6bff36b8abe)

### 7. Créer un fichier .ENV avec les bonnes variables en fonction de l'environnement Azure

```
DB_HOST=tch099-db
MYSQL_ROOT_PASSWORD=rootpassword
MYSQL_DATABASE=mydatabase
MYSQL_USER=user
MYSQL_PASSWORD=password
```

![ENV](https://github.com/user-attachments/assets/e92362e5-2ad2-41a6-8b3b-c4586033251c)

### 8. Assure toi d'avoir un private link

Naviguer sur la page de la base de données MySQL dans votre groupe de ressources pour accéder à votre base de données.

![image](https://github.com/user-attachments/assets/0a1d1e07-ea3d-4837-9caa-f04fc680f222)

![image](https://github.com/user-attachments/assets/d765bdac-7c4a-4cb9-911e-7ba9a907b72c)

Naviguer sur la page de la base de données MySQL dans votre groupe de ressources pour accéder à votre base de données.

![image](https://github.com/user-attachments/assets/bc94ca69-1a27-40e6-bd7f-95d45f8a9fea)

Ouvrir le firewall pour votre base de données

![image](https://github.com/user-attachments/assets/36eb7526-6de5-4858-abeb-fa7f5db24c5f)

Utiliser DB beaver pour accéder à votre base de données

![image](https://github.com/user-attachments/assets/11e12afc-4dc6-47ac-b025-fd353c2c4352)

Utiliser SSL pour ce connecter sur la base de données

![image](https://github.com/user-attachments/assets/925525ad-1889-4e29-935c-21d5bb30eb56)

![image](https://github.com/user-attachments/assets/404c5762-c1f6-4e7b-a17b-e1c2aef815f7)

## Guide du développeur

### Comment ajouter une nouvelle route

L'application utilise un système de routage simple défini dans le fichier `routes.php`. Pour ajouter une nouvelle route:

1. Ouvrez le fichier `routes.php`
2. Ajoutez votre nouvelle route en suivant le format existant:

```php
// Pour une route API
$routes['/api/ma-nouvelle-route'] = [
    'controller' => 'api/ma-nouvelle-route.php',
    'method' => ['GET', 'POST'] // Méthodes HTTP autorisées
];

// Pour une route frontend
$routes['/ma-nouvelle-page'] = [
    'controller' => 'frontend/pages/ma-nouvelle-page.html',
    'method' => ['GET']
];

// Pour une route avec paramètres dynamiques
$routes['/api/details/([0-9]+)'] = [
    'controller' => 'api/details.php',
    'method' => ['GET'],
    'params' => ['id'] // Nom des paramètres dans l'ordre de capture
];
```

3. Si votre route utilise des paramètres dynamiques, vous pourrez les récupérer comme suit:

```php
// Dans votre fichier contrôleur (ex: api/details.php)
$id = isset($params['id']) ? $params['id'] : null;
```

### Fonctionnement du routeur

Le routeur (`router.php`) fonctionne de la manière suivante:

1. Il analyse l'URL demandée
2. Il la compare aux modèles définis dans `routes.php`
3. S'il trouve une correspondance:
   - Il vérifie que la méthode HTTP est autorisée
   - Il extrait les paramètres si nécessaire
   - Il inclut le fichier contrôleur correspondant
4. Sinon, il affiche une page 404

### Comment ajouter une nouvelle page

Pour ajouter une nouvelle page à l'application:

1. **Créer le fichier HTML**

   Créez votre fichier HTML dans le dossier `frontend/pages/`:

   ```html
   <!-- frontend/pages/ma-nouvelle-page.html -->
   <!DOCTYPE html>
   <html lang="fr">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Ma Nouvelle Page</title>
       <link rel="stylesheet" href="/frontend/css/styles.css">
   </head>
   <body>
       <header>
           <!-- Inclure votre en-tête ici -->
       </header>
       
       <main>
           <h1>Ma Nouvelle Page</h1>
           <p>Contenu de ma nouvelle page.</p>
       </main>
       
       <footer>
           <!-- Inclure votre pied de page ici -->
       </footer>
       
       <script src="/frontend/js/script.js"></script>
   </body>
   </html>
   ```

2. **Ajouter la route**

   Ajoutez une nouvelle route dans `routes.php`:

   ```php
   $routes['/ma-nouvelle-page'] = [
       'controller' => 'frontend/pages/ma-nouvelle-page.html',
       'method' => ['GET']
   ];
   ```

3. **Ajouter des liens vers votre page**

   Mettez à jour les menus ou ajoutez des liens vers votre nouvelle page:

   ```html
   <a href="/ma-nouvelle-page">Ma Nouvelle Page</a>
   ```

### Comment ajouter un nouveau point d'API

Pour ajouter un nouveau point d'API:

1. **Créer le fichier PHP**

   Créez votre fichier PHP dans le dossier `api/`:

   ```php
   <?php
   // api/ma-nouvelle-api.php
   
   // Inclure les fichiers nécessaires
   require_once __DIR__ . '/../config.php';
   require_once __DIR__ . '/../utils/utils.php';
   
   // Vérifier la méthode HTTP
   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
       // Traiter la requête GET
       $response = [
           'status' => 'success',
           'message' => 'Voici les données demandées',
           'data' => ['item1', 'item2', 'item3']
       ];
       
       // Renvoyer la réponse JSON
       header('Content-Type: application/json');
       echo json_encode($response);
       exit;
   } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
       // Récupérer les données POST
       $data = json_decode(file_get_contents('php://input'), true);
       
       // Valider et traiter les données
       // ...
       
       // Renvoyer une réponse
       $response = [
           'status' => 'success',
           'message' => 'Données reçues avec succès'
       ];
       
       // Renvoyer la réponse JSON
       header('Content-Type: application/json');
       echo json_encode($response);
       exit;
   } else {
       // Méthode non autorisée
       header('HTTP/1.1 405 Method Not Allowed');
       header('Allow: GET, POST');
       exit;
   }
   ```

2. **Ajouter la route**

   Ajoutez une nouvelle route dans `routes.php`:

   ```php
   $routes['/api/ma-nouvelle-api'] = [
       'controller' => 'api/ma-nouvelle-api.php',
       'method' => ['GET', 'POST']
   ];
   ```

3. **Tester votre API**

   Vous pouvez tester votre API avec curl ou un navigateur:

   ```bash
   # Pour une requête GET
   curl -X GET http://localhost:8001/api/ma-nouvelle-api
   
   # Pour une requête POST
   curl -X POST -H "Content-Type: application/json" -d '{"key":"value"}' http://localhost:8001/api/ma-nouvelle-api
   ```

### Bonnes pratiques

- **Séparation des préoccupations**: Gardez votre logique métier, votre logique de présentation et votre accès aux données séparés.
- **Validation des entrées**: Validez toujours les entrées utilisateur côté serveur.
- **Gestion des erreurs**: Renvoyez des codes d'erreur HTTP appropriés et des messages d'erreur informatifs.
- **Réutilisation du code**: Utilisez les fonctions utilitaires dans `utils/utils.php` pour les opérations courantes.
- **Sécurité**: Utilisez des requêtes préparées pour les opérations de base de données et échappez toujours les sorties HTML.

## Ressources externes

- [Démarrage rapide PHP sur Azure](https://learn.microsoft.com/fr-fr/azure/app-service/quickstart-php?tabs=cli&pivots=platform-linux)
- [Configuration de PHP sur Azure](https://learn.microsoft.com/fr-fr/azure/app-service/configure-language-php?pivots=platform-linux)
- [Tutoriel PHP MySQL sur Azure](https://learn.microsoft.com/en-us/azure/app-service/tutorial-php-mysql-app#2---set-up-database-connectivity)
- [Exemple de l'enseignant](https://github.com/AnisBoubaker/TCH056-20242/tree/main/cours13)

[![Diagramme de flux](https://mermaid.ink/img/pako:eNplkc1uwjAQhF_F2nMIBAIxOVSCJFS9VbS91OFgJc6P5NipY4tS4N3rBKhA9cHy7nyzGq2PkMmcQQgFl_usokqj9zgVyJ4ViXjNhEZb9mVYp3doNHpCa6Kk0Uy5bdXuLuB6EKKL0N0JUS-cNkoKzUSOtr1-QjG5dR6w1evLjUiILa5iPAyPfdLSknXjinEuR3upeO5WuuFXKhmoxCO0rR-Yx5QohY-OdSkM-IZkUhR1eQcl_6BnYnTNu_FwDyQ40DDV0Dq3azv2vhR0xRqWQmifOSuo4TqFVJwtSo2WbweRQaiVYQ7YJZUVhAXlna1Mm1PN4pqWijZ_3ZaKTymbm8WWEB7hG8Jg5mKMfbyc-Z6PA-zAAUJ_6vqz6WLqeTjwlwuMzw78DPaJiyeBN7GOReD5cxzMHShVn_uaxf4BU5E0QkOI5-dfAwmhnA?type=png)](https://mermaid.live/edit#pako:eNplkc1uwjAQhF_F2nMIBAIxOVSCJFS9VbS91OFgJc6P5NipY4tS4N3rBKhA9cHy7nyzGq2PkMmcQQgFl_usokqj9zgVyJ4ViXjNhEZb9mVYp3doNHpCa6Kk0Uy5bdXuLuB6EKKL0N0JUS-cNkoKzUSOtr1-QjG5dR6w1evLjUiILa5iPAyPfdLSknXjinEuR3upeO5WuuFXKhmoxCO0rR-Yx5QohY-OdSkM-IZkUhR1eQcl_6BnYnTNu_FwDyQ40DDV0Dq3azv2vhR0xRqWQmifOSuo4TqFVJwtSo2WbweRQaiVYQ7YJZUVhAXlna1Mm1PN4pqWijZ_3ZaKTymbm8WWEB7hG8Jg5mKMfbyc-Z6PA-zAAUJ_6vqz6WLqeTjwlwuMzw78DPaJiyeBN7GOReD5cxzMHShVn_uaxf4BU5E0QkOI5-dfAwmhnA)