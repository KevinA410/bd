<?php
require_once '../DB.php';
require_once '../model/User.php';

class CrudUser
{
    # Constructor
    public function __construct()
    {
    }

    # Insert
    public static function insert(User $user)
    {
        $db = DB::connect();
        $query = 'INSERT INTO users (username, email, password) VALUES(:username, :email, :password)';

        $insert = $db->prepare($query);
        $insert->bindValue('username', $user->getUsername());
        $insert->bindValue('email', $user->getEmail());
        $insert->bindValue('password', $user->getPassword());
        $insert->execute();
    }

    # Delete
    public function delete(string $id)
    {
        $db = DB::connect();
        $query = 'DELETE FROM users WHERE id=:id';

        $delete = $db->prepare($query);
        $delete->bindValue('id', $id);
        $delete->execute();
    }

    # Update
    public function update(User $user)
    {
        $db = DB::connect();
        $query = 'UPDATE users SET username=:username, password=:password, avatar=:avatar WHERE id=:id';

        $update = $db->prepare($query);
        $update->bindValue('username', $user->getUsername());
        $update->bindValue('password', $user->getPassword());
        $update->bindValue('avatar', $user->getAvatar());
        $update->execute();
    }

    # Select 
    public static function select(string $column, string $value): NULL|User
    {
        $db = DB::connect();
        $query = "SELECT * FROM users WHERE $column=:value";

        $select = $db->prepare($query);
        $select->bindValue('value', $value);
        $select->execute();

        $user = $select->fetch();

        if(!$user)
            return NULL;

        return User::factory(
            $user['id'],
            $user['username'],
            $user['email'],
            $user['password'],
            $user['avatar'],
            $user['registration_date']
        );
    }
}
