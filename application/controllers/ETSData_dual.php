<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ETSData_dual extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        
        // Load etsdata model
        //$this->load->model('etsdata_model');
    }
    
    public function index(){
        $data = array();
        
        // // Get messages from the session
        // if($this->session->userdata('success_msg')){
        //     $data['success_msg'] = $this->session->userdata('success_msg');
        //     $this->session->unset_userdata('success_msg');
        // }
        // if($this->session->userdata('error_msg')){
        //     $data['error_msg'] = $this->session->userdata('error_msg');
        //     $this->session->unset_userdata('error_msg');
        // }

        //Load CSVReader Library
        $this->load->library('CSVReader');
        // Get Test Limits
        $pds = $this->csvreader->parse_csv(base_url()."ets_data/PDS/pds_june25.csv");
        // Get Reading
        $csvData = $this->csvreader->parse_csv(base_url()."ets_data/data/data_june25.csv");
        $testReadings  = array();
        // echo '<pre>'; 
        //     print_r($csvData);
        // echo '<pre/>';
        for($testNum=1; $testNum<count($pds);$testNum++){

            $testName[$testNum]   = $pds[$testNum]['Test Name'];
            $LSL[$testNum]        = $pds[$testNum]['LoLim'];
            $USL[$testNum]        = $pds[$testNum]['HiLim'];


            
            for($dataIndex=2; $dataIndex<=count($csvData);$dataIndex++){

                //Get only Bin 1 data
                if($csvData[$dataIndex]['Bin']==1)
                {
                    switch($csvData[$dataIndex]['ID'])
                    {
                        case 0:
                            $testReadings_s1[$dataIndex]=$csvData[$dataIndex][$testNum-1];
                            break;
                        case 1:
                            $testReadings_s2[$dataIndex]=$csvData[$dataIndex][$testNum-1];
                            break;
                    }

                }

            }

            //Site 1 Computations
            $mean_s1[$testNum]   = round(array_sum($testReadings_s1)/count($testReadings_s1),4);
            $stdDev_s1[$testNum] = round($this->getStdDev($testReadings_s1),4);

            if($stdDev_s1[$testNum]!=0){
                $cpkL_s1[$testNum]   = round(($mean_s1[$testNum]-$LSL[$testNum])/(3*$stdDev_s1[$testNum]),2);
                $cpkH_s1[$testNum]   = round(($USL[$testNum]-$mean_s1[$testNum])/(3*$stdDev_s1[$testNum]),2);
            }   

            if($stdDev_s1[$testNum]==0){
                // echo 'CPK: #DIV'.'<pre><pre/>';
                $cpk_s1[$testNum] = '999,999 (#DIV)';

            }
            else if($cpkL_s1[$testNum] > $cpkH_s1[$testNum]){
                // echo 'CPK: '.$cpkH[$testNum].'H'.'<pre><pre/>';
                $cpk_s1[$testNum] = $cpkH_s1[$testNum].'H';
            }
            else if($cpkH_s1[$testNum] > $cpkL_s1[$testNum]){
                // echo 'CPK: '.$cpkL[$testNum].'L'.'<pre><pre/>';
                $cpk_s1[$testNum] = $cpkL_s1[$testNum].'L';
            }
            else{
                $cpk_s1[$testNum] = $cpkH_s1[$testNum].'H';
            }

            //Site 2 Computations
            $mean_s2[$testNum]   = round(array_sum($testReadings_s2)/count($testReadings_s2),4);
            $stdDev_s2[$testNum] = round($this->getStdDev($testReadings_s2),4);

            if($stdDev_s2[$testNum]!=0){
                $cpkL_s2[$testNum]   = round(($mean_s2[$testNum]-$LSL[$testNum])/(3*$stdDev_s2[$testNum]),2);
                $cpkH_s2[$testNum]   = round(($USL[$testNum]-$mean_s2[$testNum])/(3*$stdDev_s2[$testNum]),2);
            }   

            if($stdDev_s2[$testNum]==0){
                // echo 'CPK: #DIV'.'<pre><pre/>';
                $cpk_s2[$testNum] = '999,999 (#DIV)';

            }
            else if($cpkL_s2[$testNum] > $cpkH_s2[$testNum]){
                // echo 'CPK: '.$cpkH[$testNum].'H'.'<pre><pre/>';
                $cpk_s2[$testNum] = $cpkH_s2[$testNum].'H';
            }
            else if($cpkH_s2[$testNum] > $cpkL_s2[$testNum]){
                // echo 'CPK: '.$cpkL[$testNum].'L'.'<pre><pre/>';
                $cpk_s2[$testNum] = $cpkL_s2[$testNum].'L';
            }
            else{
                $cpk_s2[$testNum] = $cpkH_s2[$testNum].'H';
            }

        $rowValues[$testNum] = array(
                'testName'  => $testName[$testNum],
                'meanS1'    => $mean_s1[$testNum],
                'meanS2'    => $mean_s2[$testNum],
                'stdDevS1'  => $stdDev_s1[$testNum],
                'stdDevS2'  => $stdDev_s2[$testNum],
                'cpkS1'     => $cpk_s1[$testNum],
                'cpkS2'     => $cpk_s2[$testNum],
                
            );
        }
        $data['rowValues'] = $rowValues;
        // $data['yield_s1']     = round(count($testReadings_s1)/(count($csvData)-1),4);

        // Load the list page view
        $this->load->view('ETS_dual', $data);

    }

    private function getStdDev($arr){
        $num_of_elements = count($arr); 
        $variance = 0.0; 
        
        // calculating mean using array_sum() method 
        $average = array_sum($arr)/$num_of_elements; 
        
        foreach($arr as $i) 
        { 
            // sum of squares of differences between  
            // all numbers and means. 
            $variance += pow(($i - $average), 2); 
        } 
        
        return (float)sqrt($variance/$num_of_elements); 
    }

}