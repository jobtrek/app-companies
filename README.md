# App Companies

> Une application simple pour gérer le placement des stagiaires dans les entreprises.

## Prérequis

- PHP >= 8.4 [installer PHP](https://www.php.net/downloads)
- Composer [installer Composer](https://getcomposer.org/download/)
- Docker et Docker Compose [ installer Docker](https://docs.docker.com/engine/install/)
- Git [installer Git](https://git-scm.com/downloads)

## Installation

### 1. Cloner le projet

```bash
git clone <clé-ssh-du-projet>
cd app-companies
```

> **Note :** Pour obtenir la clé SSH, allez dans **Code** (en haut à droite du repository) → **SSH** → copiez l'URL

### 2. Installer les dépendances

```bash
composer install
```

### 3. Configuration de l'environnement

Vérifiez la présence du fichier .env.example :

```bash
ls -lah
```

Copiez le fichier de configuration :

```bash
cp .env.example .env
```

Vérifiez que le fichier a été créé correctement :

```bash
cat .env
```

### 4. Générer la clé d'application

```bash
./vendor/bin/sail artisan key:generate
```

### 5. Démarrer l'environnement Docker

Arrêtez d'abord tous les conteneurs existants :

```bash
./vendor/bin/sail down -v
```

Démarrez l'application en arrière-plan :

```bash
./vendor/bin/sail up -d
```

### 6. installer pnpm

lancer l'installation en faisant: 
```bash
pnpm i
```
pour éxecuter le css du site faites:
```bash
pnpm run dev
```


### 7. Exécuter les migrations

```bash
./vendor/bin/sail artisan migrate
```

## Utilisation

Une fois l'installation terminée, l'application sera accessible à l'adresse :
- **Frontend :** http://localhost
- **Base de données :** accessible via les outils de votre choix sur le port configuré

---

### Le projet est mainteant installé
