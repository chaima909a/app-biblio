# Utiliser l'image officielle de PHP avec Apache
FROM php:8.1-apache

# Activer les extensions nécessaires (si besoin)
RUN docker-php-ext-install mysqli

# Copier le code de l'application dans le dossier approprié du conteneur
COPY . /var/www/html/

# Copier un fichier de configuration Apache personnalisé (si nécessaire)
# COPY ./my-apache-config.conf /etc/apache2/sites-available/000-default.conf

# Exposer le port 80 pour l'accès HTTP
EXPOSE 80

# Démarrer Apache en mode foreground
CMD ["apache2-foreground"]
