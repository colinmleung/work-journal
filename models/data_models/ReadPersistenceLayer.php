<?php
require_once __DIR__.'/PersistenceLayer.php';
require_once __DIR__.'/TCO.php';

class ReadPersistenceLayer extends PersistenceLayer
{
	function getReading() {
		return $this->sh->getReading();	
	}
	
	function setReading($num_days) {
		$user_id = $this->sh->getUserId();
		$date = $this->sh->getDate();
		for ($i = 0; $i < $num_days; $i++) {
			$this->retrieveEntry($reading[$i], $date);
            $date = date("Y-m-d", strtotime($date . "- 1 day"));
		}
		$this->sh->setReading($reading);
	}
    
	function retrieveEntry(&$entries, $date) {
        
		$user_id = $this->sh->getUserId();
		$tco = new TCO;
		$search_query = "SELECT header, response FROM workjournal_entry WHERE user_id = '$user_id' AND date = '$date'";
		$qro = new QRO($this->dao->query($search_query));
        if ($qro->numRows() > 0) {
            $numRows = $qro->numRows();
            $entries['header'] = array();
            $entries['response'] = array();
            for ($i = 0; $i < $numRows; $i++) {
                $row = $qro->fetchRow();
                array_push($entries['header'], $row[0]);
                array_push($entries['response'], $row[1]);
            }
            return true;
        }
	}

    function signOut() {
        $this->sh->deleteUserId();
		$this->sh->deleteUserName();
		/*$this->ch->deleteUserId($row['user_id']);
        $this->ch->deleteUserName($row['username']);*/
    }
}
?>