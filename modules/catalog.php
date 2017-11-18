<?php
$title = "Каталог";

if($_GET['prod']) {
    $id = intval($_GET['prod']);
    $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
    $prod = mysqli_fetch_assoc($result);
    $title .= " - ".$prod['name'];

    $content = "<a href='?mod=catalog'>Вернуться в каталог</a>
    <figure class='img'>
        <p><img src='".CATALOG_IMAGES_PATH.$prod['image']."' /></p>
        <figcaption>
            <h3>".$prod['name']."</h3><p>Цена: ".$prod['price']."</p>
            <form action='' method='POST'>
                <input type='hidden' name='buy' value='".$prod['id']."'>
                <input type='submit' value='Купить'>
            </form>
            <p>".$prod['description']."</p>
        </figcaption>
    </figure>";
}
else {
    $products = mysqli_query($conn, "SELECT * FROM products");
    while ($prod = mysqli_fetch_assoc($products)) {
        $content .= "<div class='product'><img src='" . CATALOG_IMAGES_PATH . "thumbnail/tn_" . $prod['image'] . "'>
    <span>Цена: <b>" . $prod['price'] . "</b> руб.<p>
    <form action='' method='POST'>
        <input type='hidden' name='buy' value='".$prod['id']."'>
        <input type='submit' value='Купить'>
    </form>
    </p></span>
    <a class='name' href='?mod=catalog&prod=" . $prod['id'] . "'>" . $prod['name'] . "</a><br></div>\n";
    }
}
