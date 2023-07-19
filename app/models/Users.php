<?php
namespace app\models;

use app\models\Database;

class Users extends Database
{
    public static function all(): array
    {
        return Database::getAll('user');
    }

    public static function findByUsername(string $username): array
    {
        $user = Database::getOne('user', 'username', $username);
        return $user;
    }

    public static function findByUserId(string $user_id)
    {
        $user = Database::getOne('user', 'ID_user', $user_id);
        return $user;
    }

    public static function login(string $username, string $password): array
    {
        $user = Database::getOne('user', 'username', $username, 'password', $password);
        return $user;
    }

}

?>