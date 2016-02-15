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

$product1 = new ShopProduct(1, 1, 1, 1);
print $product1->title;

$product2 = new ShopProduct('Собачье сердце', 'Булгаков', 'Михаил', 5.99);
$product2->title             = 'Собачье сердце';
$product2->producerMainName  = 'Булгаков';
$product2->producerFirstName = 'Михаил';
$product2->price             = 5.99;
echo '<br />';
print 'Автор: ' . $product2->getProducer();


var_dump($product1); // Рядом с объектов выводится его уникальный идентификатор
var_dump($product2);

// Пример определения типов
//is_null();
//is_bool();
//is_array();
//is_resource();

//Простая работа с xml
//$settings = simplexml_load_file("settings.xml");

class ShopProductWriter
{
    public function write(ShopProduct $shopProduct) // Так можно уточнить тип данных передаваемый в метод
    {
        $str = $shopProduct->title . ' : ' . $shopProduct->getProducer() . ' ' . $shopProduct->price;
        print $str;
    }

    public function isArray(array $arr)
    {
        // Проверка на массив, для остальных стандартных типов данных используем is_int и прочее
    }
}

$writer = new ShopProductWriter();
$writer->write($product2);


var_dump($writer instanceof ShopProductWriter); // Проверка принадлежности экземпляра класса к классу
var_dump(is_a($writer, 'ShopProductWriter'));