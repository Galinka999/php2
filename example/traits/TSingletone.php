<?php


namespace app\traits;


trait TSingletone
{
    private static $instanсe = null; //Db объект

    /**
     * @return static
     */
    private function __construct() {}//приватный конструктор снаружи нельзя вызвать
    private function __clone() {} //запрещаем создание класса Db снаружи
    private function __wakeup() {}

    public static function getInstanсe()
    {
        if (is_null(static::$instanсe))
        {
            static::$instanсe = new static(); //создали экземпляр этого же класса Db
        }
        return static::$instanсe;
    }
}