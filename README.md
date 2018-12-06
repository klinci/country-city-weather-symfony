# Installation & Usage
- composer install
- Open file in app/config/parameters.yml see code bellow

		database_host: 127.0.0.1
		database_port: 3306
		database_name: dbname
		database_user: root
		database_password:

- Export [database.sql](https://gitlab.com/klinci/jo_test_symfony/blob/dev/database.sql)
- php bin/console server:run
- and then you can access this ip address http://127.0.0.1:8000 from your browser