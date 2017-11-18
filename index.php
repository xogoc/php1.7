<?php
require "core/config.php";

$mod = $_GET['mod'] ? (string)htmlspecialchars(strip_tags($_GET['mod'])) : DEFAULT_MOD;
$content = '';
$cart = '';
$auth = '';

$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($conn, "utf8");

if ($mod && !file_exists("modules/".$mod.".php")) {
    $mod = DEFAULT_MOD;
}
session_start();
require "core/functions.php";
include "core/minicart.php";
include "core/auth.php";
require "modules/".$mod.".php";
mysqli_close($conn);
print_r($_SESSION);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>php1.7<?= $title ? " - ".$title : "" ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <table class="header">
        <tr>
            <td>
                <ul>
                    <li><a href="?mod=gallery">Галерея</a></li>
                    <li><a href="?mod=feedback">Отзывы</a></li>
                    <li><a href="?mod=catalog">Каталог</a></li>
                </ul>
            </td>
            <td><?=($mod == "cart" ? "" : $cart);?></td>
            <td><?=$auth;?></td>
        </tr>
    </table>
    <h1><?=$title;?></h1>
    <?=$content;?>
</body>
</html>