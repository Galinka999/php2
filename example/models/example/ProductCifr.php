<?php


namespace app\models\example;


class ProductCifr extends Good
{
    public $product = 'Цифровой товар';
    public $count;
    public $price;


    public function sum()
    {
        return $sum = $this->count * $this->price /2;
    }
    public function getProduct()
    {
        echo $this->product . '<br>';
    }
}