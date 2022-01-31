<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DatalogController extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        
        // Load etsdata model
        //$this->load->model('etsdata_model');
    }
    public function index(){
        // $this->load->view('welcome_message');
        redirect(base_url());
    }
    public function view_data($numSites, $csvName){
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

        // Get Reading
        $csvData    = $this->csvreader->parse_csv(FCPATH."ets_data/data/".$csvName);
        //Remove '_data' from $csvName
        $csvName = preg_replace('/_data.csv/', '', $csvName);
        // Get Test Limits
        $pds = $this->csvreader->parse_csv(FCPATH."ets_data/PDS/".$csvName."_limits.csv");
        $binAssignment = $this->csvreader->parse_csv(FCPATH."ets_data/PDS/".$csvName."_bins.csv");

       
        // echo '<pre>'; 
        //     print_r($csvData);
        // echo '<pre/>';
        
        $data['binAssignment'] = $binAssignment;
        
        $testReadings       = array();
        $testReadings[0]    = array();
        $testReadings[1]    = array();
        $testReadings[2]    = array();
        $testReadings[3]    = array();
                
        $FT_count = 0;
        $QA_flag = 0;
        $QA_count = 0;

        if($pds==FALSE || $csvData==FALSE || $binAssignment==FALSE) {
            // $this->load->view('No_file', $file);
            echo 'Files does not exist: '.$csvName;
            return FALSE;
        }
        else {
            for($testNum=1; $testNum<count($pds)+1;$testNum++){

                $testName[$testNum]   = $pds[$testNum]['Test Name'];
                $LSL[$testNum]        = $pds[$testNum]['LoLim'];
                $USL[$testNum]        = $pds[$testNum]['HiLim'];
                
                $bins = [array_fill(0, 35, 0), array_fill(0, 35, 0), array_fill(0, 35, 0), array_fill(0, 35, 0)]; //$bin[site][bin_number]
                $site1_count=$site2_count=$site3_count=$site4_count=0; 
                $site_yield = array (
                    "site1" => 0,
                    "site2" => 0,
                    "site3" => 0,
                    "site4" => 0,
                );
                $QA_flag = 0;

                //Store data from $csvData[all data] to $testReadings[site][testNum][serial_num]
                for($dataIndex=2; $dataIndex<=count($csvData);$dataIndex++){      
                    if($csvData[$dataIndex]['DUT']==$csvData[$dataIndex-1]['DUT']) {
                        $QA_count++;
                        // $QA_flag = 1;
                    }   
                    else {        
                        $FT_count++;        
                        switch($csvData[$dataIndex]['Site'])  {
                            case 0:
                                $site1_count++;
                                //Get only Bin 1 data
                                if($csvData[$dataIndex]['Bin']==1) {
                                    $testReadings[0][$dataIndex-1]=round($csvData[$dataIndex][$testNum-1],3);
                                    $bins[0][1]++;                                  
                                }
                                else
                                    {$bins[0][$csvData[$dataIndex-1]['Bin']]++;}  //$bin[site][bin_number]

                                $site_yield['site1']=(round(($site1_count/count($testReadings[0]))*100,2));                            
                                break;

                            case 1:
                                $site2_count++;
                                if($csvData[$dataIndex]['Bin']==1) {
                                    $testReadings[1][$dataIndex-1]=round($csvData[$dataIndex][$testNum-1],3);
                                    $bins[1][1]++;                                                              
                                }
                                else
                                    {$bins[1][$csvData[$dataIndex-1]['Bin']]++;}  //$bin[site][bin_number]
                                $site_yield['site2']=(round(($site1_count/count($testReadings[1]))*100,2));                            
                                break;

                            case 2:
                                $site3_count++;
                                if($csvData[$dataIndex]['Bin']==1) {
                                    $testReadings[2][$dataIndex-1]=round($csvData[$dataIndex][$testNum-1],3);
                                    $bins[2][1]++;                                  
                                }
                                else
                                    {$bins[2][$csvData[$dataIndex-1]['Bin']]++;}  //$bin[site][bin_number]
                                $site_yield['site3']=(round(($site3_count/count($testReadings[2]))*100,2));                            
                                break;
                                
                            case 3:
                                $site4_count++;
                                if($csvData[$dataIndex]['Bin']==1) {
                                    $testReadings[3][$dataIndex-1]=round($csvData[$dataIndex][$testNum-1],3);
                                    $bins[3][1]++;                                  
                                }
                                else
                                    {$bins[3][$csvData[$dataIndex-1]['Bin']]++;}  //$bin[site][bin_number]  
                                $site_yield['site4']=(round(($site4_count/count($testReadings[3]))*100,2));                            
                                break;
                        }
                    }
                }

                // echo '<pre>'; 
                //     print_r($testReadings);
                // echo '<pre/>';

                for($site=0; $site<$numSites; $site++) {
                    $mean[$site][$testNum]   =  0;
                    $stdDev[$site][$testNum]   =  0;
                    $cp[$site][$testNum]   =  0;
                    $cp[$site][$testNum]   =  0;
                    $cpkL[$site][$testNum]   =  0;
                    $cpkH[$site][$testNum]   =  0;
                    $cpk[$site][$testNum]   =  0;
                }

                if($FT_count<1) {
                    echo 'No data in CSV file';
                    return FALSE;
                }
                // elseif($QA_flag==0) {
                else {
                    for($site=0 ;$site<$numSites;$site++)
                    {
                        if(count($testReadings[$site])!=0)
                        {
                            $mean[$site][$testNum]   = round(array_sum($testReadings[$site])/count($testReadings[$site]),3);
                            $stdDev[$site][$testNum] = round($this->stats_standard_deviation($testReadings[$site]),6);

                            if($stdDev[$site][$testNum]!=0){
                                $cp[$site][$testNum]     = round(($USL[$testNum]-$LSL[$testNum])/(6*$stdDev[$site][$testNum]),3); 
                                $cpkL[$site][$testNum]   = round(($mean[$site][$testNum]-$LSL[$testNum])/(3*$stdDev[$site][$testNum]),3);
                                $cpkH[$site][$testNum]   = round(($USL[$testNum]-$mean[$site][$testNum])/(3*$stdDev[$site][$testNum]),3);
                            
                            }
                            else{
                                $cp[$site][$testNum]    = 999999;
                                $cpkL[$site][$testNum]  = 999999;
                                $cpkH[$site][$testNum]  = 999999;

                            }
                            
                            if($cpkL[$site][$testNum] == $cpkH[$site][$testNum]) {
                                $cpk[$site][$testNum] = $cpkL[$site][$testNum].'LH';
                            }
                            else if($cpkL[$site][$testNum] > $cpkH[$site][$testNum]) {
                                $cpk[$site][$testNum] = $cpkH[$site][$testNum].'H';
                            }
                            else if($cpkH[$site][$testNum] > $cpkL[$site][$testNum]) {
                                $cpk[$site][$testNum] = $cpkL[$site][$testNum].'L';
                            }
                        }
                    }
                }

                switch($numSites)
                {
                    case 1:     $rowValues[$testNum] = array(
                                    'testName'  => $testName[$testNum],
                                    'LSL'       => $LSL[$testNum],
                                    'USL'       => $USL[$testNum],
                                    'mean'      => $mean[0][$testNum],
                                    'stdDev'    => $stdDev[0][$testNum],
                                    'cp'        => $cp[0][$testNum],
                                    'cpk'       => $cpk[0][$testNum],
                                );
                                break;

                    case 2:     $rowValues[$testNum] = array(
                                    'testName'  => $testName[$testNum],
                                    'LSL'       => $LSL[$testNum],
                                    'USL'       => $USL[$testNum],
                                    'meanS1'      => $mean[0][$testNum],
                                    'meanS2'      => $mean[1][$testNum],
                                    'stdDevS1'    => $stdDev[0][$testNum],
                                    'stdDevS2'    => $stdDev[1][$testNum],
                                    'cpS1'        => $cp[0][$testNum],
                                    'cpS2'        => $cp[1][$testNum],
                                    'cpkS1'       => $cpk[0][$testNum],
                                    'cpkS2'       => $cpk[1][$testNum],
                                );
                                break;
                
                    case 4:     $rowValues[$testNum] = array(
                                    'testName'  => $testName[$testNum],
                                    'LSL'       => $LSL[$testNum],
                                    'USL'       => $USL[$testNum],
                                    'meanS1'      => $mean[0][$testNum],
                                    'meanS2'      => $mean[1][$testNum],
                                    'meanS3'      => $mean[2][$testNum],
                                    'meanS4'      => $mean[3][$testNum],
                                    'stdDevS1'    => $stdDev[0][$testNum],
                                    'stdDevS2'    => $stdDev[1][$testNum],
                                    'stdDevS3'    => $stdDev[2][$testNum],
                                    'stdDevS4'    => $stdDev[3][$testNum],
                                    'cpS1'        => $cp[0][$testNum],
                                    'cpS2'        => $cp[1][$testNum],
                                    'cpS3'        => $cp[2][$testNum],
                                    'cpS4'        => $cp[3][$testNum],
                                    'cpkS1'       => $cpk[0][$testNum],
                                    'cpkS2'       => $cpk[1][$testNum],
                                    'cpkS3'       => $cpk[2][$testNum],
                                    'cpkS4'       => $cpk[3][$testNum]
                                );
                                break;
                }
            }

            $data['rowValues']  = $rowValues;
            $data['binsStat']   = $bins;
            $data['siteYield']  = $site_yield;

            // $data['pass']       = count($testReadings);
            // $data['testsCount'] = count($csvData)-1;
            // $data['yield']      = round(100*($data['pass']/$data['testsCount']),2);

            switch($numSites)
            {
                case 1:     $this->load->view('single_site_view', $data);
                            break;
                case 2:     $this->load->view('dual_site_view', $data);
                            break;    
                case 4:     $this->load->view('quad_site_view', $data);
                            break;      
            }
            // echo '<pre>';
            // print_r($bins);
            // echo '</pre>';
        }
    }


    // private function getStdDev($arr){
    //     $num_of_elements = count($arr); 
    //     $variance = 0.0; 
        
    //     // calculating mean using array_sum() method 
    //     $average = array_sum($arr)/$num_of_elements; 
        
    //     foreach($arr as $i) 
    //     { 
    //         // sum of squares of differences between  
    //         // all numbers and means. 
    //         $variance += pow(($i - $average), 2); 
    //     } 
        
    //     return (float)sqrt($variance/$num_of_elements); 
    // }

    private function stats_standard_deviation(array $a, $sample = false) {
        $n = count($a);
        if ($n === 0) {
            trigger_error("The array has zero elements", E_USER_WARNING);
            return false;
        }
        if ($sample && $n === 1) {
            trigger_error("The array has only 1 element", E_USER_WARNING);
            return false;
        }
        $mean = array_sum($a) / $n;
        $carry = 0.0;
        foreach ($a as $val) {
            $d = ((double) $val) - $mean;
            $carry += $d * $d;
        };
        if ($sample) {
           --$n;
        }
        return sqrt($carry / $n);
    }

}