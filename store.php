<?php
session_start();

function addToCart($name, $price, $image) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = ['name' => $name, 'price' => $price, 'image' => $image];
}

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
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
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
if (isset($_POST['buy'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    addToCart($name, $price, $image);
}

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

<?php
displayProduct('Продукт 1', '/iamges/pink-1.jpg', 100);
displayProduct('Продукт 2', '/iamges/pink-1.jpg', 150);
?>

<?php
 displayCart();
?>

</body>
</html>
