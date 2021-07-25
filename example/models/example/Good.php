<?php


namespace app\models\example;


abstract class Good
{
    public $count;
    public $price;


    public function __construct($count, $price)
    {
        $this->count = $count;
        $this->price = $price;
    }

    abstract public function sum();
    abstract public function getProduct();

}


$productCifr = new app\models\example\ProductCifr(1, 100);
$productCifr->getProduct();
echo 'Стоимость ' . $productCifr->count . ' шт = ' . $productCifr->sum() . '<br>';

$productFiz = new app\models\example\ProductFiz(1, 100);
$productFiz->getProduct();
echo 'Стоимость ' . $productFiz->count . ' шт = ' . $productFiz->sum() . '<br>';

$productWeight = new app\models\example\ProductWeight(1, 100, 0.8);
$productWeight->getProduct();
echo 'Стоимость ' . $productWeight->weight . ' кг = ' . $productWeight->sum() . '<br>';