<?php
$lang = $_GET['lang'] ?? null;

if ($lang === 'ru') {
    print 'русский';
} elseif ($lang === 'en') {
    print 'английский';
} elseif ($lang === 'fr') {
    print 'французский';
} elseif ($lang === 'de') {
    print 'немецкий';
} else {
    print 'неизвестный';
}
