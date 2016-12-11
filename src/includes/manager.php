<?php
/**
 * @package Abricos
 * @subpackage Socialist
 * @copyright 2008-2016 Alexander Kuzmin
 * @license http://opensource.org/licenses/mit-license.php MIT License
 * @author Alexander Kuzmin <roosit@abricos.org>
 */

/**
 * Class SocialistManager
 */
class SocialistManager extends Ab_ModuleManager {
	
	/**
	 * @var SocialistModule
	 */
	public $module = null;
	
	/**
	 * @var SocialistManager
	 */
	public static $instance = null; 
	
	public function __construct(SocialistModule $module){
		parent::__construct($module);
		
		SocialistManager::$instance = $this;
	}
	
	public function IsAdminRole(){
		return $this->IsRoleEnable(SocialistAction::ADMIN);
	}
	
	public function IsWriteRole(){
		if ($this->IsAdminRole()){ return true; }
		return $this->IsRoleEnable(SocialistAction::WRITE);
	}
	
	public function IsViewRole(){
		if ($this->IsWriteRole()){ return true; }
		return $this->IsRoleEnable(SocialistAction::VIEW);
	}
	
	public function AJAX($d){
		switch($d->do){
			case 'init': return $this->BoardData();
		}
		return null;
	}
	
	public function ToArray($rows, &$ids1 = "", $fnids1 = 'uid', &$ids2 = "", $fnids2 = '', &$ids3 = "", $fnids3 = ''){
		$ret = array();
		while (($row = $this->db->fetch_array($rows))){
			array_push($ret, $row);
			if (is_array($ids1)){ $ids1[$row[$fnids1]] = $row[$fnids1]; }
			if (is_array($ids2)){ $ids2[$row[$fnids2]] = $row[$fnids2]; }
			if (is_array($ids3)){ $ids3[$row[$fnids3]] = $row[$fnids3]; }
		}
		return $ret;
	}
	
	public function ToArrayId($rows, $field = "id"){
		$ret = array();
		while (($row = $this->db->fetch_array($rows))){
			$ret[$row[$field]] = $row;
		}
		return $ret;
	}
	
	public function BoardData(){
		if (!$this->IsViewRole()){ return null; }
		$ret = new stdClass();
		return $ret;
	}

	/**
	 * Получить блок из шаблона brick/line.html
	 * 
	 * Внимание: Использовать метод только в скриптах кирпичей
	 * 
	 * @param mixed $d Свойства: url - полная ссылка на страницу, uri - часть url, title - для твитеттера и т.п.
	 */
	public function LikeLineHTML($d){
		if (!is_array($d)){
			$d = array();
		}
		
		if (empty($d['url'])){
			$host = $_SERVER['HTTP_HOST'] ? $_SERVER['HTTP_HOST'] : $_ENV['HTTP_HOST'];
			$d['url'] = "http://".$host.$d['uri'];
		}
		
		$brick = Brick::$builder->LoadBrickS("socialist", "line");
		
		$d["titleuri"] = urlencode($d["title"]);
		$html = Brick::ReplaceVarByData($brick->content, $d);
		
		return $html;
	}
	
}
