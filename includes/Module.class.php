<?php
/**
 * Module object
 * Created by: Raina Gamboa
 */
class Module {
	private $module_id			= null;
	private $module_name		= null;
	private $module_desc		= null;

	public function __construct() {}
	
	public function getModuleid() 						{ return $this->moduleid;			}	
	public function getModule_name() 					{ return $this->module_name;		}	
	public function getModule_desc() 					{ return $this->module_desc;		}
	
	public function setModuleid($module_id) 			{ $this->moduleid 			= $module_id;			}
	public function setModule_name($module_name) 		{ $this->module_name 		= $module_name;			}
	public function setModule_desc($module_desc) 		{ $this->module_desc 		= $module_desc;			}	
}
?>