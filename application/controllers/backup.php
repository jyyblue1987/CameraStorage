<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backup extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form','date'));	
		$this->load->library(array('form_validation','session','excel'));
		$this->load->helper('cookie');
		$this->load->model(array('comman_model'));
	}

	function backup_db(){
		$this->load->dbutil();
		
		/*        $prefs = array(     
				'format'      => 'zip',             
				'filename'    => 'my_db_backup.sql'
			  );
		
		*/
		$prefs = array(
			'format'      => 'txt',             // gzip, zip, txt
			'filename'    => 'mybackup.sql',    // File name - NEEDED ONLY WITH ZIP FILES
			'newline'     => "\n"               // Newline character used in backup file
		  );
		
		$backup =& $this->dbutil->backup($prefs); 
		
		$db_name = 'sql_'. date("d-m-Y") .'.sql';
		$save = 'backupdb/'.$db_name;
		
		$this->load->helper('file');
		if (!is_dir('backupdb')) {
 		   mkdir('backupdb', 0777, TRUE);
		}
		if ( !write_file($save, $backup)){
			 echo 'Unable to write the file';
		}
		else{
			 echo 'File written!';
		}		
		/*        $this->load->helper('download');
		force_download($db_name, $backup); */
		die;
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */