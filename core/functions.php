<?php
function getNumEnding($number, $endingArray)
{
    $number = $number % 100;
    if ($number>=11 && $number<=19) {
        $ending=$endingArray[2];
    }
    else {
        $i = $number % 10;
        switch ($i)
        {
            case (1): $ending = $endingArray[0]; break;
            case (2):
            case (3):
            case (4): $ending = $endingArray[1]; break;
            default: $ending=$endingArray[2];
        }
    }
    return $ending;
}

function friendlyName($str) {
    $search = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У',
        'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к',
        'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',
        " ");
    $replace = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U',
        'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i',
        'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya',
        "_");
    return preg_replace("/[^A-Za-z0-9_\.]/", "", str_replace($search, $replace, $str));
}

function create_thumbnail($path, $save, $width, $height) {
    $info = getimagesize($path); //получаем размеры картинки и ее тип
    $size = array($info[0], $info[1]); //закидываем размеры в массив
//В зависимости от расширения картинки вызываем соответствующую функцию
    if ($info['mime'] == 'image/png') {
        $src = imagecreatefrompng($path); //создаём новое изображение из файла
    } else if ($info['mime'] == 'image/jpeg') {
        $src = imagecreatefromjpeg($path);
    } else if ($info['mime'] == 'image/gif') {
        $src = imagecreatefromgif($path);
    } else {
        return false;
    }
    $thumb = imagecreatetruecolor($width, $height); //возвращает идентификатор изображения, представляющий черное изображение заданного размера
    $src_aspect = $size[0] / $size[1]; //отношение ширины к высоте исходника
    $thumb_aspect = $width / $height; //отношение ширины к высоте аватарки
    if($src_aspect < $thumb_aspect) { //узкий вариант (фиксированная ширина) $scale = $width / $size[0]; $new_size = array($width, $width / $src_aspect); $src_pos = array(0, ($size[1] * $scale - $height) / $scale / 2); //Ищем расстояние по высоте от края картинки до начала картины после обрезки } else if ($src_aspect > $thumb_aspect) {
//широкий вариант (фиксированная высота)
        $scale = $height / $size[1];
        $new_size = array($height * $src_aspect, $height);
        $src_pos = array(($size[0] * $scale - $width) / $scale / 2, 0); //Ищем расстояние по ширине от края картинки до начала картины после обрезки
    } else {
//другое
        $new_size = array($width, $height);
        $src_pos = array(0,0);
    }
    $new_size[0] = max($new_size[0], 1);
    $new_size[1] = max($new_size[1], 1);
    imagecopyresampled($thumb, $src, 0, 0, $src_pos[0], $src_pos[1], $new_size[0], $new_size[1], $size[0], $size[1]);
//Копирование и изменение размера изображения с ресемплированием
    if($save === false) {
        return imagepng($thumb); //Выводит JPEG/PNG/GIF изображение
    } else {
        return imagepng($thumb, $save);//Сохраняет JPEG/PNG/GIF изображение
    }
}