<?php
/**
 * Question object
 * Created by: Raina Gamboa
 */
class Question {
	private $qid		= null;
	private $qexid		= null;
	private $qanswer	= null;
	private $qtitle		= null;

	public function __construct() {}
	
	public function getQid() 							{ return $this->Qid;		}	
	public function getQexid() 							{ return $this->Qexid;		}	
	public function getQanswer() 						{ return $this->Qanswer;	}
	public function getQtitle() 						{ return $this->Qtitle;		}
	
	public function setQid($qid) 						{ $this->qid 		= $qid;			}
	public function setQexid($qexid)					{ $this->qexid 		= $qexid;		}
	public function setQanswer($qanswer) 				{ $this->qanswer	= $qanswer;		}	
	public function setQtitle($qtitle) 					{ $this->qtitle		= $qtitle;		}	
}
?>