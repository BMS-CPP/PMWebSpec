<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CIModHome extends CI_Model {

    public $pkms_path;
    public $ppk;
    public $er;
    public $other;
    public $ppkother;
    public $erother;

    public function __construct() {
        parent::__construct();

        $this->pkms_path = '/directory/folder/tosave';
        $this->ppk = array('PPK-CDISC');
        $this->er = array('ER-ISOP-safety-efficacy');
        $this->other = array('Blank Template');
        $this->ppkother = array('PPK-CDISC','Blank Template');
        $this->erother = array('Blank Template','ER-ISOP-safety-efficacy');
    }

    public function getUserDashboardView() {
        // print "<h1><center>Hello</center></h1>";
    }
}
?>
