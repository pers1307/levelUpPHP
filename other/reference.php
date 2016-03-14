<?php
/**
 * reference.php
 * Пример работы со ссылками в PHP
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     Mediasite LLC
 * @link        http://www.mediasite.ru/
 */

$exampleArray = [1, 2, 3, 4, 5];

$copyObject = $exampleArray;
$referenceObject = & $exampleArray; // Передача по ссылке

function setId(& $id) // Передача по ссылке
{
}

function & getId() // Функция возвращает ссылку
{
    $id = 1;
    return $id;
}

echo '$exampleArray : ';
print_r($exampleArray);
echo '<br />';
echo '$copyObject : ';
print_r($copyObject);
echo '<br />';
echo '$referenceObject : ';
print_r($referenceObject);
echo '<br />';

// Проведем операции удаления
unset($copyObject[0]);
unset($referenceObject[4]);

echo '<br />';
echo '$exampleArray : ';
print_r($exampleArray);
echo '<br />';
echo '$copyObject : ';
print_r($copyObject);
echo '<br />';
echo '$referenceObject : ';
print_r($referenceObject);
echo '<br />';