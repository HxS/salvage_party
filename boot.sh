docker-compose up -d
docker-compose exec wordpress ln -s /share/themes/salvageparty /var/www/html/wp-content/themes/salvageparty
docker-compose exec wordpress chown www-data:www-data /var/www/html/wp-content/themes/salvageparty
