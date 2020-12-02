<?php


namespace app\core;


abstract class DbModel extends Model
{
    abstract public function tableName(): string;
    abstruct public function attributes(): array;

    public function save()
    {
        $tableName = $this->tablename();
        $attributes = $this->attributes();
        $params = [];

        $statement = self::prepare("insert into $tableName (". implode(',', $attributes) . ") values
            (". implode(',', $params) .")
        ");
    }

    public static function prepare($sql)
    {
        return App::$app->db->pdo->prepare($sql);
    }

}