<?php
// Почати сесію
session_start();
// Функція для додавання товару до кошика
function addToCart($name, $price, $image) {
    // Перевірити, чи існує кошик у сесії, якщо ні - створити новий
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Додати товар до кошика
    $_SESSION['cart'][] = ['name' => $name, 'price' => $price, 'image' => $image];
}

// Функція для обчислення загальної ціни товарів у кошику
function calculateTotalPrice() {
    $totalPrice = 0;
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $totalPrice += $item['price'];
        }
    }
    return $totalPrice;
}
function displayCart() {
    // Перевіряємо, чи існує масив $_SESSION['cart'] і чи він не є null
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        // Вміст кошика
        echo "<h2>Кошик: ". calculateTotalPrice()."</h2>";
        if (!empty($_SESSION['cart'])) {
            echo "<div style='display: flex; flex-wrap: wrap;'>";
            foreach ($_SESSION['cart'] as $item) {
                echo "<div style='width: 200px; margin: 10px;'>";
                echo "<img src='{$item['image']}' alt='{$item['name']}' style='width: 50px; height: 50px;'> ";
                echo "{$item['name']} - {$item['price']} грн";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<h2>Кошик порожній</h2>";
        }
    } else {
        echo "<h2>Кошик порожній</h2>";
    }
}
// Перевірити, чи натиснута кнопка "Купити"
if (isset($_POST['buy'])) {
    // Отримати дані про товар з кнопки "Купити", яку натиснув користувач
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    addToCart($name, $price, $image);
}

// Функція для відображення кнопки "Купити" для товару
function displayProduct($name, $image, $price) {
    echo "<div>";
    echo "<h2>$name</h2>";
    echo "<img src='$image' alt='$name' style='width: 200px; height: 200px;'>";
    echo "<p>Ціна: $price грн</p>";
    // Вивід кнопки "Купити" без використання інпутів
    echo "<form method='post'>";
    echo "<input type='hidden' name='name' value='$name'>";
    echo "<input type='hidden' name='price' value='$price'>";
    echo "<input type='hidden' name='image' value='$image'>";
    echo "<button type='submit' name='buy'>Купити</button>";
    echo "</form>";
    echo "</div>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кошик</title>
</head>
<body>

<h1>Кошик</h1>

<!-- Вивід кнопок "Купити" для товарів -->
<?php
// Приклад використання функції displayProduct для кожного товару
displayProduct('Продукт 1', '/iamges/pink-1.jpg', 100);
displayProduct('Продукт 2', '/iamges/pink-1.jpg', 150);
?>

<?php
 displayCart();
?>

</body>
</html>
