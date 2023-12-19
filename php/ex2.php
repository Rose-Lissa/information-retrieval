<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить запись в notebook</title>
</head>
<style>
    label {
        display: block;
        margin-bottom: 5px;
    }
</style>
<body>
<form method="POST">
    <label>Введите фамилию и имя[*]: <input name="name" required></label>
    <label>Введите город: <input name="city"></label>
    <label>Введите адрес: <input name="address"></label>
    <label>Введите дату рождения в формате ДД-ММ-ГГГГ: <input pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}"
                                                              name="birthday"></label>
    <label>Введите фамилию и имя[*]: <input type="email" name="mail" required></label>
    <button type="submit">Записать</button>
    <p>Поля помеченные [*] являются обязательными!</p>
</form>

<?php
include "ex-conn.inc";
global $conn;

$name = $_POST['name'] ?? null;
$city = $_POST['city'] ?? null;
$address = $_POST['address'] ?? null;
$birthday = $_POST['birthday'] ?? null;
$mail = $_POST['mail'] ?? null;

if ($name != null && $mail != null) {
    $insert_query = "
INSERT INTO notebook (name, city, address, birthday, mail) 
VALUES ('$name', '$city', '$address', '$birthday', '$mail')
";

    pg_query($conn, $insert_query);
}

include "ex-disconn.inc";
?>
</body>
</html>