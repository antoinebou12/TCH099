# Introduction à SQL

## Qu'est-ce que SQL?

SQL (Structured Query Language) est un langage utilisé pour gérer les bases de données. Il permet de créer, lire, mettre à jour et supprimer des données.

## Principales commandes SQL

### 1. **CREATE TABLE**
Crée une nouvelle table dans la base de données.

```sql
CREATE TABLE Clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'client') NOT NULL DEFAULT 'client',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### 2. **INSERT INTO**
Ajoute de nouvelles données dans une table.

```sql
INSERT INTO Clients (username, email, password, role)
VALUES ('user', 'u@u.com', '1234', 'client');
```

### 3. **SELECT**
Récupère des données de la base de données.

```sql
SELECT * FROM Clients;
```

### 4. **UPDATE**
Met à jour des données existantes dans une table.

```sql
UPDATE Clients
SET password = 'new_password'
WHERE username = 'user';
```

### 5. **DELETE**
Supprime des données d'une table.

```sql
DELETE FROM Clients
WHERE username = 'user';
```

## Types de données importants

### 1. **INT**
Un nombre entier. Utilisé pour les identifiants, les âges, etc.

### 2. **VARCHAR**
Une chaîne de caractères de longueur variable. Utilisé pour les noms, adresses e-mail, etc.

### 3. **TEXT**
Une longue chaîne de caractères. Utilisé pour des descriptions ou commentaires.

### 4. **DATE**
Stocke une date (année, mois, jour).

### 5. **TIMESTAMP**
Stocke une date et une heure.

### 6. **ENUM**
Une liste de valeurs possibles. Utilisé pour des options comme 'admin' ou 'client'.

### 7. **BOOLEAN**
Vrai ou faux (1 ou 0).
