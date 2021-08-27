<br>
<p align="center">
    <img height="auto" width="50%" src="https://raw.githubusercontent.com/EpikCloudFR/mdv-login/main/assets/img/mdv_package_logo.png" />
</p>
<hr>

<p align="center">Système d'authentification aux services de MattDev</p>
<p align="center">MattDev's authentification service</p>

## Configuration en 3 étapes

1. Créez votre base de données et l'utilisateur associé. 
2. Lancez le fichier sql `sql.sql` dans la base de données concernée.
3. Configurez les champs concernant votre base de données dans `config/config.php`. Si les paramètres ne sont pas rentrés correctement, cela vous affichera un message d'erreur

## Configuration in 3 steps

1. You'll need a MySQL database to run create the users table. Create it first.
2. Run the `sql.sql` file in your MySQL database to create users table
3. The PHP script to connect to the database is in `config/config.php` directory. Replace credentials to in config.php to match your server credentials.

<hr>
> This script is based on an existant script by [@romeopeter](https://github.com/romeopeter/) : [PHP-MYSQL-LOGIN-SYSTEM](https://github.com/romeopeter/PHP-MYSQL-LOGIN-SYSTEM/)






