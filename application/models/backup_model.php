<?php
class Backup_model extends MY_Model {
    
    protected $_table_name = 'page';
   
   public $rules_lang = array();
   
    public function __construct(){
        parent::__construct();
                                  
        //Rules for languages
    }

    
    public function get_files($template_prefix)
    {
        $CI =& get_instance();        
        $templates = array();
        $templatesDirectory = opendir(APPPATH.'../assets/backup/');
        // get each template
        while($tempFile = readdir($templatesDirectory)) {
            if ($tempFile != "." && $tempFile != "..") {
				//echo substr_count($tempFile, $template_prefix);
				//echo substr($tempFile,0,-4);
                if(substr_count($tempFile, $template_prefix) > 0)
                {
                    $templates[substr($tempFile,0,-4)] = substr($tempFile, 0, -4);
                }

            }
        }
        return $templates;
    }
    
}

