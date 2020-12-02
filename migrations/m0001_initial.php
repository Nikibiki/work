<?
use app\core\App;
class m0001_initial
{
    public function up()
    {
        $db = App::$app->db;
        $sql = "create table users ( 
                                        id int auto_increment primary key,
                                        email varchar(255),
                                        fname varchar(255) not null,
                                        lname varchar(255) not null,
                                        status tinyint not null,created_at timestamp default current_timestamp            
                                    ) ENGINE=INNODB;";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = App::$app->db;
        $sql = "drop table users;";
        $db->pdo->exec($sql);
    }
}
