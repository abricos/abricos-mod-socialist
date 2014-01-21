<?php 
/**
 * @version $Id$
 * @package Abricos
 * @subpackage Socialist
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @author Alexander Kuzmin <roosit@abricos.org>
 */

class SocialistModule extends Ab_Module {
	
	public function __construct(){
		$this->version = "0.1.1-dev";
		$this->name = "socialist";
		$this->takelink = "socialist";
		$this->permission = new SocialistPermission($this);
	}
	
	/**
	 * Получить менеджер
	 *
	 * @return SocialistManager
	 */
	public function GetManager(){
		if (is_null($this->_manager)){
			require_once 'includes/manager.php';
			$this->_manager = new SocialistManager($this);
		}
		return $this->_manager;
	}
	
}


class SocialistAction {
	
	const VIEW	= 10;
	
	const WRITE	= 30;
	
	const ADMIN	= 50;
}

class SocialistPermission extends Ab_UserPermission {
	
	public function SocialistPermission(SocialistModule $module){
		
		$defRoles = array(
			new Ab_UserRole(SocialistAction::VIEW, Ab_UserGroup::GUEST),
			new Ab_UserRole(SocialistAction::VIEW, Ab_UserGroup::REGISTERED),
			new Ab_UserRole(SocialistAction::VIEW, Ab_UserGroup::ADMIN),
			
			new Ab_UserRole(SocialistAction::WRITE, Ab_UserGroup::ADMIN),
			
			new Ab_UserRole(SocialistAction::ADMIN, Ab_UserGroup::ADMIN),
		);
		parent::__construct($module, $defRoles);
	}
	
	public function GetRoles(){
		return array(
			SocialistAction::VIEW => $this->CheckAction(SocialistAction::VIEW),
			SocialistAction::WRITE => $this->CheckAction(SocialistAction::WRITE),
			SocialistAction::ADMIN => $this->CheckAction(SocialistAction::ADMIN)
		);
	}
}

Abricos::ModuleRegister(new SocialistModule());

?>