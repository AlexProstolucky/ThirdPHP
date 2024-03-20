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
        return $units[0]; // для нуля повертаємо 'нуль'
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
        $number %= 1000; // Відкидаємо тисячі
    }

    // Обробляємо сотні
    $hundred = (int)($number / 100);
    if ($hundred > 0) {
        $result .= $hundreds[$hundred] . ' ';
        $number %= 100; // Відкидаємо сотні
    }

    // Обробляємо десятки та одиниці
    if ($number >= 20 || $number == 10) {
        $ten = (int)($number / 10);
        $result .= $tens[$ten] . ' ';
        $number %= 10; // Відкидаємо десятки
    }
    elseif ($number > 10) // Перевірка для чисел від 10 до 19
    {
        $result .= $teens[$number - 10] . ' '; // Використовуємо індекси в масиві $teens
        $number = 0; // Встановлюємо $number в 0, оскільки ми вже обробили десятки та одиниці
    }

    if ($number > 0) {
        $result .= $units[$number] . ' ';
    }

    return trim($result);
}

// Приклад використання:
$number = 1011;
$text = convertNumberToText($number);
echo "$number — $text";


// 3)

function generateDivsWithCoordinates($count) {
    // Базовий випадок: якщо $count дорівнює 0, виходимо з рекурсії
    if ($count == 0) {
        return;
    }

    // Генеруємо випадкові координати для div
    $left = rand(0, 500); // Випадкове число від 0 до 500
    $top = rand(0, 500); // Випадкове число від 0 до 500

    // Виводимо div з випадковими координатами
    echo "<div style=\"position: absolute; left: {$left}px; top: {$top}px; width: 50px; height: 50px; background-color: grey;\"></div>";

    // Рекурсивно викликаємо функцію для генерації наступного div
    generateDivsWithCoordinates($count - 1);
}

// Викликаємо функцію для генерації 10 div
generateDivsWithCoordinates(10);

// 4)
function displayProduct($name, $image, $price) {
    // Виводимо інформацію про продукт
    echo "<div>";
    echo "<h2>$name</h2>";
    echo "<img src='$image' alt='$name' style='width: 200px; height: 200px;'>";
    echo "<p>Ціна: $price грн</p>";
    echo "<button onclick=\"buyProduct('$name', $price)\">Придбати</button>";
    echo "</div>";
}

// Приклад використання:
$name = "Назва продукту";
$image = "/iamges/pink-1.jpg";
$price = 100;
displayProduct($name, $image, $price);

// 5)

function calculateCart($products) {
    $cart = array();

    // Проходимося по кожному продукту у вхідному масиві
    foreach ($products as $product) {
        // Отримуємо ключ, який визначає унікальний ідентифікатор продукту
        $key = $product['name'] . $product['image'];

        // Якщо такий ключ вже існує у кошику, збільшуємо лічильник та підсумкову ціну
        if (array_key_exists($key, $cart)) {
            $cart[$key]['count']++;
            $cart[$key]['total_price'] += $product['price'];
        } else { // Якщо ключ не існує, додаємо новий елемент у кошик
            $cart[$key] = array(
                'name' => $product['name'],
                'image' => $product['image'],
                'count' => 1,
                'total_price' => $product['price']
            );
        }
    }

    // Повертаємо перетворений масив продуктів у кошику
    return array_values($cart);
}

// Приклад використання:
$products = array(
    array('name' => 'Продукт 1', 'image' => '/iamges/pink-1.jpg', 'price' => 100),
    array('name' => 'Продукт 2', 'image' => '/iamges/pink-1.jpg', 'price' => 150),
    array('name' => 'Продукт 1', 'image' => '/iamges/pink-1.jpg', 'price' => 100),
    array('name' => 'Продукт 3', 'image' => '/iamges/pink-1.jpg', 'price' => 200),
    array('name' => 'Продукт 2', 'image' => '/iamges/pink-1.jpg', 'price' => 150),
);

$cart = calculateCart($products);

// Виведення результату
foreach ($cart as $item) {
    echo "Назва: " . $item['name'] . ", Зображення: " . $item['image'] . ", Кількість: " . $item['count'] . ", Загальна ціна: " . $item['total_price'] . "<br>";
}
?>
</body>
</html>