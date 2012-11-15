<?php
require_once __DIR__.'/PersistenceLayer.php';

class TemplatesPersistenceLayer extends PersistenceLayer
{
    function getTemplateNames() {
        $user_id = $this->sh->getUserId();
        $search_query = "SELECT template_name FROM workjournal_template WHERE user_id = '$user_id'";
        $qro = new QRO($this->dao->query($search_query));
        if ($qro) {
            return null;
        }
        else {
            $row = $qro->fetchArray();
            return $row['template_name'];
        }
    }
    
    function createNewTemplate() {
        return array("name" => "new", "header" => array(0 => ""));
    }
    
    function setWorkingTemplate($template) {
        $this->sh->setWorkingTemplate($template);
    }
    
    function getWorkingTemplate() {
        return $this->sh->getWorkingTemplate();
    }

	function retrieveTemplate($user_id, $template_name, &$template, &$error_msg) {
		$tco = new TCO;
		$search_query = "SELECT template_text FROM workjournal_template WHERE user_id = '$user_id' AND template_name = '$template_name'";
		$qro = new QRO($this->dao->query($search_query));
		if ($qro->numRows() == TEMPLATE_EXISTS) {
			$row = $qro->fetchArray();
			$template = $tco->String2Array($row['template_text']);
		} else {
			$error_msg = 'Template does not exist.';
			return false;
		}
	}
	
	//$template is an array of questions, with a name at index 0
	function insertTemplate($template, &$error_msg) {
		$user_id = $this->sh->getUserId();
		$tco = new TCO;
		$search_query = "SELECT * FROM workjournal_templates WHERE user_id = '$user_id' AND template_name = '$template[0]'";
		$qro = new QRO($this->dao->query($search_query));
		if ($qro->numRows() != TEMPLATE_EXISTS) {
			$template_text = $tco->Array2String($template);
			$insert_query = "INSERT INTO workjournal_templates (user_id, template_name, template_text) VALUES ('$user_id', '$template[0]', '$template_text')";
			$this->dao->query($insert_query);
			return true;
		} else {
			$error_msg = 'Template name taken.';
			return false;
		}
	}

	function deleteTemplate($template_name, &$error_msg) {
		$user_id = $this->sh->getUserId();
		$delete_query = "DELETE FROM workjournal_templates WHERE user_id = '$user_id' AND template_name = '$template_name'";
		$qro = new QRO($this->dao->query($delete_query));
		// TEMPLATE_DELETED = 1
		if ($qro->numRows() != TEMPLATE_DELETED) {
			$error_msg = 'Template does not exist.';
			return false;
		}
		return true;
	}
    
    function signOut() {
        $this->sh->deleteUserId($row['user_id']);
		$this->sh->deleteUserName($row['username']);
		$this->ch->deleteUserId($row['user_id']);
        $this->ch->deleteUserName($row['username']);
    }
    
    function addTemplateHeader() {
        $template = $this->getWorkingTemplate();
        $template['header'][] = "";
        $this->setWorkingTemplate($template);
    }
    
    function deleteTemplateHeader($delete_array) {
        $template = $this->getWorkingTemplate();
        $index = array_search("Delete", $delete_array);
        $template_count = count($template['header']);
        for ($i = $index; $i < $template_count - 1; $i++) {
            $template['header'][$i] = $template['header'][$i+1];
        }
        array_pop($template['header']);
        $this->setWorkingTemplate($template);
    }
    
    function checkTemplateId() {
        return isset($_SESSION['template_id']);
    }
}
?>