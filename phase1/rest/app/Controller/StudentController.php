<?php
class StudentController extends AppController {
	public $componenets = array('RequestHandler');
	public $helpers = array('Html', 'Form', 'Text', 'Cache');
	public function index(){
		$this->set('students', $this->Student->find('all'));	
	}
	public function view($id = null, $id2 = null) {
		//if($id2 == null){
        	$stud = $this->Student->findAllByCompid($id);
		$this->set('students', $stud);
		//}
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
