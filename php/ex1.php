<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создание таблицы notebook</title>
</head>
<body>
<?php
include "ex-conn.inc";
global $conn;
$drop_if_exists_query = "DROP TABLE IF EXISTS notebook";
$create_query = "
CREATE TABLE notebook (
  id SERIAL PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  city VARCHAR(50),
  address VARCHAR(50),
  birthday DATE,
  mail VARCHAR(20) NOT NULL 
);";

pg_query($conn, $drop_if_exists_query);
$result = pg_query($conn, $create_query);
if ($result) {
    print "Таблица notebook успешно создана!";
} else {
    print "Ошибка при создании таблицы notebook";
}
include "ex-disconn.inc";
?>
</body>
</html>