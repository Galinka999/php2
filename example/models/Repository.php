<?php


namespace app\models;


use app\engine\Db;

abstract class Repository
{
    abstract protected function getTableName();
    abstract protected function getEntityClass();


    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstanсe()->queryAll($sql);                      //ВЫВОДИТ МАССИВ С МАССИВАМИ
//        return Db::getInstanсe()->queryAllObject($sql, $params = null, static::class);   //ВЫВОДИТ МАССИВ С ОБЪЕКТАМИ НЕ РАБОТАЕТ!
    }

    public function  getWhere($name, $value) {
        //собран запрос вида WHERE 'login' = 'admin'
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$name}` = :value";
        return Db::getInstanсe()->queryOneObject($sql, ['value' => $value], $this->getEntityClass());
    }

    public function getCountWhere($name, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT count(`id`) as count FROM {$tableName} WHERE `{$name}` = :value";
        return Db::getInstanсe()->queryOne($sql, ['value' => $value])['count'];
    }

    public function getCount()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT count(`id`) as count FROM {$tableName}";
        $total = Db::getInstanсe()->query($sql)->fetch(\PDO::FETCH_COLUMN);
        return $total;
    }

    public function getLimit($start, $limit)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT ?, ?";
        return Db::getInstanсe()->queryLimit($sql, $start, $limit);
    }

    //CRUD Active Record

//$good = (new GoodRepository())->getOne($id);
    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id"; // используем плейсхолдер
//        return Db::getInstanсe()->queryOne($sql, ['id' => $id]);                      //ВЫВОДИТ МАССИВ
        return Db::getInstanсe()->queryOneObject($sql, ['id' => $id], $this->getEntityClass());   //ВЫВОДИТ ОБЪЕКТ
    }


//$good = new Good('Чай' .... );
//(new GoodRepository())->save($good);
    public function insert(Model $entity)
    {
        $params =[];
        $columns =[];

        foreach ($entity->props as $key => $value)
        {
            $params[":{$key}"] = $entity->$key;
            $columns[] = $key;
        }
        $columns = implode(", ", $columns);
        $values = implode(", ", array_keys($params));
        $tableName = $this->getTableName();
        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$values})";
        //INSERT INTO {$this->getTableName()}(`name`, `description`, `price`) VALUES (:name, :description, :price)
        Db::getInstanсe()->execute($sql, $params);
        $entity->id = Db::getInstanсe()->lastInsertId();
//        return $this;
    }

//$good = (new GoodRepository())->getOne($id);
//$good->price = 44;
//(new GoodRepository())->save($good);
    public function update(Model $entity)
    {
        $params = [];
        $columns = [];

        foreach ($entity->props as $key => $value) {
            if ($value) continue;
            $params[":{$key}"] = $entity->$key;
            $columns[].= "`{$key}` = :{$key}";
            $entity->props[$key] = false;
        }
        $columns = implode(",", $columns);
        $tableName = $this->getTableName();
        $params['id'] = $entity->id;
        $sql = "UPDATE `{$tableName}` SET {$columns} WHERE `id` = :id";
        Db::getInstanсe()->execute($sql, $params);
    }

//$good = (new GoodRepository())->getOne($id);
//(new GoodRepository())->delete($good);
    public function delete(Model $entity)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM `{$tableName}` WHERE `id` = :id";  //$this->>id
        return Db::getInstanсe()->execute($sql, ['id' => $entity->id]);
    }

    //END CRUD

    public function save(Model $entity)
    {
        if (is_null($entity->id)) {
            $this->insert($entity);
        } else {
            $this->update($entity);
        }
    }

}