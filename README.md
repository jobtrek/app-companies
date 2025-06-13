# App companies

> A simple application to manage trainees placement in companies.


Instruction initialisation du projet :

S'assurer que ce n'est pas sail up.
```
sail down -v
```

Copier le contenu de ".env.example" qui se trouve dans le root du projet /app-companies et le nommer ".env"


Générer une clé random dans le nouveau fichier ".env" :
```
sail artisan key:generate
```

On peut alors démarrer l'environnement : 
```
sail up -d
```

Pour finir exécuter les migrations :
```
sail artisan migrate
```