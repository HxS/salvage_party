docker-compose up -d
docker-compose exec wordpress ln -s /share/themes/salvageparty /var/www/html/wp-content/themes/salvageparty
docker-compose exec wordpress chown www-data:www-data /var/www/html/wp-content/themes/salvageparty
docker-compose exec --user www-data wordpress php /var/www/html/wp-content/themes/salvageparty/wp-cli.phar plugin install custom-field-template --activate
docker-compose exec --user www-data wordpress php /var/www/html/wp-content/themes/salvageparty/wp-cli.phar plugin install contact-form-7 --activate
docker-compose exec --user www-data wordpress php /var/www/html/wp-content/themes/salvageparty/wp-cli.phar plugin install instagram-feed --activate
