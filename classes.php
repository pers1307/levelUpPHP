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
    // Присваивание стандартных значений
    public $title             = 'Стандартный товар';
    public $producerMainName  = 'Фамилия автора';
    public $producerFirstName = 'Имя автора';
    public $price             = 0;

    function __construct($title, $firstName, $mainName, $price)
    {
        $this->title             = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName  = $mainName;
        $this->price             = $price;
    }

    function getProducer()
    {
        return $this->producerFirstName . ' ' . $this->producerMainName;
    }
}

$product1 = new ShopProduct();
print $product1->title;

$product2 = new ShopProduct();
$product2->title             = 'Собачье сердце';
$product2->producerMainName  = 'Булгаков';
$product2->producerFirstName = 'Михаил';
$product2->price             = 5.99;
echo '<br />';
print 'Автор: ' . $product2->getProducer();


var_dump($product1); // Рядом с объектов выводится его уникальный идентификатор
var_dump($product2);