<?php


namespace app\core;


class Database
{
    public \PDO $pdo;

    public function __construct( array $config )
    {
        $dsn = $config['dsn'];
        $user = $config['user'];
        $password = $config['password'];
        $this->pdo = new \PDO( $dsn, $user, $password );
        $this->pdo->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = array_slice(scandir( App::$ROOT_DIR . '/migrations'), 2);

        $toApplyMigrations = array_diff( $files, $appliedMigrations );
        foreach( $toApplyMigrations as $migration ){

            require_once App::$ROOT_DIR . '/migrations/' . $migration;
            $className = pathinfo( $migration, PATHINFO_FILENAME );
            $instance = new $className();
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied migration $migration");
            $newMigrations[] = $migration;

        }

        if( !empty($newMigrations ) ){
            $this->saveMigrations( $newMigrations );
        } else {
            $this->log("All migrations are applied");
        }

    }

    public function createMigrationsTable()
    {
        $this->pdo->exec("create table if not exists migrations (
            id int auto_increment primary key,
            migration varchar(255),
            created_at timestamp default current_timestamp
        ) ENGINE=INNODB");
    }

    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("select migration from migrations");
        $statement->execute();

        return $statement->fetchAll( \PDO::FETCH_COLUMN );  //\PDO::FETCH_COLUMN позволяет получить записи в одном массиве
    }

    public function saveMigrations( array $migrations )
    {

        $str = implode(',',array_map( fn($m) => "('$m')", $migrations));

        $stmt = $this->pdo->prepare("insert into migrations (migration) values $str");
        $stmt->execute();
    }

    protected function log($message)
    {
        echo '[' . date('Y-m-d H:i:s') . '] - ' . $message . PHP_EOL;
    }
}