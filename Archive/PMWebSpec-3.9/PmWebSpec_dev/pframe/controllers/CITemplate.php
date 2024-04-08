<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CITemplate extends CI_Controller {
	public function __construct() {
	    parent::__construct();
	    $this->load->model('CIModTempManagement', 'MTemp');
	    $this->load->model('CIModSession', 'MSession');        
	}

	public function Access($action = NULL, $operation = NULL) {
	    $this->MSession->setSessionDetails();

	    if(!empty($this->input->post('manage'))) {
	        $selection = $this->input->post('manage');
	        echo $selection;
	        $selection = ucwords(strtolower($selection));
	        $selected = str_replace( array(' ',"/","."), array('',"",""), $selection );
	        $this->session->set_userdata('selection', $selected);
	        $this->create($action, $selected);
	    } else {
	        $callToFunction = $action;
	        foreach (CLASS_ACTION_MAPPING as $index => $firstLevel) {

	            foreach ($firstLevel as $key => $secondLevel) {
	                if ($callToFunction == $secondLevel) {
	                    $funcName = "Action" . $secondLevel;
	                    $this->$funcName($operation); 
	                }
	            }
	        }
	    }
	}

	public function Create($action=NULL, $operation=NULL) {
	    $callToFunction = $action;
	    foreach (CLASS_ACTION_MAPPING as $index => $firstLevel) {
	        foreach ($firstLevel as $key => $secondLevel) {
	            if($callToFunction == $secondLevel) {
	            	echo $secondLevel;
	                $funcName = "Action".$secondLevel;
	                $this->$funcName($operation);
	            }
	        }
	    }
	}


	public function ActionManageTeamplate($param=NULL) {
	    
	    if(strtolower($param) == "addvariable") {
	    	//echo $var_name = $this->input->post('varname');exit;
	    	function requiredVariable($var = NULL){
		    	if($var !== NULL) {
		    		return 1;
		    	} else { return 0 ;}
	    	}
	    	$data = [
	    		'varorder' => Null,
		     	'var_name' => strtoupper($this->input->post('varname')),
				'var_label' => $this->input->post('varlabel'),
				'units' => $this->input->post('varunit'),
				'type' => $this->input->post('vartype'),
				'round' => $this->input->post('varround'),
				'missVal' => $this->input->post('varmiss'),
				'note' => $this->input->post('varnote'),
				'source' => $this->input->post('varsrc'),
				'SpecType' => $this->input->post('temptomodify3'),
				'requiredFlag' => requiredVariable($var = $this->input->post('requiredFlag')),
				'nameChange' => requiredVariable($var = $this->input->post('varnamechange')),
				'labelChange' => requiredVariable($var = $this->input->post('varlabelchange')),
				'unitChange' => requiredVariable($var = $this->input->post('varunitchange')),
				'typeChange' => requiredVariable($var = $this->input->post('vartypechange')),
				'roundChange' => requiredVariable($var = $this->input->post('varroundchange')),
				'missValChange' => requiredVariable($var = $this->input->post('varmisschange')),
				'noteChange' => requiredVariable($var = $this->input->post('varnotechange')),
				'sourceChange' => requiredVariable($var = $this->input->post('varsrcchange')),
			];
	        $this->MTemp->saveVariableData('dsstruct', $data);
	          echo '<script> alert("Variable is Added!"); window.location.href = "'.base_url("admin/manage/users").'";</script>'; 
	    } else if(strtolower($param) == "updatevariable") {
	    	function requiredVariable($var = NULL){
		    	if($var !== NULL) {
		    		return 1;
		    	} else { return 0 ;}
	    	}
	    	$data = [
				'var_name' => strtoupper($this->input->post('varname')),
				'var_label' => $this->input->post('varlabel'),
				'units' => $this->input->post('varunit'),
				'type' => $this->input->post('vartype'),
				'round' => $this->input->post('varround'),
				'missVal' => $this->input->post('varmiss'),
				'note' => $this->input->post('varnote'),
				'source' => $this->input->post('varsrc'),
				'SpecType' => $this->input->post('temptomodify3'),
				'requiredFlag' => requiredVariable($var = $this->input->post('requiredFlag')),
				'nameChange' => requiredVariable($var = $this->input->post('varnamechange')),
				'labelChange' => requiredVariable($var = $this->input->post('varlabelchange')),
				'unitChange' => requiredVariable($var = $this->input->post('varunitchange')),
				'typeChange' => requiredVariable($var = $this->input->post('vartypechange')),
				'roundChange' => requiredVariable($var = $this->input->post('varroundchange')),
				'missValChange' => requiredVariable($var = $this->input->post('varmisschange')),
				'noteChange' => requiredVariable($var = $this->input->post('varnotechange')),
				'sourceChange' => requiredVariable($var = $this->input->post('varsrcchange')),
			];
			 $this->MTemp->updateVariableData('dsstruct', $data);
	          echo '<script> alert("Variable is Updated!"); window.location.href = "'.base_url("admin/manage/users").'";</script>'; 

	    } else if(strtolower($param) == "addflag") {
	    	function requiredFlag($var = NULL){
		    	if($var !== NULL) {
		    		return 1;
		    	} else { return 0 ;}
	    	}
	    	$data = ['FlagNum' => $this->input->post('flagnum'),
	    			 'FlagCom' => $this->input->post('flagcom'),
	    			 'FlagNotes' =>  $this->input->post('flagnote'),
	    			 'required' => requiredFlag($var = $this->input->post('required')),
	    			 'SpecType' => $this->input->post('temptomodify3'),
	    	];
	    	 $this->MTemp->saveFlagData('dsflag', $data);
	          echo '<script> alert("Flag is Added!"); window.location.href = "'.base_url("admin/manage/users").'";</script>';
	    } else if(strtolower($param) == "updateflag") {
	    	function requiredFlag($var = NULL){
		    	if($var !== NULL) {
		    		return 1;
		    	} else { return 0 ;}
	    	}
	    	$data = ['FlagNum' => $this->input->post('flagnum'),
	    			 'FlagCom' => $this->input->post('flagcom'),
	    			 'FlagNotes' =>  $this->input->post('flagnote'),
	    			 'required' => requiredFlag($var = $this->input->post('required')),
	    			 'SpecType' => $this->input->post('temptomodify3'),
	    	];
	    	 $this->MTemp->updateFlagData('dsflag', $data);
	          echo '<script> alert("Flag is Updated!"); window.location.href = "'.base_url("admin/manage/users").'";</script>';

	    }

	}
}
