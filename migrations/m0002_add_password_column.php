<?
use app\core\App;
class m0002_add_password_column
{
    public function up()
    {
        $db = App::$app->db;
        $sql = "alter table user add column password varchar(512) not null";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = App::$app->db;
        $sql = "alter table user drop column password;";
        $db->pdo->exec($sql);
    }
}
