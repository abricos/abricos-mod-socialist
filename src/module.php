<?php
/**
 * @package Abricos
 * @subpackage Socialist
 * @copyright 2008-2016 Alexander Kuzmin
 * @license http://opensource.org/licenses/mit-license.php MIT License
 * @author Alexander Kuzmin <roosit@abricos.org>
 */

/**
 * Class SocialistModule
 */
class SocialistModule extends Ab_Module {
    public function __construct(){
        $this->version = "0.1.2";
        $this->name = "socialist";
        $this->takelink = "socialist";
        $this->permission = new SocialistPermission($this);
    }
}

class SocialistAction {
    const VIEW = 10;
    const WRITE = 30;
    const ADMIN = 50;
}

class SocialistPermission extends Ab_UserPermission {

    public function __construct(SocialistModule $module){

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
