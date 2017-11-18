<?php
//print_r($_SESSION);
//unset($_SESSION['cart']);

if ($_POST['buy']) {
    $buy = intval($_POST['buy']);
    $result = mysqli_query($conn, "SELECT price FROM products WHERE id=".$buy);
    if (mysqli_num_rows($result)) {
        $product = mysqli_fetch_assoc($result);
        $_SESSION['cart']['products'][$buy] += 1;
        $_SESSION['cart']['qty'] += 1;
        $_SESSION['cart']['total'] += $product['price'];
    }
}

if ($_SESSION['cart']['qty']) {
    $inCart = $_SESSION['cart']['qty']." ".getNumEnding($_SESSION['cart']['qty'], array("товар","товара","товаров")).
        " на ".$_SESSION['cart']['total']." руб.";
}
else {
    $inCart = "пусто";
}

$cart = "<b><a href='?mod=cart'>Корзина</a></b>:<p>".$inCart."</p>";