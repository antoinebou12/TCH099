# tch099-demo-web-app
Ce dépôt sera utilisé comme application web PHP démo à déployer sur le cloud Azure

## Prérequis

- Docker
- Docker Compose
- Compte Azure Student

## Fonctionnalités

- **Points de terminaison API:** Créez des points de terminaison API personnalisés pour votre application.
- **Authentification utilisateur:** Implémentez l'authentification utilisateur avec les fonctionnalités de connexion, inscription et déconnexion.
- **Intégration de base de données:** Utilisez la base de données MySQL pour stocker les données des utilisateurs et autres informations.
- **Pages Frontend:** Créez des pages frontend avec HTML, CSS et JavaScript.
- **Support Docker:** Exécutez l'application localement en utilisant Docker Compose.

### Épopée: Gestion des comptes et des profils utilisateurs

#### Histoire utilisateur: Inscription utilisateur
En tant qu'utilisateur, je veux créer un compte sur la plateforme pour pouvoir accéder aux fonctionnalités.

**Sous-tâches:**
- [x] Concevoir le formulaire d'inscription avec des champs pour le nom d'utilisateur, l'email, le mot de passe et le rôle.
- [x] Implémenter la logique backend pour gérer la soumission et la validation des données utilisateur.
- [x] Intégrer le chiffrement des mots de passe pour un stockage sécurisé.
- [x] Tester le processus d'inscription pour s'assurer qu'il fonctionne comme prévu.

#### Histoire utilisateur: Connexion utilisateur
En tant qu'utilisateur, je veux me connecter à mon compte pour pouvoir accéder à mon profil et aux autres fonctionnalités.

**Sous-tâches:**
- [x] Concevoir le formulaire de connexion avec des champs pour le nom d'utilisateur/email et le mot de passe.
- [x] Implémenter la logique d'authentification backend pour vérifier les informations d'identification de l'utilisateur.
- [x] Créer des sessions pour maintenir l'état de connexion de l'utilisateur.
- [x] Gérer les tentatives de connexion incorrectes avec des messages d'erreur appropriés.
- [x] Tester le processus de connexion pour la fonctionnalité et la sécurité.

#### Histoire utilisateur: Déconnexion utilisateur
En tant qu'utilisateur, je veux me déconnecter de mon compte pour sécuriser ma session.

**Sous-tâches:**
- [x] Ajouter une option de déconnexion dans l'interface utilisateur.
- [x] Implémenter la logique backend pour détruire les sessions utilisateur lors de la déconnexion.
- [x] Rediriger les utilisateurs vers la page d'accueil ou la page de connexion après la déconnexion.
- [x] Tester la fonctionnalité de déconnexion pour s'assurer que les sessions sont correctement terminées.

#### Histoire utilisateur: Afficher le message "Hello World"
En tant qu'utilisateur, je veux voir un message "Hello World" avec mon nom.

**Sous-tâches:**
- [x] Créer un modèle de message personnalisé.
- [x] Récupérer le nom de l'utilisateur à partir des données de session.
- [x] Afficher le message "Hello World" avec le nom de l'utilisateur sur la page.
- [x] Tester l'affichage du message pour différents scénarios utilisateur.

#### Histoire utilisateur: Afficher une image aléatoire
En tant qu'utilisateur, je veux voir une image aléatoire affichée sur la page.

**Sous-tâches:**
- [x] Sourcer une collection d'images aléatoires à partir d'une API externe.
- [x] Implémenter la logique pour sélectionner aléatoirement une image de la collection.
- [x] Afficher l'image sélectionnée dans l'interface utilisateur.
- [x] Tester la fonctionnalité d'image aléatoire pour s'assurer que différentes images sont affichées à chaque fois.

#### Histoire utilisateur: Afficher les détails de l'utilisateur
En tant qu'utilisateur, je veux voir les détails de mon profil tels que le nom d'utilisateur et l'adresse e-mail.

**Sous-tâches:**
- [x] Créer un modèle de page de profil utilisateur.
- [x] Implémenter la logique backend pour récupérer les détails de l'utilisateur à partir de la base de données.
- [x] Afficher le nom d'utilisateur et l'adresse e-mail de l'utilisateur sur la page de profil.
- [x] Tester la page de profil pour s'assurer que les données sont affichées correctement.

#### Histoire utilisateur: Connexion administrateur
En tant qu'administrateur, je veux me connecter à mon compte pour accéder aux fonctionnalités d'administration telles que la visualisation de tous les clients.

**Sous-tâches:**
- [x] Concevoir le formulaire de connexion administrateur avec des champs pour le nom d'utilisateur/email et le mot de passe.
- [x] Implémenter la logique d'authentification backend pour les informations d'identification de l'administrateur.
- [x] Créer des sessions administrateur pour maintenir l'état de connexion.
- [x] Développer le tableau de bord administrateur pour afficher les informations des clients.
- [x] Tester les fonctionnalités de connexion et de tableau de bord administrateur pour un contrôle d'accès approprié.

## Variables d'environnement

Créez un fichier `.env` à la racine de votre projet avec le contenu suivant:

```
DB_HOST=tch099-db
MYSQL_ROOT_PASSWORD=rootpassword
MYSQL_DATABASE=mydatabase
MYSQL_USER=user
MYSQL_PASSWORD=password
```

## Utilisation de Docker

Pour exécuter l'application localement en utilisant Docker:

```bash
- App: http://localhost:8001

- DB: mysql:host=localhost;port=3306;dbname=mydatabase

- Phpmyadmin: http://localhost:8060

Nom d'utilisateur: admin
Mot de passe: rootpassword
```

```
docker-compose up -d --build
```

## Initialisation de la base de données

```
cd db
python3 -m pip3 install mysql-connector-python python-dotenv
python3 db.py
```

## Structure du projet

```
/

├── api/                        # Dossier contenant les scripts de points de terminaison API
└── utils/                      # Dossier contenant les scripts utilitaires
    └── utils.php               # Fonctions utilitaires pour l'application
│   ├── hello-world.php         # Point de terminaison API pour les messages Hello World
│   ├── login.php               # Point de terminaison API pour la connexion utilisateur
│   ├── logout.php              # Point de terminaison API pour la déconnexion utilisateur
│   ├── randomimage.php         # Point de terminaison API pour obtenir une image aléatoire
│   ├── signup.php              # Point de terminaison API pour l'inscription utilisateur
│   ├── user_details.php        # Point de terminaison API pour récupérer les détails de l'utilisateur
│   └── clients.php             # Point de terminaison API pour récupérer tous les clients

├── db/                         # Dossier contenant les scripts SQL pour la configuration de la base de données
│   ├── 1create.sql             # Script SQL pour créer les tables de la base de données
│   ├── 2contraines.sql         # Script SQL pour ajouter des contraintes
│   ├── 3insert.sql             # Script SQL pour insérer les données initiales dans les tables de la base de données
│   └── db.py                   # Script Python pour créer, modifier et insérer les données initiales dans les tables de la base de données

├── frontend/                   # Dossier contenant les actifs et les pages frontend
│   ├── css/                    # Dossier contenant les fichiers CSS
│   │   └── styles.css          # Feuille de style principale pour le frontend
│   ├── images/                 # Dossier pour stocker les actifs d'image
│   ├── js/                     # Dossier contenant les fichiers JavaScript
│   │   └── script.js           # Fichier JavaScript principal pour le frontend
│   └── pages/                  # Dossier contenant les pages HTML
│       ├── hello-world.html    # Page HTML pour la fonctionnalité Hello World
│       ├── index.html          # Page HTML pour la page d'accueil
│       ├── admin.html          # Page HTML qui voit tous les clients
│       ├── login.html          # Page HTML pour le formulaire de connexion
│       ├── random-image.html   # Page HTML pour afficher une image aléatoire
│       ├── signup.html         # Page HTML pour le formulaire d'inscription
│       └── 404.html            # Page HTML pour les erreurs 404 Not Found

├── config.php                  # Fichier de configuration principal pour le projet
├── router.php                  # Fichier de routage principal pour la gestion du routage URL
├── routes.php                  # Fichier définissant les routes pour l'application
├── Dockerfile                  # Dockerfile pour construire l'image docker
├── docker-compose.yml          # Fichier de configuration Docker Compose pour configurer l'environnement de développement
├── composer.json               # Gestionnaire de dépendances PHP
├── nginx.conf                  # Configuration nginx pour le déploiement Azure
```

## Acteurs

- **Utilisateur:** Un utilisateur qui interagit avec l'application en se connectant, s'inscrivant et accédant à diverses fonctionnalités.
- **Administrateur:** Un utilisateur avec des privilèges élevés qui peut gérer les utilisateurs et d'autres aspects de l'application.

## Cas d'utilisation

![Cas d'utilisation](https://www.plantuml.com/plantuml/dpng/PP51QiGm34NtFeMOVQzGPfZ242WKMjnj4Oam1bi9jaolNyUDgnJlelSYyhzopO99IWm6PraJs4pfUBmjqRCn9TECcU3ouHs3tIw06UpzQn_jflfrTJ1njtMQ-BzyAtAoTLBzwUcxVHfUID27t5_SnSuFh1iFOaee18z499vTt-YYy_EAm3loiaQO8ZhI3Vd5ZPuB4y4j1BW7Jon_cIgkz836jDXFptgIJlGC7MXp9KD5LKCNTMFgzhUg6nDUYPSImmy0)

## Diagramme de classe

![Diagramme de classe](https://www.plantuml.com/plantuml/dpng/RSnD2W8n38RXVK-HlNY70GyYeGqOIDgQ7rs8TzTk1i5Pvdd3jtcWHQgKAkWE5s7guV0g02Tky42hDpJ0Z77cNetqsrTC9-kejBzavtlIIgJ8Sk0JtP_3zjLbDeH-xsg4GUsA0S5A7gXpUSxsx--oKM-fyW40)

## Points de terminaison API

### Authentification utilisateur

#### Connexion

**Point de terminaison:** `/api/login.php`

![Diagramme de séquence de connexion](https://www.plantuml.com/plantuml/dpng/ROv1QyCm38Nl-XMYf_RGvPx3w49M60nQs7OR3CrH6uEZ65l-_xCNvYxGwzEdzxv3L0gQ9WTaT0xu4Ja0-9nPOps9ukOOPb6MuLEsRhvQUHXrShiDKiJZyzThYTOFJ-UNolhHBsWExx4zANrJvFnWPhdOw-sZxm2W-E3-iIwrUF8iU1E1lqkXwaYBvzFREpRaRLD5e9mhstVjKbCcjZleEzolAtwtAUd8aeL9UVZVi99QifYCuHYR2rcN0iE1PKYJ-m40)

**Méthode:** `POST`

**Corps de la requête:**

```json
{
  "username": "exemple",
  "password": "motdepasse"
}
```

**Réponse:**

```json
{
  "status": "success",
  "message": "Connexion réussie"
}
```

#### Inscription

![Diagramme de séquence d'inscription](https://www.plantuml.com/plantuml/dpng/RP2_JiD03CPtFuNLgHrAzWoeHA4IKoiA6n8o5pSzANLEjlF-v8hK8uZry-_x8-_CINsw3a31HyLtOmL8inP3J2IEgxsEuYpTXwmjzZAbXujVXyqAoN3__7cwQKlBq_6bqEcIVk1P_PTkoUcBZ6TB6EKS-s9f6u0y2RUFfQl6GsB1NsFWVijWwQdnU3YzOKKfLcKD523ZRLEZSX_DMNFNUWDjWzi_GVbonxXRP2p7lTuW9O-Ze4qXi5brfZXCoW0xbcv-zpS0)

**Point de terminaison:** `/api/signup.php`

**Méthode:** `POST`

**Corps de la requête:**

```json
{
  "username": "exemple",
  "password": "motdepasse",
  "email": "exemple@exemple.com",
  "role": "utilisateur"
}
```

**Réponse:**

```json
{
  "status": "success",
  "message": "Inscription réussie"
}
```

#### Déconnexion

![Déconnexion](https://www.plantuml.com/plantuml/dpng/NP0nQyCm48Nt-nL7fcH8idiegQi60eK6scw1S9NLH5Gv2UaC_VcrRBUEl3vzzxs7TaaeIdjpG5fyn8za8a3eCgjj81PSxADdCToSU6cvCJ-RgzpSQe6KSFzyFkIeF7Wy7awyTVxYMzc4Q-ZHBZo_z549AnBwf6Gwk_RyPI_vOh2h6W3o85m__5TL-EIi_iRHzHTdPAgeyFZwzevR2lPk1qn0nbLTuV2OEvOhK3MkPvgHJgtM9gL2K6oQSJl3JVxJNm00)

**Point de terminaison:** `/api/logout.php`

**Méthode:** `POST`

**Réponse:**

```json
{
  "status": "success",
  "message": "Déconnexion réussie"
}
```

#### Détails de l'utilisateur

![Détails de l'utilisateur](https://www.plantuml.com/plantuml/dpng/ROu_Ry8m4CNt-nGd9XY0FKD58qF5r0xjXXHTuojOSYwMVPRQRzyO-eSGrdVtUx-tIKfHS-U1MkqZlYME0126qBKka2ZETh4NPR47cJkn_BawQUSNCwI4ksspBz4OU7pP7sIT4yV6ifBpQHLEuGmCfwOup2KVSuQKtYdn86fx-N37Wbr4fWOe72uV_gGLFWSM_Dy4lvVoTMEgy6dxYciARZ8CRbuBRUeAZwnNwNm1fiRblURpi9_2QTbeiN4fUFh2V8t0XiNcpdy3)

**Point de terminaison:** `/api/user_details.php`

**Méthode:** `GET`

**Réponse:**

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

### Admin
![Admin](https://www.plantuml.com/plantuml/dpng/TP1DIi0m48NtSugtr4NLHLU1IaLFKEW1GZhIOFfZPhBmzgQD44enYy1yx-LZI2zgewOba7MwHOp2aMZFp3k_srKnR4avtf5SqAW-2ELp2D2ybauq6FWxiIYUxRJubKvS2sBmFhFxAXCLbjFYC_3oTZnxU2GRj4xeEcXCJ01A5KrLrgZwZhKCFhpimVxWtELfrYKG1-6h-DC6-STSivjwuCb7TWhTqBwqV_9reZvV-Nz_0G00)


### Hello World

#### Obtenir le message de salutation

![Hello World](https://www.plantuml.com/plantuml/dpng/RO_DJiCm48JlVefLnI4vXDnpG2KA1IIaLlo8IoMq98jZuQmjUoDUdxe5L9TUFVFjDrv6mI3pP1NsuWAyH0fAUGnYUkEH1HQhu5Y8XoqN8rdhgYyNx70vocJB1M24rStRNGfox7fpl-NwcF2Zt_TtoG5uJSyvrQ7WEqRQoNh77qOdwg3fMgNIFAYk_fGDh3qndEvIltdgvhe6DkkdPwZHc-DnzOL5rZEfl9tuhcsW7wd_JF87fmqNfUfQgCxStk-pgGDHKEPuUkyCeuafeD1j81B3kYZ_GTcF7qdcmA1_wZ1HZAX9gINnC4_s6m00)

**Point de terminaison:** `/api/hello-world/$langue`

**Méthode:** `GET` ou `POST`

**Paramètres de requête:**

- `nom` (optionnel)
- `prenom` (optionnel)

**Réponse:**

```json
{
  "nom": "Doe",
  "prenom": "John",
  "langue": "fr",
  "message": "Bonjour le monde John Doe!"
}
```

### Image aléatoire

![Image aléatoire](https://www.plantuml.com/plantuml/dpng/RP31IiGm48RlynJ3ddOFwzxt85NQIa5GYhqLP6nZ6sWc8Pc-lsaLDUqUP-R_-7uc2q9UPZC1TM8zDa5v01TtkjEEMF1GUikYk6_vw8bxQyxQqA3kHZ7JwO0Ki2pUw_MIWW-lLSkNX76ZMubu-a6gPPzoEGbzK51Hs5d-rCE2VPloHu2b8fxl_wnNV76ASLSEVXCnlbLUyQbummivlMi8c-XDUb3oRsxgv-DfpwKjQoMpPrmz60d8ubVZwxy0)

**Point de terminaison:** `/api/random-image`

**Méthode:** `GET`

**Réponse:**

Une URL d'image aléatoire.

## Déploiement sur Azure avec le portail

### Diagramme de déploiement

![Diagramme de déploiement](https://www.plantuml.com/plantuml/dpng/XP5FImCn44Vlyob-vk9fmMjxa2vhiOTQjksg1_6GPaSCngJcZwAotzsD4A5GwTp2UxnCo2n4wMDwDNJMyvEsZCsywUhLzN8EPMG8H595vt4Rs1Cfur8FKNybpsZoGU2RC8vrFKFSwJ4c3LOSFvn_AV2Ft_CEM_Rlx0igyz0kMcHSx_T6Ancriu_560uhLpBAdGpyN-hcSxjUebXJHFLyCPbKuTS-Z0uq49sZSTQoodS6oYz5LLqUNmbJY4NNjTZmM-8GWw3ZNYwSs2It2iCwiTSyvcPi-_53VW00)

- Source 1: [https://learn.microsoft.com/fr-fr/azure/app-service/quickstart-php?tabs=cli&pivots=platform-linux](https://learn.microsoft.com/fr-fr/azure/app-service/quickstart-php?tabs=cli&pivots=platform-linux)
- Source 2: [https://learn.microsoft.com/fr-fr/azure/app-service/configure-language-php?pivots=platform-linux](https://learn.microsoft.com/fr-fr/azure/app-service/configure-language-php?pivots=platform-linux)

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
