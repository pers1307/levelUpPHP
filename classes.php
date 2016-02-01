<?php
/**
 * classes.php
 * Пример работы с классами
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     Mediasite LLC
 * @link        http://www.mediasite.ru/
 */

class ShopProduct
{

}

$product1 = new ShopProduct();
$product2 = new ShopProduct();

var_dump($product1); // Рядом с объектов выводится его уникальный идентификатор
var_dump($product2);