<?php

class SessionHandlerFacadeText extends PHPUnit_Framework_TestCase
{
    private $shf;
    
    function setUp() {
        $this->shf = new SessionHandlerFacade();
    }
    
    function tearDown() {
        unset($this->shf);
    }

    function userIdProvider() {
        return array(27, 54, 100, 0);
    }
    
    function dateProvider() {
        return array();
    }
    
    /**
     * @dataProvider userIdProvider
     */
    function testSetUserId($user_id) {
        $this->shf->setUserId($user_id);
        $this->assertEquals($_SESSION['user_id'], $user_id);
        return $user_id;
    }
    
    /**
     * @depends testSetUserId
     */
    function test GetUserId($user_id) {
        $_SESSION['$user_id'] = $user_id;
        $user_id_obtained = $this->shf->getUserId();
        $this->assert($user_id, $user_id_obtained);
    }
    
    /**
     * @dataProvider dateProvider
     */
    function testSetDate($user_id) {
        $this->shf->setUserId($user_id);
        $this->assertEquals($_SESSION['user_id'], $user_id);
        return $user_id;
    }
    
    /**
     * @depends testSetUserId
     */
    function test GetUserId($user_id) {
        $_SESSION['$user_id'] = $user_id;
        $user_id_obtained = $this->shf->getUserId();
        $this->assert($user_id, $user_id_obtained);
    }
}
?>