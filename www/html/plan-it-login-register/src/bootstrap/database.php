<?php
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection([
 'driver'    => 'mysql',
 'host'      => getenv('PHP_DB_HOST') ?: 'ID338735_petplanitdb.db.webhosting.be',
 'database'  => getenv('PHP_DB_DATABASE') ?: 'ID338735_petplanitdb',
 'username'  => getenv('PHP_DB_USERNAME') ?: 'ID338735_petplanitdb',
 'password'  => getenv('PHP_DB_PASSWORD') ?: 'cg06QJrHPw2591t559A3',
 'charset'   => 'utf8mb4',
 'collation' => 'utf8mb4_unicode_ci',
 'prefix'    => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();
