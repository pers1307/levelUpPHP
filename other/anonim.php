<?php

// Функции обратного вызова помогают добавлять новую функциональность в класс,
// без его непосредственного вскрытия

class Product
{
    public $name;
    public $price;

    function __construct($name, $price)
    {
        $this->name  = $name;
        $this->price = $price;
    }
}

class ProcessSale
{
    private $callbacks;

    function registerCallback($callback)
    {
        if (!is_callable($callback)) {
            throw new \Exception('Функция не вызываемая');
        }

        $this->callbacks[] = $callback;
    }

    function sale($product)
    {
        echo $product->name . ': обрабатывается ...';

        foreach ($this->callbacks as $callback) {
            call_user_func($callback, $product);
        }
    }
}

$logger = create_function('$product', 'echo "Записываем " . $product->name;');
$logger2 = function($product) {
    echo 'Отписываем ' . $product->name;
};
$processor = new ProcessSale();
$processor->registerCallback($logger);
$processor->registerCallback($logger2);

$processor->sale(new Product('Туфли', 6));
echo '<br />';
$processor->sale(new Product('Кофе', 6));

// Использование внешних переменных как контекст при выполнении анонимной функции
$amt = 7;
$count = 0;
$zamikanie = function ($product) use ($amt, &$count){
    $count += $product->price;
    echo 'Сумма ' . $count;

    if ($count > $amt) {
        echo $count;
    }
};

//echo get_class($processor); // возвращает тип класса
//print_r(get_declared_classes());
//print_r(get_class_methods('ProcessSale'));
// get_class_vars()
// get_parent_class // is_subclass_of($prod, 'название родителя')