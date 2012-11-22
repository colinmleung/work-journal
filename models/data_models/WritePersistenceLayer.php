<?php
require_once __DIR__.'/PersistenceLayer.php';
require_once __DIR__.'/TCO.php';

class WritePersistenceLayer extends PersistenceLayer
{
    function createNewEntry($template_name)
    {
        // find the correct template
        if ($template_name == "blank")
        {
            $this->setBlankWorkingEntry();
        } else {
            $search_query = "SELECT header FROM workjournal_template WHERE template_name = '$template_name'";
            $qro = new QRO($this->dao->query($search_query));
            $row = $qro->fetchArray();
            // insert it into the new entry
            $tco = new TCO;
            $template_raw_array = $tco->String2Array($row['header']);
            $template['name'] = $template_name;
            $template['header'] = $template_raw_array;
            $new_entry = array("header" => $template['header'],
                                        "response" => array(0 => ""));
            $new_entry['response'] = array_fill(0, count($template['header']), "");
            $this->setWorkingEntry($new_entry);
        }
    }

    function setWorkingEntry($entry) {
        $this->sh->setWorkingEntry($entry);
    }

    function insertEntry($entry) {
		$date = date('Y-m-d', strtotime(str_replace('-','/',$this->sh->getWritingDate()))); // mysql acceptable date
		$user_id = $this->sh->getUserId();
		$tco = new TCO;
		$header = $tco->Array2String($entry['header']);
		$response = $tco->Array2String($entry['response']);
		$insert_query = "INSERT INTO workjournal_entry (user_id, date, header, response) VALUES ('$user_id', '$date', '$header', '$response')";
		$this->dao->query($insert_query);
        
		//set the entry id
		$search_query = "SELECT entry_id FROM workjournal_entry WHERE user_id = '$user_id' AND date = '$date' AND header = '$header' AND response = '$response'";
		$qro = new QRO($this->dao->query($search_query));
		$row = $qro->fetchArray();
		$this->sh->setWorkingEntryId($row['entry_id']);
        $this->setWorkingEntry($entry);
		return true;
	}
	
	function retrieveWorkingEntry() {
		return $this->sh->getWorkingEntry();
	}
	
	function setBlankWorkingEntry() {
		$entry = array("header" => array(0 => ''),
							"response" => array(0 => ''));
		$this->sh->setWorkingEntry($entry);
	}

	function clearWorkingEntry() {
        $user_id = $this->sh->getUserId();
		$working_entry = $this->sh->getWorkingEntry();
		$header_count = count($working_entry['response']);
        $working_entry['response'] = array_fill(0, $header_count, "");
		$this->sh->setWorkingEntry($working_entry);
	}
	
	function checkEntryId() {
		//$entry_id = $this->sh->getWorkingEntryId();
		return isset($_SESSION['entry_id']);
	}
	
	function deleteEntry(&$error_msg) {
		$user_id = $this->sh->getUserId();
		$entry_id = $this->sh->getWorkingEntryId();
		$delete_query = "DELETE FROM workjournal_entry WHERE user_id= '$user_id' AND entry_id = '$entry_id'";;
		$qro = new QRO($this->dao->query($delete_query));
		// ENTRY_DELETED = 1
		if ($qro == null) {
			$error_msg = 'Entry does not exist.';
			return false;
		}
        $this->sh->deleteWorkingEntryId();
		return true;
	}
    
    function getDate() {
		return $this->sh->getWritingDate();
	}
    
    function getTemplateNames() {
        $user_id = $this->sh->getUserId();
        $search_query = "SELECT template_name FROM workjournal_template WHERE user_id = '$user_id'";
        $qro = new QRO($this->dao->query($search_query));
        $count = $qro->numRows();
        if ($qro->numRows() == 0) {
            return null;
        }
        else {
            $count = $qro->numRows();
            for ($i = 0; $i < $count; $i++) {
                $row = $qro->fetchRow();
                $template_names[$i] = $row[0];
            }
            return $template_names;
        }
    }
    
    function signOut() {
        $this->sh->clearAll();
    }
    
    function incrementDate() {
        $this->sh->setWritingDate(date("Y-m-d", strtotime($this->sh->getWritingDate() . "+ 1 day")));
    }
    
    function decrementDate() {
        $this->sh->setWritingDate(date("Y-m-d", strtotime($this->sh->getWritingDate() . "- 1 day")));
    }
    
    function clearWorkspace() {
       $this->sh->clearWriteWorkspace();
    }
}
?>