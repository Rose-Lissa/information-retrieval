<?php
$user = "postgres";
$password = "postgres";
$port = "5432";
$dbname = "sample";
$host = "localhost";
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
if(!$conn) {
    die("Нет соеденения с postgresql");
}


