<?php
// Acts as a facade over the statement object
class Statement {
    private $stmt;
    
    function __construct($stmt) {
        $this->stmt = $stmt;
    }
    
    function bind($args) {
        $this->stmt->bind_param("ss", $args[0], $args[1]);
    }
    
    function execute() {
        $this->stmt->execute();
    }
    
    function fetch() {
        return $this->stmt->fetch();
    }
    
    function __destruct() {
        $this->stmt->close();
    }
}
?>