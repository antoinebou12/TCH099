## Utilisation de Docker

Pour exécuter l'application localement en utilisant Docker:

App: http://localhost:8001

DB: mysql:host=localhost;port=3306;dbname=mydatabase

Phpmyadmin: http://localhost:8060

Nom d'utilisateur: admin

Mot de passe: rootpassword

1. Executer la commande dans la console

```bash
docker-compose up -d --build
```

## Variables d'environnement

Créez un fichier `.env` à la racine de votre projet avec le contenu suivant:
```
DB_HOST=tch099-db
MYSQL_ROOT_PASSWORD=rootpassword
MYSQL_DATABASE=mydatabase
MYSQL_USER=user
MYSQL_PASSWORD=password
```

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
