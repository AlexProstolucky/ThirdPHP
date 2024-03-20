<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
// 1)
function NegativeNumbers($array) {
    if (!is_array($array)) {
        return false;
    }

    echo "Початковий масив: " . implode(', ', $array) . "<br>";

    foreach ($array as $key => $value) {
        if ($value < 0) {
            echo "<span style='color:red;'>$value</span>, ";
        } else {
            echo "$value, ";
        }
    }

    return true;
}

$array = [1, -2, 3, -4, 5];
$result = NegativeNumbers($array);

if ($result) {
    echo "<br>Операція виконана успішно!";
} else {
    echo "<br>Сталася помилка!";
}

echo "<br>";
echo "<br>";
// 2)
function convertNumberToText($number) {
    $units = array('нуль', 'один', 'два', 'три', 'чотири', 'п\'ять', 'шість', 'сім', 'вісім', 'дев\'ять');
    $teens = array('', 'одинадцять', 'дванадцять', 'тринадцять', 'чотирнадцять', 'п\'ятнадцять', 'шістнадцять', 'сімнадцять', 'вісімнадцять', 'дев\'ятнадцять');
    $tens = array('', 'десять', 'двадцять', 'тридцять', 'сорок', 'п\'ятдесят', 'шістдесят', 'сімдесят', 'вісімдесят', 'дев\'яносто');
    $hundreds = array('', 'сто', 'двісті', 'триста', 'чотириста', 'п\'ятсот', 'шістсот', 'сімсот', 'вісімсот', 'дев\'ятсот');
    $thousands = array('', 'тисяча', 'тисячі', 'тисячі', 'тисячі');

    if ($number == 0) {
        return $units[0];
    }

    $result = '';

    // Обробляємо тисячі
    $thousand = (int)($number / 1000);
    if ($thousand > 0) {
        $result .= $units[$thousand] . ' ';
        if($thousand > 5)
        {
            $result .= 'тисяч';
        }
        else $result .= $thousands[$thousand];
        $result .= ' ';
        $number %= 1000;
    }

    $hundred = (int)($number / 100);
    if ($hundred > 0) {
        $result .= $hundreds[$hundred] . ' ';
        $number %= 100;
    }

    if ($number >= 20 || $number == 10) {
        $ten = (int)($number / 10);
        $result .= $tens[$ten] . ' ';
        $number %= 10;
    }
    elseif ($number > 10)
    {
        $result .= $teens[$number - 10] . ' ';
        $number = 0;
    }

    if ($number > 0) {
        $result .= $units[$number] . ' ';
    }

    return trim($result);
}

$number = 1011;
$text = convertNumberToText($number);
echo "$number — $text";



// 3)

function generateDivsWithCoordinates($count) {
    if ($count == 0) {
        return;
    }

    $left = rand(0, 500);
    $top = rand(0, 500);

    echo "<div style=\"position: absolute; left: {$left}px; top: {$top}px; width: 50px; height: 50px; background-color: grey;\"></div>";

    generateDivsWithCoordinates($count - 1);
}

generateDivsWithCoordinates(10);
?>
</body>
</html>