<?php
	// Database credentials
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', '');
	define('DB_PASSWORD', '');
	define('DB_NAME', '');

	// Attempt to connect to MySQL database
	$mysql_db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if (!$mysql_db) {
		die("Erreur: Impossible de se connecter " . $mysql_db->connect_error);
	}