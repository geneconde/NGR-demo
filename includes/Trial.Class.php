<?php
/**
 * Module object
 * Created by: Raina Gamboa
 */
class Trial {
	private $id_demo			= null;
	private $first_name			= null;
	private $last_name			= null;
	private $school_district	= null;
	private $state				= null;
	private $email	 			= null;
	private $date_created		= null;
	// private $date_current		= null;

	public function __construct() {}
	
	public function getTrialId() 							{ return $this->id_demo;							}
	public function getFirstName() 							{ return $this->first_name;							}
	public function getLastName() 							{ return $this->last_name;							}
	public function getDistrict() 							{ return $this->school_district;					}		
	public function getState() 								{ return $this->state;								}
	public function getEmail()								{ return $this->email;								}
	public function getDateCreated()						{ return $this->date_created;						}
	// public function getDateCurrent()						{ return $this->date_current;						}
	
	public function setTrialId($id_demo)					{ $this->id_demo			= $id_demo;				}
	public function setFirstName($first_name)				{ $this->first_name			= $first_name;			}
	public function setLastName($last_name)					{ $this->last_name			= $last_name;			}
	public function setDistrict($school_district) 			{ $this->school_district	= $school_district;		}
	public function setTown($state) 						{ $this->state				= $state;				}
	public function setEmail($email)						{ $this->email				= $email;				}
	public function setDateCreated($date_created)			{ $this->date_created		= $date_created;		}
	// public function setDateCurrent($date_current)			{ $this->date_current		= $date_current;		}
}
?>
