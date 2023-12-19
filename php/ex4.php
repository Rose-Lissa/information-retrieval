<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Изменение таблицы notebook</title>
    <?php
    include 'z10-3.inc'
    ?>
</head>
<body>
<?php
include "ex-conn.inc";
global $conn;
?>

<form method="GET">
    <table>
        <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>city</th>
            <th>address</th>
            <th>birthday</th>
            <th>mail</th>
            <th>исправить</th>
        </tr>
        </thead>
        <tbody>
        <?php
        function print_result($result)
        {
            while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                print "<tr>";
                print "<td>" . $line['id'] . "</td>";
                print "<td>" . $line['name'] . "</td>";
                print "<td>" . $line['city'] . "</td>";
                print "<td>" . $line['address'] . "</td>";
                print "<td>" . $line['birthday'] . "</td>";
                print "<td>" . $line['mail'] . "</td>";
                print "<td><input type='radio' name='id' value='" . $line["id"] . "'></td>";
                print "</tr>";
            };
        }

        function vid_content($conn, $table_name): void
        {
            $result = pg_query($conn, "select * from $table_name") or die('Ошибка запроса: ' . pg_last_error());
            print "<h4>Изменить таблицу $table_name</h4>";
            print_result($result);
            pg_free_result($result);
        }

        vid_content($conn, "notebook");
        ?>
        </tbody>
    </table>
    <button style="margin-top: 5px" type="submit">Выбрать</button>
</form>

<form method="POST">
    <h4>Редактировать запись: </h4>
    <?php
    $id = $_GET['id'] ?? null;
    if ($id) {
        $result = pg_query($conn, "select * from notebook where id=$id") or die('Ошибка запроса: ' . pg_last_error());
        $line = pg_fetch_array($result, null, PGSQL_ASSOC);

        print "<input name='id' value='$id' type='hidden'>";
        print "<select name='field_name'>";
        print "<option value='name'>" . $line['name'] . "</option>";
        print "<option value='city'>" . $line['city'] . "</option>";
        print "<option value='address'>" . $line['address'] . "</option>";
        print "<option value='birthday'>" . $line['birthday'] . "</option>";
        print "<option value='mail'>" . $line['mail'] . "</option>";
        print "</select>";
        print "<label>введите новое значение: <input name='field_value'></label>";
        print "<button type='submit'>Заменить</button>";
    }
    ?>
</form>

<?php
$id = $_POST['id'] ?? null;
$field_name = $_POST['field_name'] ?? null;
$field_value = $_POST['field_value'] ?? null;

if ($id && $field_name && $field_value) {
   pg_query($conn, "UPDATE notebook SET $field_name='$field_value' WHERE id=$id") or die('Ошибка запроса: ' . pg_last_error());
}
?>

<?php
include "ex-disconn.inc";
?>
</body>
</html>