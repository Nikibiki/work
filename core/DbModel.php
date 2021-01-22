<?php


namespace app\core;


abstract class DbModel extends Model
{
    abstract public function tableName(): string;
    abstract public function attributes(): array;

    public function save()
    {
        $tableName = $this->tablename();
        $attributes = $this->attributes();
        $params = array_map( fn($attr) => ":$attr", $attributes);

        $statement = self::prepare("insert into $tableName (". implode(',', $attributes) . ") values
            (". implode(',', $params) .")
        ");

        foreach ( $attributes as $attribute ){
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();

        return true;
    }

    public function getUserByEmail(){
        $tableName = $this->tablename();
        $statement = self::prepare("select id from $tableName where email = '" . $this->email . "' limit 1");
        return $statement->execute();
    }

    public static function prepare($sql)
    {
        return App::$app->db->pdo->prepare($sql);
    }

}