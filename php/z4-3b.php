<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Памятники</title>
</head>
<body>

<?php
$answers = ["6", "9", "4", "1", "3", "2", "5", "8", "7"];
$results = array(
    9 => "великолепно знаете географию",
    8 => "отлично знаете географию",
    7 => "очень хорошо знаете географию",
    6 => "хорошо знаете географию",
    5 => "удовлетворительно знаете географию",
    4 => "терпимо знаете географию",
    3 => "плохо знаете географию",
    2 => "очень плохо знаете географию");
$mostBadResult =  "вообще не знаете географию";


$name = isset($_POST) && $_POST['name'] != "" ? $_POST['name']: "неизвестный тестируемый";

$rightAnswers = 0;
foreach ($answers as $questionNumber => $answer) {
    if ($_POST[$questionNumber] == $answer) {
        $rightAnswers++;
    }
}
$result = $results[$rightAnswers] ?? $mostBadResult;

print "Тестируемый: $name";
print "Результат: $result"
?>
</body>
</html>