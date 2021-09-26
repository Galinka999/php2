<?php


namespace app\models\entities;

use app\models\Model;

class Order extends Model
{
    protected $id = null;
    protected $name;
    protected $phone;
    protected $session_id;
    protected $status;

    protected $props = [
        'name' => false,
        'phone' => false,
        'session_id' => false,
        'status' => false
    ];
}