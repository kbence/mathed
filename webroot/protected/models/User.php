<?php

class User extends CActiveRecord
{
    public static function model($class = __CLASS__)
    {
        return parent::model($class);
    }

    public function tableName()
    {
        return 'user';
    }

    public static function existsWithName($name)
    {
        return !!User::model()->find(array('name' => $name));
    }

    public static function create($name, $email, $password)
    {
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = md5($password);

        return $user->save();
    }
}

