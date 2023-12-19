<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php
$align = $_POST['align'] ?? "left";
$valign = $_POST['valign'] ?? "top";

print "<table style='border: 1px solid'><tr><td style='border: 1px solid; width: 100px; height: 100px; text-align: $align; vertical-align: $valign[0]'>Текст</td></tr></table>"
?>
<form action="z4-2.php" method="POST">
    <label>Выберите горизонтальное расположение:</label>
    <label style="display: block;"><input type="radio" value="left" name="align">слева</label>
    <label style="display: block;"><input type="radio" value="center" name="align">по центру</label>
    <label style="display: block;"><input type="radio" value="right" name="align">справа</label>
    <label>Выберите горизонтальное расположение:</label>
    <label style="display: block;"><input type="checkbox" value="top" name="valign[]">сверху</label>
    <label style="display: block;"><input type="checkbox" value="middle" name="valign[]">посередине</label>
    <label style="display: block;"><input type="checkbox" value="bottom" name="valign[]">внизу</label>
    <input type="submit" name="Отправить">
</form>
</body>
</html>