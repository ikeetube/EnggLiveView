<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class platform_select extends CI_Controller
{
	
	public function index()
	{
		$tester 	= $this->input->get('testerSelect');
		$csvName = $this->input->get('csvName');
		$numSites	= $this->input->get('numSites');

		if($csvName!=''){
			if($tester=='ets364')
			{
				// $csvName = $deviceName.'_FTETS364';
				if($numSites==1)
				{
					redirect(base_url().'ETSData/single_site/'.$csvName);
				}
				else if($numSites==2)
				{
					redirect(base_url().'ETSData/dual_site/'.$csvName);
				}
				else{
					alert('invalid number of sites');
				}
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