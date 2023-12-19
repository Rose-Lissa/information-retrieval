<?php

if (isset ($_POST["site"]) && $_POST["site"] != '') {
    $site = $_POST["site"];
    header("Location: https://$site");
    exit;
}

else { // начало блока else
?>

<html> <head>
    <title> Листинг 10-9. Посылка заголовка с помощью
        функции header() </title> </head> <body>

<?php

print "<form action='{$_SERVER['PHP_SELF']}' method='post'>";

$list_sites = [
    "www.yandex.ru",
    "www.rambler.ru",
    "www.yahoo.com",
    "www.altavista.com",
    "www.google.com"
];
print "<select name='site'>";
print "<option value=''>Поисковые системы:</option>";
foreach ($list_sites as $site) {
    print "<option value='$site'>$site</option>";
}
print "</select></label>";
?>
<input type="submit" value="Перейти">
</form>
<?php
} // конец блока else
?>
</body> </html>

