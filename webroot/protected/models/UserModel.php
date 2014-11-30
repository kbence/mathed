<?php

class UserModel extends CActiveRecord
{
    public $id;
    public $name;
    public $password;
    public $email;

    public function tableName()
    {
        return 'user';
    }
}

