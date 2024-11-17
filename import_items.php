<?php
require 'vendor/autoload.php';

$pdo = new PDO('sqlite:items.db');
$pdo->exec("CREATE TABLE IF NOT EXISTS items (id INTEGER PRIMARY KEY AUTOINCREMENT, name TEXT UNIQUE, sellIn INTEGER, quality INTEGER, imgUrl TEXT)");

$importCommand = new ImportItemsCommand($pdo);
$importCommand->execute();