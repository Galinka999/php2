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

    public static function  getWhere($name, $value) {
        //TODO собрать запрос вида WHERE 'login' = 'admin'
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
        $colums =[];

        foreach ($this->props as $key => $value)
        {
            $params[":{$key}"] = $this->$key;
            $colums[] = $key;
            // var_dump($key . " => " . $value);
        }
        $colums = implode(", ", $colums);
        $values = implode(", ", array_keys($params));
        //var_dump($colums, $values);
        $tableName = static::getTableName();
        $sql = "INSERT INTO {$tableName} ($colums) VALUES ($values)";
        //var_dump($sql);
        Db::getInstanсe()->execute($sql, $params);
        $this->id = Db::getInstanсe()->lastInsertId();
        return $this;
    }

    public function update()
    {
        $params =[];
        $colums =[];

        foreach ($this->props as $key => $value) {
            if ($value) continue;
            $params[":{$key}"] = $this->$key;
            $colums[].= "`{$key}` = :{$key}";
            $this->props[$key] = false;
        }
        $colums = implode(",", $colums);
        $tableName = static::getTableName();
        $params['id'] = $this->id;
        $sql = "UPDATE `{$tableName}` SET {$colums} WHERE `id` = :id";
        Db::getInstanсe()->execute($sql, $params);
        //return $this;
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