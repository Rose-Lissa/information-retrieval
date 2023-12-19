
<?php
$array = array("cnum" => "2001", "cname" => "Hoffman", "city" => "London", "snum" => "1001", "raiting" => "100");

$array_to_string = function ($array) {
    $string = "[";
    foreach($array as $key => $value) {
       $string .= "$key: $value, ";
    }
    $string .= "]";
    return $string;
};

$print_array = function ($array) use ($array_to_string){
    print "<p>[";
    foreach($array as $key => $value) {
        print "$key => $value, ";
    }
    print "]</p>";
};


$print_array($array);
ksort($array);
$print_array($array);
asort($array);
$print_array($array);
sort($array);
$print_array($array);
