<?php

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

function vid_contents($conn, $contents)
{
    foreach ($contents as $content) {
        vid_content($conn, $content);
    }
}

function vid_structure($conn, $table_name): void
{
    $result = pg_query($conn, "select column_name, data_type from information_schema.columns where table_name = '$table_name';") or die('Ошибка запроса: ' . pg_last_error());

    print "<h4>Структура таблицы $table_name</h4>";
    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        print "<div>";
        foreach ($line as $col_value) {
            print "$col_value ";
        }
        print "</div>";
    }

    pg_free_result($result);
}

function vid_structures($conn, $structures)
{
    foreach ($structures as $structure) {
        vid_structure($conn, $structure);
    }
}

function vid_content($conn, $table_name): void
{
    $result = pg_query($conn, "select * from $table_name") or die('Ошибка запроса: ' . pg_last_error());
    print "<h4>Содержимое таблицы $table_name</h4>";
    print_result($result);
    pg_free_result($result);
}


$structures = $_GET["structure"] ?? null;
$contents = $_GET["content"] ?? null;

if ($structures) {
    vid_structures($conn, $structures);
}
if ($contents) {
    vid_contents($conn, $contents);
}
