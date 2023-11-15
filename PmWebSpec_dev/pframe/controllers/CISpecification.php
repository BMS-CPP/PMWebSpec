<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class CISpecification extends CI_Controller {

    public function __construct() {
        parent::__construct();
         $this->load->model('CIModDownload', 'MDownload');
		 $this->load->helper('download_esubft');
    }

    public function Process($action=NULL, $operation=NULL) {
        $callToFunction = $action;
        foreach (CLASS_ACTION_MAPPING as $index => $firstLevel) {
            foreach ($firstLevel as $key => $secondLevel) {
                if($callToFunction == $secondLevel) {
                    $funcName = "Action".$secondLevel;
                    $this->$funcName($operation);
                }
            }
        }
    }

    public function ActionViewPdf() {
        $this->load->view('inc/h1.inc.php');
        $this->load->view('view_pdf');
    }

    public function ActionExportEsub($param=NULL) {
        $data['param']     = strtolower($param);
        $data['selected']  = $this->session->userdata('selection');

        if(strtolower($param) == "esub") {
             $spec_id = $_POST['spec_id']; 
             $version_id = $_POST['version_id'];
             $data['esub_export'] = $this->MDownload->getAllesub_export($spec_id, $version_id);
            $this->load->view('inc/h1.inc.php');
            $this->load->view('esub', $data['esub_export']);
        } else if(strtolower($param) == "exportesub") {
             $spec_id = $_POST['spec_id']; 
             $version_id = $_POST['version_id'];
			 $this->load->view('inc/h1.inc.php');
             $data['esub_export'] = $this->MDownload->getAllSpecEsub($spec_id, $version_id);
             // echo 'hi';die;
			 downlondEsubft($data['esub_export']);
            $this->load->view('export_esub', $data['esub_export']);
        } else {
            if(empty($data['param'])) {
                $data['param'] = NULL;
            }
            $this->load->view('inc/h1.inc.php');
            $this->load->view('import_exist', $data);
        }
    }
}
