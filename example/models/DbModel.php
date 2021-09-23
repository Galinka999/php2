<?php


namespace app\models;


use app\engine\Db;

abstract class DbModel extends Model
{
    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstanсe()->queryAll($sql);                      //ВЫВОДИТ МАССИВ С МАССИВАМИ
//        return Db::getInstanсe()->queryAllObject($sql, $params = null, static::class);   //ВЫВОДИТ МАССИВ С ОБЪЕКТАМИ НЕ РАБОТАЕТ!
    }

    public static function  getWhere($name, $value) {
        //собран запрос вида WHERE 'login' = 'admin'
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$name}` = :value";
        return Db::getInstanсe()->queryOneObject($sql, ['value' => $value], static::class);
    }

    public static function getCountWhere($name, $value) {
        $tableName = static::getTableName();
        $sql = "SELECT count(`id`) as count FROM {$tableName} WHERE `{$name}` = :value";
        return Db::getInstanсe()->queryOne($sql, ['value' => $value])['count'];
    }

    public static function getCount()
    {
        $tableName = static ::getTableName();
        $sql = "SELECT count(`id`) as count FROM {$tableName}";
        $total = Db::getInstanсe()->query($sql)->fetch(\PDO::FETCH_COLUMN);
        return $total;
    }

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

        foreach ($this->props as $key => $value)
        {
            $params[":{$key}"] = $this->$key;
            $columns[] = $key;
        }
        $columns = implode(", ", $columns);
        $values = implode(", ", array_keys($params));
        $tableName = static::getTableName();
        $sql = "INSERT INTO {$tableName} ($columns) VALUES ($values)";
        //INSERT INTO {$this->getTableName()}(`name`, `description`, `price`) VALUES (:name, :description, :price)
        Db::getInstanсe()->execute($sql, $params);
        $this->id = Db::getInstanсe()->lastInsertId();
        return $this;
    }

    public function update()
    {
        $params = [];
        $columns = [];

        foreach ($this->props as $key => $value) {
            if ($value) continue;
            $params[":{$key}"] = $this->$key;
            $columns[].= "`{$key}` = :{$key}";
            $this->props[$key] = false;
        }
        $columns = implode(",", $columns);
        $tableName = static::getTableName();
        $params['id'] = $this->id;
        $sql = "UPDATE `{$tableName}` SET {$columns} WHERE `id` = :id";
        Db::getInstanсe()->execute($sql, $params);
    }

    public function delete()
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM `{$tableName}` WHERE `id` = :id";  //$this->>id
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