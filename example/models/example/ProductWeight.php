<?php


namespace app\models\example;


class ProductWeight extends Good
{
    public $product = 'Весовой товар';
    public $count;
    public $price;
    public $weight;

    public function __construct($count, $price, $weight)
    {
        parent::__construct($count, $price);
        $this->weight = $weight;
    }

    public function sum()
    {
        return $sum = $this->weight * $this->price;
    }
    public function getProduct()
    {
        echo $this->product . '<br>';
    }
}