<?php

class UserModel extends CActiveRecord
{
    public $id;
    public $name;
    public $password;
    public $email;

    function __construct()
    {
    }

    public function tableName()
    {
        return 'user';
    }
}

