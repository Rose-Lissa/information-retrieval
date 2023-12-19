<?php
$i = 1;
$j = 1;
$color = "gray";
print "<table style='border: 1px solid;'>";

while ($j <= 10) {
    print "<tr>";
    while ($i <= 10) {
        $n = $i*$j;
        if ($i == $j) {
            print "<td style='background-color: $color; border: 1px solid; padding: 5px;'>$n</td>";
        } else {
            print "<td style='border: 1px solid; padding: 5px;'>$n</td>";
        }
        $i++;
    }
    print "</tr>";
    $i=1;
    $j++;
}

print "</table>";
