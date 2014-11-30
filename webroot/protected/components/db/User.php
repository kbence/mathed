<?php
/**
 * Created by IntelliJ IDEA.
 * User: bnc
 * Date: 11/30/14
 * Time: 16:20
 */

class User
{
    private $dbConnection;

    function __construct(CDbConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function existsWithName($name)
    {
        $command = $this->dbConnection->createCommand('SELECT id FROM user WHERE name = :username');
        $userId = $command->queryScalar(array('username' => $name));

        return $userId !== false;
    }

    public function create($name, $password)
    {
        $command = $this->dbConnection->createCommand(
            'INSERT INTO user SET name = :name, password = MD5(:password)'
        );

        return $command->execute(array('name' => $name, 'password' => $password));
    }
}