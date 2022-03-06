<?php
require ('config.php');


spl_autoload_register(function (string $className) {
    require  ('class/'.$className . '.php');
});

session_start();

$dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);

$layoutStrony = new LayoutStrony();
