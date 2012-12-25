<?php
require_once __DIR__.'/PersistenceLayer.php';
require_once __DIR__.'/TCO.php';

class TemplatesPersistenceLayer extends PersistenceLayer
{
    function getTemplateNames() {
        $user_id = $this->sh->getUserId();
        $search_query = "SELECT template_name FROM workjournal_template WHERE user_id = '$user_id'";
        $qro = new QRO($this->dao->query($search_query));
//        var_dump($qro);
        if (!$qro) {
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
    
    function createNewTemplate() {
         $template = array("name" => "template_name", "header" => array(0 => ""));
         return $template;
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
		$search_query = "SELECT * FROM workjournal_template WHERE user_id = '$user_id' AND template_name = '$template[name]'";
		$qro = new QRO($this->dao->query($search_query));
        // TEMPLATE_EXISTS = 1
		if ($qro->numRows() != 1) {
			$template_header = $tco->Array2String($template['header']);
			$insert_query = "INSERT INTO workjournal_template (user_id, template_name, header) VALUES ('$user_id', '$template[name]', '$template_header')";
			$this->dao->query($insert_query);
            // get the template id
            $search_query = "SELECT template_id FROM workjournal_template WHERE user_id = '$user_id' AND template_name = '$template[name]'";
            $qro = new QRO($this->dao->query($search_query));
            $row = $qro->fetchArray();
            $this->sh->setWorkingTemplateId($row['template_id']);
			return true;
		} else {
			$error_msg = 'Template name taken.';
			return false;
		}
	}

	function deleteTemplate() {
        $template_id = $this->sh->getWorkingTemplateId();
		$user_id = $this->sh->getUserId();
		$delete_query = "DELETE FROM workjournal_template WHERE user_id = '$user_id' AND template_id = '$template_id'";
		$qro = new QRO($this->dao->query($delete_query));
		// TEMPLATE_DELETED = 1
		if ($qro == false) {
			$error_msg = 'Template does not exist.';
			return false;
		}
        $this->sh->deleteWorkingTemplateId();
		return true;
	}
    
    function signOut() {
        $this->sh->clearAll();
    }
    
    function addTemplateHeader($template) {
        $template['header'][] = "";
        $this->setWorkingTemplate($template);
    }
    
    function deleteTemplateHeader($delete_array, $template) {
        $index = array_search("Delete", $delete_array);
        $template_count = count($template['header']);
        for ($i = $index; $i < $template_count - 1; $i++) {
            $template['header'][$i] = $template['header'][$i+1];
        }
        array_pop($template['header']);
        $this->sh->setWorkingTemplate($template);
    }
    
    /*function setTemplateId($template_id) {
        $this->sh->setWorkingTemplateId($template_id);
    }*/
    
    function checkTemplateId() {
        return isset($_SESSION['template_id']);
    }
    
    function clearWorkspace() {
        $this->sh->clearTemplatesWorkspace();
    }
}
?>