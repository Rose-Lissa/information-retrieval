<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вывод таблицы notebook</title>
    <?php
        include 'z10-3.inc'
    ?>
</head>
<body>
<?php
include "ex-conn.inc";
global $conn;

function print_result($result)
{
    print "<table>";

    $line = pg_fetch_array($result, null, PGSQL_ASSOC);
    print "<tr>";
    foreach ($line as $col_name => $col_value) {
        print "<th>$col_name</th>";
    }
    print "</tr>";
    do {
        print "<tr>";
        foreach ($line as $col_value) {
            print "<td>$col_value</td>";
        }
        print "</tr>";
    } while ($line = pg_fetch_array($result, null, PGSQL_ASSOC));
    print "</table>";
}

function vid_content($conn, $table_name): void
{
    $result = pg_query($conn, "select * from $table_name") or die('Ошибка запроса: ' . pg_last_error());
    print "<h4>Содержимое таблицы $table_name</h4>";
    print_result($result);
    pg_free_result($result);
}

vid_content($conn, "notebook");
include "ex-disconn.inc";
?>
</body>
</html>