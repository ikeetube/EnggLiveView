<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class platform_select_v2 extends CI_Controller
{
	
	public function index()
	{
		$tester 	= $this->input->get('testerSelect');
		$csvName = $this->input->get('csvName');
		$numSites	= $this->input->get('numSites');

		if($csvName!=''){
			if($tester=='ets364' || $tester=='ets88')
			{
				// $csvName = $deviceName.'_FTETS364';
					redirect(base_url().'DatalogController/view_data/'.$numSites.'/'.$csvName);
			}
			else{
				echo 'Unavailable yet';
			}
		}
		else{
			echo 'Invalid device name';
		}
	}

}