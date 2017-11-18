<?php
$title = "Отзывы";

if ($_POST['add']) {
    $name = mysqli_real_escape_string($conn, (string)htmlspecialchars(strip_tags($_POST['nickname'])));
    $body = mysqli_real_escape_string($conn, (string)htmlspecialchars(strip_tags($_POST['feedback'])));
    $values = "feedback='$body'" . ($name ? ", nickname='$name'" : "");
    mysqli_query($conn, "INSERT INTO feedback SET $values");
}
$content = "<div>";

$result = mysqli_query($conn, "SELECT * FROM feedback");
while ($feedback = mysqli_fetch_assoc($result)) {
    $content .= "<div class='feedback'><div><span>".$feedback['nickname']."</span><a name='".$feedback['id']."' href='#".$feedback['id']."'>#</a><p>".$feedback['feedback']."</p></div></div>\n";
}
$content .= "</div>
<form action='' method='POST'>
    <fieldset class='feedback-form'>
        <legend>Оставить отзыв</legend>
        <div>
            <p><input name='nickname' type='text' placeholder='Введите ваше имя'></p>
            <p><textarea name='feedback' cols='60' rows='10' placeholder='Введите ваш отзыв' required></textarea></p>
            <p><input type='submit' name='add'></p>
        </div>
    </fieldset>
</form>";