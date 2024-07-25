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
