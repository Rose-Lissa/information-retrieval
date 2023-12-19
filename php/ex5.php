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
$insert_query = "
INSERT INTO notebook (name, city, address, birthday, mail)
VALUES ('John Smith', 'New York', '123 Main St', '1990-05-15', 'john@example.com'),
    ('Alex Johnson', 'London', '456 Elm St', '1993-07-12', 'alex@example.com'),
    ('Sarah Brown', 'Paris', '789 Oak St', '1991-02-28', 'sarah@example.com');";

$result = pg_query($conn, $insert_query);
if ($result) {
    print "Вставка записей прошла успешно!";
} else {
    print "Ошибка при вставке записей";
}
include "ex-disconn.inc";
?>
</body>
</html>