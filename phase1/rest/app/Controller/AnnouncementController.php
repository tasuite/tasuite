<?php
class AnnouncementController extends AppController {
	public $componenets = array('RequestHandler');
	public $helpers = array('Html', 'Form', 'Text', 'Cache');
	public function index(){
		$this->set('announcements', $this->Announcement->find('all'));	
	}
	public function view($id = null, $id2 = null) {
		if($id != null){
		$announce = $this->Announcement->findAllByCompid($id);
		$this->set('announcements', $announce);
		}
		else{
			$announce = $this->Announcement->find('all');
			$this->set('announcements', $announce);
		}
		/*else{
                        $lou = $this->Student->find('all', array('conditions' => array('Louslist.mnemonic =' => $id, 'Louslist.number =' => $id2)));
		}
		$this->set('louslists', $lou);		
                if(isset($_GET['json'])){
			$this->set('var', 1);
                }
                else if(isset($_GET['xml'])){
			$this->set('var', 2);
                }
                else {
			$this->set('var', 3);
                }

            }*/
        }
    }
