#!/usr/bin/php
<?php
date_default_timezone_set('Europe/Paris');
ini_set ('display_errors', 1);
error_reporting (E_ALL | E_STRICT);


if (array_key_exists(1, $argv)) 
{
	ft_create_data_base($argv);
}
else
{
	echo "Usage : Create - Drop\n";
}

function ft_create_data_base($argv)
{

	if ($argv[1] === "Create" || $argv[1] === "Drop") 
	{
		include('../config/database.php');
	//
	//			CREATE DATABASE
	//
		if ($argv[1] === "Create")
		{
			try {
				$dbh = new PDO("mysql:host=" . $DB_DSN, $DB_USER, $DB_PASSWORD);
				$dbh->exec("CREATE DATABASE IF NOT EXISTS " . $DB_NAME . " DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;")
				or die(print_r($dbh->errorInfo(), true));
				echo "Création de la base de donnée réussie\n";
				$dbh = null;
			} catch (PDOException $e) {
				die("DB ERROR: ". $e->getMessage());
			}
	//
	//			CREATE TABLE UTILISATEUR
	//
			try {
				$dbh = new PDO("mysql:host=" . $DB_DSN . ";dbname=" . $DB_NAME . "", $DB_USER, $DB_PASSWORD);
				$dbh->exec("CREATE TABLE IF NOT EXISTS UTILISATEUR
					(
					UTI_ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					UTI_NOM VARCHAR(50) NOT NULL,
					UTI_PWD VARCHAR(1024) NOT NULL,
					UTI_MAIL VARCHAR(140) NOT NULL,
					UTI_CLE VARCHAR(1024) NOT NULL,
					UTI_ACTIF VARCHAR(1) NOT NULL
					)");
				echo "Création de la table UTILISATEUR\n";
				$dbh = null;
			} catch (PDOException $e) {
				die("DB TABLE UTILISATEUR ERROR: ". $e->getMessage());
			}
	//
	//			CREATE TABLE AIME
	//
			try {
				$dbh = new PDO("mysql:host=" . $DB_DSN . ";dbname=" . $DB_NAME . "", $DB_USER, $DB_PASSWORD);
				$dbh->exec("CREATE TABLE IF NOT EXISTS AIME
					(
					AIM_ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					AIM_ACTIF INT NOT NULL,
					IMG_ID INT NOT NULL,
					UTI_ID INT NOT NULL
					)");
				echo "Création de la table AIME\n";
				$dbh = null;
			} catch (PDOException $e) {
				die("DB TABLE AIME ERROR: ". $e->getMessage());
			}
	//
	//			CREATE TABLE COMMENTAIRE
	//
			try {
				$dbh = new PDO("mysql:host=" . $DB_DSN . ";dbname=" . $DB_NAME . "", $DB_USER, $DB_PASSWORD);
				$dbh->exec("CREATE TABLE IF NOT EXISTS COMMENTAIRE
					(
					COM_ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					COM_COM VARCHAR(1024) NOT NULL,
					COM_DATE DATETIME NOT NULL,
					IMG_ID INT NOT NULL,
					UTI_ID INT NOT NULL
					)");
				echo "Création de la table COMMENTAIRE\n";
				$dbh = null;
			} catch (PDOException $e) {
				die("DB TABLE COMMENTAIRE ERROR: ". $e->getMessage());
			}
	//
	//			CREATE TABLE IMAGE
	//
			try {
				$dbh = new PDO("mysql:host=" . $DB_DSN . ";dbname=" . $DB_NAME . "", $DB_USER, $DB_PASSWORD);
				$dbh->exec("CREATE TABLE IF NOT EXISTS IMAGE
					(
					IMG_ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					IMG_URL VARCHAR(1024) NOT NULL,
					IMG_DATE DATE NOT NULL,
					UTI_ID INT NOT NULL
					)");
				echo "Création de la table IMAGE\n";
				$dbh = null;
			} catch (PDOException $e) {
				die("DB TABLE IMAGE ERROR: ". $e->getMessage());
			}
	//
	//			CREATE TABLE FILTRE
	//
			try {
				$dbh = new PDO("mysql:host=" . $DB_DSN . ";dbname=" . $DB_NAME . "", $DB_USER, $DB_PASSWORD);
				$dbh->exec("CREATE TABLE IF NOT EXISTS FILTRE
					(
					FIL_ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					FIL_URL VARCHAR(1024) NOT NULL
					)");
				echo "Création de la table FILTRE\n";
				$dbh = null;
			} catch (PDOException $e) {
				die("DB ERROR: ". $e->getMessage());
			}
		}
	//
	//			DROP DATABASE
	//
		elseif ($argv[1] === "Drop") 
		{
			try {

				$dbh = new PDO("mysql:host=" . $DB_DSN . ";dbname=" . $DB_NAME . "", $DB_USER, $DB_PASSWORD);
				$dbh->exec("DROP DATABASE IF EXISTS Camagru")
				or die(print_r($dbh->errorInfo(), true));
				echo "Drop de la base de donnée Camagru\n";
				$dbh = null;
			} catch (PDOException $e) {
				die("DB DROP ERROR: ". $e->getMessage());
			}

		}
	}
	else
	{
		echo "Usage : Create - Drop\n";
	}
}