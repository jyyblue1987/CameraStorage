<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter PDF Library
 *
 * Generate PDF's in your CodeIgniter applications.
 *
 * @package			CodeIgniter
 * @subpackage		Libraries
 * @category		Libraries
 * @author			Chris Harvey
 * @license			MIT License
 * @link			https://github.com/chrisnharvey/CodeIgniter-PDF-Generator-Library
 */

require_once(dirname(__FILE__) . '/dompdf/dompdf_config.inc.php');

class Pdf extends DOMPDF
{
	/**
	 * Get an instance of CodeIgniter
	 *
	 * @access	protected
	 * @return	void
	 */
	protected function ci()
	{
		return get_instance();
	}

	/**
	 * Load a CodeIgniter view into domPDF
	 *
	 * @access	public
	 * @param	string	$view The view to load
	 * @param	array	$data The view data
	 * @return	void
	 */
	public function createPDF($html,$path, $filename='', $stream=TRUE){  
		$this->load_html($html);
		$this->render();
		$this->set_paper('a4', 'potratit');
		if ($stream) {
			//$this->stream($filename.".pdf"); - This works just ok
			file_put_contents($path.$filename.".pdf", $this->output()); 

		} else {
			return $this->output();
		}
	}	

	public function load_view($view, $data = array())
	{
		$html = $this->ci()->load->view($view, $data, TRUE);

		$this->load_html($html);
	}
}