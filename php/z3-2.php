<?php
$coloredText = fn($color, $text) => "<p style='color: $color'>$text</p>";
function Ru($color)
{
    return "<p style='color: $color'>Здравствуйте!</p>";
}

function En($color)
{
    return "<p style='color: $color'>Hello!</p>";
}

function Fr($color)
{
    return "<p style='color: $color'>Bonjour!</p>";
}

function De($color)
{
    return "<p style='color: $color'>Guten Tag!</p>";
}

$lang = $_GET['lang'] ?? null;
$color = $_GET['color'] ?? 'red';

if ($lang) {
    print $lang($color);
}
