<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CIError extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function Error($err=NULL) {
        if(strtolower($err) == 'unauthorized') {
            $this->load->view('errors/html/unauthorized');
        }
    }
}