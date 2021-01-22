<?
use app\core\App;
class m0001_initial
{
    public function up()
    {
        $db = App::$app->db;
        $sql = "create table user ( 
                                        id int auto_increment primary key,
                                        email varchar(255),
                                        fname varchar(255) not null,
                                        lname varchar(255) not null,
                                        status tinyint default 0,
                                        created_at timestamp default current_timestamp            
                                    ) ENGINE=INNODB;";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = App::$app->db;
        $sql = "drop table user;";
        $db->pdo->exec($sql);
    }
}
