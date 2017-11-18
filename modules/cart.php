<?php
$title = "Корзина";

if ($_POST['minus']) {
    $minus = intval($_POST['minus']);
    $_SESSION['cart']['products'][$minus] -= 1;
}

if ($_POST['plus']) {
    $plus = intval($_POST['plus']);
    $_SESSION['cart']['products'][$plus] += 1;
}

if ($_POST['delete']) {
    $delete = intval($_POST['delete']);
    $_SESSION['cart']['products'][$delete] = 0;
}

$back = "<a href='?mod=catalog'>Вернуться в каталог</a>";
$content = $back;
if ($_SESSION['cart']['qty']>0) {
    $total = 0;
    $qty = 0;
    $content .= "<table class='cart'>";
    foreach ($_SESSION['cart']['products'] as $prodId => $prodQty) {
        $result = mysqli_query($conn, "SELECT * FROM products WHERE id=".$prodId);
        if (($prod = mysqli_fetch_assoc($result)) && $prodQty > 0) {
            $content .= "<tr>
                <td><img src='".CATALOG_IMAGES_PATH."thumbnail/tn_".$prod['image']."' width='80' height='60'></td>
                <td><b>".$prod['name']."</b></td>
                <td>".$prod['price']." руб.</td>
                <td>
                    <form action='' method='POST'>
                        <input type='hidden' name='minus' value='".$prodId."'>
                        <input type='submit' value='-'>
                    </form>
                    ".$prodQty." шт.
                    <form action='' method='POST'>
                        <input type='hidden' name='plus' value='".$prodId."'>
                        <input type='submit' value='+'>
                    </form>
                </td>
                <td><b>".$prod['price']*$prodQty." руб.</b></td>
                <td>
                    <form action='' method='POST'>
                        <input type='hidden' name='delete' value='".$prodId."'>
                        <input type='submit' value='Удалить'>
                    </form>
                </td>
            </tr>";
            $total += $prod['price']*$prodQty;
            $qty += $prodQty;
        }
        else {
            unset($_SESSION['cart']['products'][$prodId]);
        }
    }
    $_SESSION['cart']['total'] = $total;
    $_SESSION['cart']['qty'] = $qty;
    $content .= "<tr><td colspan='4'></td><td><b>".$total." руб.</b></td></tr></table>";
}
if ($qty <=0) {
    $content = $back."<p>пусто</p>";
}
