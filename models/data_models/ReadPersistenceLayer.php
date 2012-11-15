<?php
require_once __DIR__.'/PersistenceLayer.php';
require_once __DIR__.'/../page_models/helper_models/TCO.php';

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
		}
		$this->sh->setReading($reading);
	}
    
	function retrieveEntry(&$entries, $date) {
		$user_id = $this->sh->getUserId();
		$tco = new TCO;
		$search_query = "SELECT entry_header, entry_response FROM workjournal_entry WHERE user_id = '$user_id' AND date = '$date'";
		$qro = new QRO($this->dao->query($search_query));

        $numRows = $qro->numRows();
		for ($i = 0; $i < $numRows; $i++) {
			$row = $qro->fetchRow();
			array_push($entries['header'], $row['entry_header']);
			array_push($entries['response'], $row['entry_response']);
		}
		return true;
	}

    function signOut() {
        $this->sh->deleteUserId($row['user_id']);
		$this->sh->deleteUserName($row['username']);
		$this->ch->deleteUserId($row['user_id']);
        $this->ch->deleteUserName($row['username']);
    }
}
?>