<?php

require_once '/../../../php/pear/PHPUnit/Extensions/Database/TestCase.php';

class SignInViewTest extends PHPUnit_Extensions_Database_TestCase
{
    /**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
    */
    public function getConnection()
    {
        $pdo = new PDO('sqlite::memory:');
        return $this->createDefaultDBConnection($pdo, ':memory:');
    }
    
    public function getDataSet()
    {
    }
}