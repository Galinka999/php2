<?php


namespace app\models;


use app\engine\Db;

abstract class DbModel extends Model
{
    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstanсe()->queryAll($sql, $params = null);                      //ВЫВОДИТ МАССИВ С МАССИВАМИ
//        return Db::getInstanсe()->queryAllObject($sql, $params = null, static::class);   //ВЫВОДИТ МАССИВ С ОБЪЕКТАМИ НЕ РАБОТАЕТ!
    }

//    public static function getLimit($limit)
//    {
//        $tableName = static::getTableName();
//        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?";
//        return Db::getInstanсe()->queryLimit($sql, $limit);
//    }
    public static function getLimit($start, $limit)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT ?, ?";
        return Db::getInstanсe()->queryLimit($sql, $start, $limit);
    }

    //CRUD Active Record
    public static function getOne($id)
    {
        $tableName = static ::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id"; // используем плейсхолдер
//        return Db::getInstanсe()->queryOne($sql, ['id' => $id]);                      //ВЫВОДИТ МАССИВ
        return Db::getInstanсe()->queryOneObject($sql, ['id' => $id], static::class);   //ВЫВОДИТ ОБЪЕКТ
    }

    public function insert()
    {
        $params =[];
        $columns =[];
        foreach ($this as $key => $value)
        {
            if ($key == "id") continue;   //пропускаем поле id, оно не участвует в запросе
            $params[":{$key}"] = $value;
            $columns[] = $key;
            // var_dump($key . " => " . $value);
        }
        $columns = implode(", ", $columns);
        $values = implode(", ", array_keys($params));
        //var_dump($columns, $values);
        $tableName = static::getTableName();
        $sql = "INSERT INTO {$tableName} ($columns) VALUES ($values)";
        //var_dump($sql);
        Db::getInstanсe()->execute($sql, $params);
        $this->id = Db::getInstanсe()->lastInsertId();
        return $this;
    }

    public function update()
    {

    }

    public function delete()
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";  //$this->>id
        return Db::getInstanсe()->execute($sql, ['id' => $this->id]);
    }

    //END CRUD

    public function save()
    {
        if (is_null($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    abstract static public function getTableName();
}