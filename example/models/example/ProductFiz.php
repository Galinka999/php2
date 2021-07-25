<?php


namespace app\models\example;


class ProductFiz extends Good
{
    public $product = 'Штучный товар';
    public $count;
    public $price;

    public function sum()
    {
        return $sum = $this->count * $this->price;
    }
    public function getProduct()
    {
        echo $this->product . '<br>';
    }
}
