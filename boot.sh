docker-compose up -d
docker-compose run wordpress chown -R www-data /usr/src/wordpress/wp-content/
docker-compose run wordpress chgrp -R www-data /usr/src/wordpress/wp-content/
docker-compose run wordpress chown -R www-data ./
docker-compose run wordpress chgrp -R www-data ./
