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
		$date = $this->sh->getReadingDate();
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
            $entries['date'] = $date;
            for ($i = 0; $i < $numRows; $i++) {
                $row = $qro->fetchRow();
                $entries['header'] = array_merge((array)$entries['header'], (array)$tco->String2Array($row[0]));
                $entries['response'] = array_merge((array)$entries['response'], (array)$tco->String2Array($row[1]));
            }
            return true;
        }
	}

    function signOut() {
        $this->sh->clearAll();
    }
    
    function clearWorkspace() {
        $this->sh->clearReadWorkspace();
    }
}
?>