<?php
function h_generate_pdf($data,$id){
	require_once(APPPATH .'libraries/dompdf/dompdf_config.inc.php');
	if($id&&$data){
		$CI =& get_instance();
		$email_data = $CI->comman_model->get_by('email',array('id'=>$id),false,false,true);
		foreach($data as $key=>$value){
			$email_data->subject= str_replace('{'.$key.'}', $value, $email_data->subject);
		}

		foreach($data as $key=>$value){
			$email_data->message = str_replace('{'.$key.'}', $value, $email_data->message);
		}
		//echo $email_data->message;die;
		$labref	= $data['order_number'];
		$path 	= $data['path'];
		$html 	= $email_data->message;
		//create a new dompdf instance (this is the crucial step)	
		//$this->pdf->createPDF($html,$path,$labref);
		//second wave to save pdf
		$CI->pdf = new DOMPDF();
		//render and output our pdf
		$CI->pdf->load_html($html);
		$CI->pdf->render();
		$pdf = $CI->pdf->output(array("compress" => 0));
		file_put_contents($path.$labref.'.pdf', $pdf );
		return true;
	}
	else{
		return false;
	}
	
}