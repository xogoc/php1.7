<?php
$title = "Регистрация";
$reg = false;
$regError = false;

if ($_POST['reg'] && $_POST['login'] && $_POST['password']) {
    $login = mysqli_real_escape_string($conn, (string)htmlspecialchars(strip_tags($_POST['login'])));
    $password = md5($_POST['password']);
    if (mysqli_query($conn, "INSERT INTO users (login, password) VALUES ('$login', '$password')")) {
        $reg = true;
    }
    else {
        $regError = "Произошла ошибка во время регистрации";
    }

}

if ($reg) {
    $content = "<p>Вы успешно зарегистрировались!</p>";
}
else {
    $content = ($regError ? "<p>".$regError."</p>" : "")."<form action='' method='POST'>
    <p><input type='text' name='login' placeholder='Логин' pattern='^[A-Za-z][A-Za-z0-9]{3,31}$' required></p>
    <p><input type='password' name='password' placeholder='Пароль' required></p>
    <p><input type='submit' value='Зарегистрироваться' name='reg'></p>
    </form>";
}