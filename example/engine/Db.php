<?php

namespace app\engine;

use app\traits\TSingletone;

class Db
{
    use TSingletone;

    private array $config = [
        'driver' => 'mysql',
        'host' => 'localhost:3306',
        'login' => 'root',
        'password' => '',
        'database' => 'geekbrains_php1',
        'charset' => 'utf8'
    ];

    private $connection = null;   //PDO объект

    private function getConnection()
    {
        if (is_null($this->connection))
        {
           //var_dump("Осуществляю соединение с БД");
            $this->connection = new \PDO(
                $this->prepareDsnString(),    //вместо mysqli_connect() используем PDO
                $this->config['login'],
                $this->config['password']);
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->connection;
    }

    private function prepareDsnString()
    {
        return sprintf("%s:host=%s;dbname=%s; charset=%s",   // %-признак плейсхолдера, s-тип плейсхолдера
        $this->config['driver'],
        $this->config['host'],
        $this->config['database'],
        $this->config['charset']
        );
    }

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($params);
//        var_dump($stmt);
        return $stmt;  // вщзвращает PDO для дальнейшей работы
    }

    public function queryLimit($sql, $start, $limit)
    {
        //LIMIT 0, $limit   запрос от первой записи до лимит
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(2, $limit, \PDO::PARAM_INT);
        $stmt->bindValue(1, $start, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();  //вернуть результат execute
    }

    public function queryOneObject($sql, $params, $class)
    {
        $stmt = $this->query($sql, $params);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        return $stmt->fetch();                                     //возвращает объект
    }

    public function queryOne($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch();              //возвращает массив
    }

    //ВЫВОДИТ МАССИВ С ОБЪЕКТАМИ
    public function queryAllObject($sql, $params, $class)
    {
        $stmt = $this->query($sql, $params);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::PARAM_INT);
        return $stmt->fetchAll();                           //возвращает объект
    }

    //ВЫВОДИТ МАССИВ С МАССИВАМИ
    public function queryAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }


    public function execute($sql, $params = [])
    {
        return $this->query($sql, $params)->rowCount();
    }
}