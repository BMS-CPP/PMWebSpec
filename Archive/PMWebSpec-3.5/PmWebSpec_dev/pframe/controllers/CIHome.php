<?php 
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class CIHome extends CI_Controller {
    protected $required_data;

    public function __construct() {
        parent::__construct();
        $this->load->model('CIModHome', 'MHome');
        $this->load->model('CIModSession', 'MSession');
        $this->load->model('CIModUser', 'MUser');
        $this->load->model('CIModSpec', 'MSpec');
        $this->load->model('CIModDownload', 'MDownload');
        $this->load->helper('download_pdf');
        $this->load->helper('download_csv');
        $this->load->helper('download_csvft');
        $this->load->helper('download_wordft');
        $this->load->helper('download_esub');
		$this->load->helper('download_word');
		$this->load->helper('downloadreview_pdf');
		$this->load->library(array('form_validation'));
    }

	public function Index($err=NULL) {
	    $user_ids = $this->MUser->getDistinctUserId();

	    if(!empty($err)) {
    	    if(!in_array($this->session->userdata('user_id'), $user_ids)) {
    	        redirect('Location: unauthorized', 'location', 301);
    	        exit(0);
    	    }
	    }

	    $this->MSession->setSessionDetails();

	    if(!in_array($this->session->userdata('user_id'), $user_ids)) 
	    {
	    	$this->load->view('inc/h1.inc.php');
			$this->load->view("unauthorized");
    	}
    	else
    	{

		    if(!empty($this->input->post('selection'))) {

	            $selection = $this->input->post('selection');
	            $selection = ucwords(strtolower($selection));
	            $selected = str_replace( array(' ',"/"), array('',""), $selection );
	            $this->session->set_userdata('selection', $selected);
	            $this->create($selected);
		    } else {
	    	    $this->MHome->getUserDashboardView();
	    	    $this->load->view('inc/header.inc.php');
	    		$this->load->view('home');
	    		$this->load->view('inc/footer.inc.php');
		    }
		}
	}

	public function Create($action=NULL, $operation=NULL) {
		if($action == 'DsTools')
		{
			$action = 'Download';
		}
		
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

	public function ActionCreateSpec($param=NULL) 
	{
	   	$user_details = $this->session->user_details;
		$user_email = $user_details[0]['email_address'];

		 if((empty($user_email))) {
            echo "<script>
            alert('Your session got expired.');
            window.location.href='".base_url()."';
            </script>";
            exit();
   		}

		$this->MSession->setSessionDetails();
	    if(strtolower($param) == 'save') 
	    {
	    	// echo '<pre>';print_r($_POST);die;
	    	$this->form_validation->set_rules('username', 'User Name', 'required');
	    	$this->form_validation->set_rules('dstype', 'dstype', 'required');
	    	$this->form_validation->set_rules('cname', 'cname', 'required');
	    	$this->form_validation->set_rules('ctype', 'ctype', 'required');
	    	$this->form_validation->set_rules('cdate', 'cdate', 'required');
	    	$this->form_validation->set_rules('title', 'title', 'required');
	    	$this->form_validation->set_rules('project_name', 'project_name', 'required');
	    	$this->form_validation->set_rules('pk_scientist', 'pk_scientist', 'required');
	    	$this->form_validation->set_rules('pm_scientist', 'pm_scientist', 'required');
	    	$this->form_validation->set_rules('statistician', 'statistician', 'required');
	    	$this->form_validation->set_rules('dataset_name', 'dataset_name', 'required');
	    	$this->form_validation->set_rules('dataset_label', 'dataset_label', 'required');
	    	$this->form_validation->set_rules('dataset_descriptor', 'dataset_descriptor', 'required');
	    	$this->form_validation->set_rules('dataset_records', 'dataset_records', 'required');
	    	$this->form_validation->set_rules('dataset_criteria', 'dataset_criteria', 'required');
			$this->form_validation->set_rules('dataset_sort', 'dataset_sort', 'required');
			$this->form_validation->set_rules('dataset_date', 'dataset_date', 'required');
	    	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	        $this->form_validation->set_message('required', 'Enter %s');
	 
	        if ($this->form_validation->run() === FALSE)
	        {  
	        	echo "<script>
	                alert('Someting went wrong...Required fields are missing');
	                window.location.href='".base_url()."';
	                </script>";
	                exit();
	        }

	        //if(!empty($this->input->post('derive')) && !empty($this->input->post('passvalue'))) {
	    		$user_details = $this->session->user_details;
        		$user_email = $user_details[0]['email_address'];

        		 if((empty($user_email))) {
	                echo "<script>
	                alert('Your session got expired.');
	                window.location.href='".base_url()."';
	                </script>";
	                exit();
           		 }
				$data['spec_id'] = $this->MSpec->saveSpecData();
				$data['msg'] = $this->MUser->notifySpecSubmitted($data);
				//print_r($data);exit;
				$this->load->view('inc/h1.inc.php');
				$this->load->view('save_spec', $data);
      //}
	    } else if(strtolower($param) == 'new') {
	    	$spec_type                                      = $this->input->post('SpecType');
            $this->MUser->user_id                           = $this->session->userdata('user_id');
            list($dstype, $dslabel, $cname,$dataset_sorted)                 = $this->MSpec->getTypeLabel($spec_type);
            
            list($structarray, $optional, $otheroptional)   = $this->MSpec->tempVarsQuery($spec_type, $this->MHome->ppk, $this->MHome->er, $this->MHome->other);
			// echo '<pre>';print_r($otheroptional);exit;

            $data['full_name']          = $this->session->userdata('user_details')[$this->MUser->user_id]['first_name']. " ". $this->session->userdata('user_details')[$this->MUser->user_id]['last_name'];
            $data['spec_templates']     = $this->MSpec->getSpecType();
            $data['spec_type']          = $spec_type;
            $data['ds_type']            = $dstype;
            $data['ds_label']           = $dslabel;
            $data['dataset_sorted']     = $dataset_sorted;
            $data['cname']              = $cname;
            $data['struct_arr']         = $structarray;
            $data['optional_var']       = $optional;
            $data['otheroptional']      = $otheroptional;
            $data['lastactivitytimeold']      = $_SESSION['LAST_ACTIVITY'];
            $data['programmers']        = $this->session->userdata('programmers');
            $data['pkms_path']          = $this->MHome->pkms_path;
            $data['ppk_other']          = $this->MHome->ppkother;
            $data['flag_array']         = $this->MSpec->tempFlagQuery($spec_type);

            // echo '<pre>';print_r($otheroptional); die;

	        $this->load->view('inc/h1.inc.php');
	        $this->load->view('single_spec', $data);
	    } else if(strtolower($param) == 'checkflag') {
	        $data['flag'] = $this->MSpec->getFlagsList();
	        $this->load->view('inc/h1.inc.php');
	        $this->load->view('check_flag', $data);
	    } else {
	    	// echo 'hi';die;
	        $data['spec_types'] = $this->MSpec->getSpecType();
	        $this->load->view('inc/h1.inc.php');
    	    $this->load->view('new_spec', $data);
	    }
	}

	public function ActionUpdateSpec($param=NULL) 
	{
		if(strtolower($param) == 'update') 
		{
			$submitform = $this->input->post("submitform");

			if($submitform == 'Save Progress')
			{
				$spec_id = $this->input->post("spec_id");
				$version_id = $this->input->post("version_id") - 1;
				$checkexistingavailable = $this->MSpec->getSpecDetails($spec_id,$version_id);
				if(!empty($checkexistingavailable))
				{
					// echo 'hi';die;
					// echo '<pre>';print_r($checkexistingavailable);die;
					$where_cond=array('spec_id'=> $spec_id, 'version_id'=> $version_id);
					$spec_general = $this->MSpec->deleteDataspec("spec_general",$where_cond);

					$dataset_general = $this->MSpec->deleteDataspec("dataset_general",$where_cond);

					$pk_data = $this->MSpec->deleteDataspec("pk_data",$where_cond);

					$pkms_path = $this->MSpec->deleteDataspec("pkms_path",$where_cond);

					$clinical_data = $this->MSpec->deleteDataspec("clinical_data",$where_cond);

					$dataset_structure = $this->MSpec->deleteDataspec("dataset_structure",$where_cond);

					$derivations = $this->MSpec->deleteDataspec("derivations",$where_cond);

					$missing_outlier = $this->MSpec->deleteDataspec("missing_outlier",$where_cond);

					$flag = $this->MSpec->deleteDataspec("flag",$where_cond);

					$updatelockspec = $this->MUser->discardchange($spec_id);
				}
				else
				{
					$version_id = $this->input->post("version_id");
				}

				// echo 'hi1';

				$this->aws_conn_obj = $this->load->database('aws_db', TRUE);

		        $date = date("Y-m-d H:i:s");
		        $user_name = $this->session->user_details;
		        $created_by_session = $user_name[0]['user_id'];
		        $data_info = [
		            'islocked'   => '0',
		            //'modification_date' => $date,
		        ];

		        // echo $spec_id;
		        // echo '<pre>';print_r($data_info);die;
		        $this->aws_conn_obj->where('spec_id', $spec_id);
		        $this->aws_conn_obj->where('lockedby', $created_by_session);
		        $this->aws_conn_obj->where('islocked', '1');
		        $this->aws_conn_obj->update('spec_general', $data_info);

		        // die;

				if((empty($spec_id)) || (empty($version_id))) {
		            echo "<script>
		            alert('Your session got expired.');
		            window.location.href='".base_url()."';
		            </script>";
		            exit();
	        	}

	        	$date = date("Y-m-d H:i:s");
		        $user_name = $this->session->user_details;
		        $created_by_session = $user_name[0]['user_id'];
	        	
				// ------------- spec_general table;
				$ds_programmer = implode(',', $this->input->post('ds_programmer'));
				if($ds_programmer == null) {
	           		 $ds_programmer = "----------";
	       		}

				$spec_general = [
				'modification_date' => $this->input->post('cdate'),
				'title' => $this->input->post('title'),
				'project_name' =>$this->input->post('project_name'),
				'pk_scientist' => $this->input->post('pk_scientist'),
				'pm_scientist' => $this->input->post('pm_scientist'),
				'statistician' => $this->input->post('statistician'),
				'ds_programmer'     => $ds_programmer,
				'changes_made' => $this->input->post('changes_made'),
				'revised_by' => $this->input->post('revised_by'),
				'islocked' => '1',
				'lockedby' => $created_by_session,
				'spec_status' => '1',
				];

				$this->MSpec->saveUpdateValue('spec_general', $spec_general, $spec_id, $version_id);

				//dataset_general
				$dataset_general  = [
				'dataset_name' => $this->input->post("dataset_name"),
				'dataset_description' => $this->input->post("dataset_descriptor"),
				'dataset_path' => $this->input->post("dataset_path"),
				'dataset_due_date' => $this->input->post("ds_due_date"),
				'dataset_label' => $this->input->post("dataset_label"),
				'dataset_multiple_record' => $this->input->post("dataset_records"),
				'dataset_inclusion' => $this->input->post("dataset_criteria"),
				'dataset_sort' => strtoupper($this->input->post("dataset_sort")),
				'dataset_dev_path' => $this->input->post("dataset_dev_path"),
				'dataset_qc_path' => $this->input->post("dataset_qc_path"),];

				$this->MSpec->saveUpdateValue('dataset_general', $dataset_general, $spec_id, $version_id);

				$pks = $_REQUEST["pkdata"];
				$pieces = explode("@@", $pks);
				$pk = [];
				for( $i = 0; $i<count($pieces)/3-1; $i++ ) {
					$pk['study'] = xss_clean($pieces[$i * 3]);
					$pk['study_type'] = xss_clean($pieces[$i * 3 + 1]);
					$pk['lock_type'] = xss_clean($pieces[$i * 3 + 2]);
					$this->MSpec->saveUpdateValue('pk_data', $pk, $spec_id, $version_id);
				}

				// -------------- pkms_path table;
				$pkmspath = $_REQUEST["pkms"];
				$pieces = explode("@@", $pkmspath);
				$pkms = [];
				for( $i = 0; $i<count($pieces)/2-1; $i++ ) {
					$pkms['libname'] = xss_clean($pieces[$i*2]);
					$pkms['libpath'] = xss_clean($pieces[$i*2+1]);
					$this->MSpec->saveUpdateValue('pkms_path', $pkms, $spec_id, $version_id);

				}

				// -------------- clinical_data table;
				$clinicals = $_REQUEST["clinical"];
				$pieces = explode("@@", $clinicals);
				$clinical_data = [];
				for( $i = 0; $i<count($pieces)/6-1; $i++ ) {
					$clinical_data['study'] = xss_clean($pieces[$i*6]);
					$clinical_data['statistician'] = xss_clean($pieces[$i*6+1]);
					$clinical_data['level0'] = xss_clean($pieces[$i*6+2]);
					$clinical_data['level1'] = xss_clean($pieces[$i*6+3]);
					$clinical_data['level2'] = xss_clean($pieces[$i*6+4]);
					$clinical_data['format'] = xss_clean($pieces[$i*6+5]);
					$this->MSpec->saveUpdateValue('clinical_data', $clinical_data, $spec_id, $version_id);
				}

		  //       $clinicals = $_REQUEST["clinical"];
				// $pieces = explode("@@", $clinicals);
				// $clinical_data = [];

		  //       for( $i = 0; $i<count($pieces)/4-1; $i++ ) 
		  //       {
		  //            $clinical_data = array(
		  //                               'spec_id'       => $spec_id,
		  //                               'version_id'    => $version_id,
		  //                               'study'         => xss_clean($pieces[$i*4]),
		  //                               'statistician'  => xss_clean($pieces[$i*4+1]),
		  //                               'level0'        => xss_clean($pieces[$i*4+2]),
		  //                               'format'        => xss_clean($pieces[$i*4+3]),
		  //                            );
		  //           $this->MSpec->saveUpdateValue('clinical_data', $clinical_data, $spec_id, $version_id);
		  //       }

				// -------------- dataset structure table;
				$lname = $_REQUEST["passvalue"];
				$pieces = explode("@@", $lname);
				$passvalue = [];
				for( $i = 0; $i<count($pieces)/18-1; $i++ ) {
					$passvalue['var_name'] = strtoupper(xss_clean($pieces[$i * 18 + 10]));
					$passvalue['var_label'] = $pieces[$i * 18 + 11];
					$passvalue['var_units'] = $pieces[$i * 18 + 12];
					$passvalue['var_type'] = $pieces[$i * 18 + 13];
					$passvalue['var_rounding'] = $pieces[$i * 18 + 14];
					$passvalue['var_missing_value'] = $pieces[$i * 18 + 15];
					$passvalue['var_notes'] = $pieces[$i * 18 + 16];
					$passvalue['var_source'] = $pieces[$i * 18 + 17];
					$passvalue['required'] = $pieces[$i * 18 + 1];
					$passvalue['nameChange'] = $pieces[$i * 18 + 2];
					$passvalue['labelChange'] =  $pieces[$i * 18 + 3];
					$passvalue['unitChange'] = $pieces[$i * 18 + 4];
					$passvalue['typeChange'] = $pieces[$i * 18 + 5];
					$passvalue['roundChange'] =  $pieces[$i * 18 + 6];
					$passvalue['missValChange'] =  $pieces[$i * 18 + 7];
					$passvalue['noteChange'] = $pieces[$i * 18 + 8];
					$passvalue['sourceChange'] =  $pieces[$i * 18 + 9];
					//print_r($passvalue['var_notes']);
					$this->MSpec->saveUpdateValue('dataset_structure', $passvalue, $spec_id, $version_id);
				}

				// -------------- derivations table;
				$derives = $_REQUEST["derive"];
				$pieces = explode("@@", $derives);
				$derive = [];
				for( $i = 0; $i<count($pieces)/2-1; $i++ ) {
					$derive['field'] = xss_clean($pieces[$i*2]);
					$derive['algorithm'] = xss_clean($pieces[$i*2+1]);
					$this->MSpec->saveUpdateValue('derivations', $derive, $spec_id, $version_id);
				} 

				// -------------- missing data;
				$missings['missing'] = $_REQUEST["missingadd"];
				$this->MSpec->saveUpdateValue('missing_outlier', $missings, $spec_id, $version_id);

				// -------------- flag table;
				$flg = $_REQUEST["flgs"];
				$piece = explode("@@", $flg);
				$flgs = [];
				for( $i = 0; $i<count($piece)/4-1; $i++ ) {
					$flgs['flag_number'] =  xss_clean($piece[$i*4]);
					$flgs['flag_comment'] =  $piece[$i*4+1];
					$flgs['flag_notes'] =  $piece[$i*4+2];
					$flgs['required'] =  xss_clean($piece[$i*4+3]);
					$this->MSpec->saveUpdateValue('flag', $flgs, $spec_id, $version_id);

				}

				// confirmation table 
			    $confs = $_REQUEST["confs"];
			    $piece = explode("@@", $confs);

	    		// write to s3 bucket
	    
			    if (isset($_FILES["fileToUpload"])) {

			        include "S3connection.php";
			    
			        for( $i = 0; $i<count($_FILES["fileToUpload"]["name"]); $i++ ) {
			        
			            //$data=file_get_contents($_FILES["fileToUpload"]["tmp_name"][$i]);
			            $name =  $_FILES["fileToUpload"]["name"][$i];
			            $type =  $_FILES["fileToUpload"]["type"][$i];
			            $file_data = array(
			            'spec_id' => $spec_id,
			            'confirmed' => xss_clean($piece[$i]),
			             'type' =>  $type,
			             'name' =>  $name,
			             
			            );
			             $this->MSpec->saveUpdatefiledata('files', $file_data); 
			             $ds_path = $this->input->post("dataset_path");
			            $source_path = s3_bucket_path;
			            $target_path = $ds_path;
			            $status = "Pending";

			            $fileType = strtolower(pathinfo($name,PATHINFO_EXTENSION));
			            $filenameOnly = basename($name, ".".$fileType); 

			            $filepath = str_replace(pkms_path, '', $target_path);
			            $filepath = str_replace(pkms_path2, '', $filepath);
			            $filepath = str_replace('/', '_', $filepath);   

			            $file_name = $filenameOnly.$filepath.".".$fileType;

			            // insert the record into metatable

			             $fileData = [
			            'spec_id' => $spec_id,
			            'file_name' => $file_name,
			            'source_path' => $source_path,
			            'target_path' => $target_path,
			            'status' => $status,
			        ];

			        $this->MSpec->insert_file("file_transfer", $fileData);
			           

			            //move the file to S3 bucket;
			            $target_file = $attachmentpath.$filenameOnly.$filepath.".".$fileType;

			            if(!is_dir($attachmentpath)){
			                mkdir($attachmentpath, 0755, true);
			            }       
			                                                
			            if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
			                error_log("Attachment is not uploaded because of error #" . $_FILES["fileToUpload"]["error"][0], 0);
			                die("The form is submitted but attachment is not uploaded due to errors.");             
			            } else {
			                file_transfer($target_file, s3_bucket_path);
			            }

			        }
			    }

		        $data['param'] = 'version'; 
		        $data['selected'] = 'Modify';
		        
		        if(empty($data['selected']))
		        {
		        	$data['all_specs'] = $this->MSpec->getAllSpecDetailsimport();
		        }
		        else
		        {
		        	$data['all_specs'] = $this->MSpec->getAllSpecDetails();
		        }

		        foreach ($data['all_specs'] as $key => $specs)
				{
					$all_modified_spec = $this->MSpec->getModifiedAllSpecDetails($specs['spec_id']);
					if(!empty($all_modified_spec))
					{
						$islocked = array_unique(array_column($all_modified_spec, 'islocked'));
						$sumoflocked = array_sum($islocked);
						$revised_by = array_unique(array_column($all_modified_spec, 'revised_by'));
						$revised_by = implode(', ',$revised_by);
						$data['all_specs'][$key]['last_modified_by'] = $revised_by;
						if($sumoflocked > 0)
						{
							$lockedby = array_filter(array_unique(array_column($all_modified_spec, 'lockedby')));
							$lockedby = implode(',', $lockedby);
							$statuslocked = 'Locked';
						}
						else{
							$statuslocked = 'Un-Locked';
							$lockedby = '';
						}
						$data['all_specs'][$key]['islocked'] = $statuslocked;
						$data['all_specs'][$key]['lockedby'] = $lockedby;
					}
					else
					{
						$data['all_specs'][$key]['last_modified_by'] = '';
						$data['all_specs'][$key]['islocked'] = 'Un-Locked';
					}
				}

				$data['spec_info'] = $this->MSpec->getSpecInfo();
				$data['spec_id']   = $this->input->post("spec_id");
				$this->load->view('inc/h1.inc.php');
				$this->load->view('import_exist', $data);

			}
			else
			{
				$spec_id = $this->input->post("spec_id");
				$version_id = $this->input->post("version_id");

				if((empty($spec_id)) || (empty($version_id))) {
		            echo "<script>
		            alert('Your session got expired.');
		            window.location.href='".base_url()."';
		            </script>";
		            exit();
	        	}

				$checkexistingavailable = $this->MSpec->getSpecDetails($spec_id,$version_id);

				if(!empty($checkexistingavailable))
				{
					$version_id = $this->input->post("version_id") - 1;

					$where_cond=array('spec_id'=> $spec_id, 'version_id'=> $version_id);
					$spec_general = $this->MSpec->deleteDataspec("spec_general",$where_cond);

					$dataset_general = $this->MSpec->deleteDataspec("dataset_general",$where_cond);

					$pk_data = $this->MSpec->deleteDataspec("pk_data",$where_cond);

					$pkms_path = $this->MSpec->deleteDataspec("pkms_path",$where_cond);

					$clinical_data = $this->MSpec->deleteDataspec("clinical_data",$where_cond);

					$dataset_structure = $this->MSpec->deleteDataspec("dataset_structure",$where_cond);

					$derivations = $this->MSpec->deleteDataspec("derivations",$where_cond);

					$missing_outlier = $this->MSpec->deleteDataspec("missing_outlier",$where_cond);

					$flag = $this->MSpec->deleteDataspec("flag",$where_cond);
				}

				//existing free and unlock spec
				$this->aws_conn_obj = $this->load->database('aws_db', TRUE);

		        $date = date("Y-m-d H:i:s");
		        $user_name = $this->session->user_details;
		        $created_by_session = $user_name[0]['user_id'];
		        $data_info = [
		            'islocked'   => '0',
		            'modification_date' => $date,
		        ];
		        $this->aws_conn_obj->where('spec_id', $spec_id);
		        $this->aws_conn_obj->where('lockedby', $created_by_session);
		        $this->aws_conn_obj->where('islocked', '1');
		        $this->aws_conn_obj->update('spec_general', $data_info);

				// ------------- spec_general table;
				$ds_programmer = implode(',', $this->input->post('ds_programmer'));
				if($ds_programmer == null) {
	           		 $ds_programmer = "----------";
	       		}

				$spec_general = [
				'modification_date' => $this->input->post('cdate'),
				'title' => $this->input->post('title'),
				'project_name' =>$this->input->post('project_name'),
				'pk_scientist' => $this->input->post('pk_scientist'),
				'pm_scientist' => $this->input->post('pm_scientist'),
				'statistician' => $this->input->post('statistician'),
				'ds_programmer'     => $ds_programmer,
				'changes_made' => $this->input->post('changes_made'),
				'revised_by' => $this->input->post('revised_by'),
				'islocked' => '0',
				'spec_status' => '0',
				];

				$this->MSpec->saveUpdateValue('spec_general', $spec_general, $spec_id, $version_id);

				//dataset_general
				$dataset_general  = [
				'dataset_name' => $this->input->post("dataset_name"),
				'dataset_description' => $this->input->post("dataset_descriptor"),
				'dataset_path' => $this->input->post("dataset_path"),
				'dataset_due_date' => $this->input->post("ds_due_date"),
				'dataset_label' => $this->input->post("dataset_label"),
				'dataset_multiple_record' => $this->input->post("dataset_records"),
				'dataset_inclusion' => $this->input->post("dataset_criteria"),
				'dataset_sort' => strtoupper($this->input->post("dataset_sort")),
				'dataset_dev_path' => $this->input->post("dataset_dev_path"),
				'dataset_qc_path' => $this->input->post("dataset_qc_path"),];

				$this->MSpec->saveUpdateValue('dataset_general', $dataset_general, $spec_id, $version_id);

				$pks = $_REQUEST["pkdata"];
				$pieces = explode("@@", $pks);
				$pk = [];
				for( $i = 0; $i<count($pieces)/3-1; $i++ ) {
					$pk['study'] = xss_clean($pieces[$i * 3]);
					$pk['study_type'] = xss_clean($pieces[$i * 3 + 1]);
					$pk['lock_type'] = xss_clean($pieces[$i * 3 + 2]);
					$this->MSpec->saveUpdateValue('pk_data', $pk, $spec_id, $version_id);
				}

				// -------------- pkms_path table;
				$pkmspath = $_REQUEST["pkms"];
				$pieces = explode("@@", $pkmspath);
				$pkms = [];
				for( $i = 0; $i<count($pieces)/2-1; $i++ ) {
					$pkms['libname'] = xss_clean($pieces[$i*2]);
					$pkms['libpath'] = xss_clean($pieces[$i*2+1]);
					$this->MSpec->saveUpdateValue('pkms_path', $pkms, $spec_id, $version_id);

				}

				// -------------- clinical_data table;
				$clinicals = $_REQUEST["clinical"];
				$pieces = explode("@@", $clinicals);
				$clinical_data = [];
				for( $i = 0; $i<count($pieces)/6-1; $i++ ) {
					$clinical_data['study'] = xss_clean($pieces[$i*6]);
					$clinical_data['statistician'] = xss_clean($pieces[$i*6+1]);
					$clinical_data['level0'] = xss_clean($pieces[$i*6+2]);
					$clinical_data['level1'] = xss_clean($pieces[$i*6+3]);
					$clinical_data['level2'] = xss_clean($pieces[$i*6+4]);
					$clinical_data['format'] = xss_clean($pieces[$i*6+5]);
					$this->MSpec->saveUpdateValue('clinical_data', $clinical_data, $spec_id, $version_id);
				}

				// $clinicals = $_REQUEST["clinical"];
				// $pieces = explode("@@", $clinicals);
				// $clinical_data = [];

		  //       for( $i = 0; $i<count($pieces)/4-1; $i++ ) 
		  //       {
		  //            $clinical_data = array(
		  //                               'spec_id'       => $spec_id,
		  //                               'version_id'    => $version_id,
		  //                               'study'         => xss_clean($pieces[$i*4]),
		  //                               'statistician'  => xss_clean($pieces[$i*4+1]),
		  //                               'level0'        => xss_clean($pieces[$i*4+2]),
		  //                               'format'        => xss_clean($pieces[$i*4+3]),
		  //                            );
		  //           $this->MSpec->saveUpdateValue('clinical_data', $clinical_data, $spec_id, $version_id);
		  //       }

				// -------------- dataset structure table;
				$lname = $_REQUEST["passvalue"];
				$pieces = explode("@@", $lname);
				$passvalue = [];
				for( $i = 0; $i<count($pieces)/18-1; $i++ ) {
					$passvalue['var_name'] = strtoupper(xss_clean($pieces[$i * 18 + 10]));
					$passvalue['var_label'] = $pieces[$i * 18 + 11];
					$passvalue['var_units'] = $pieces[$i * 18 + 12];
					$passvalue['var_type'] = $pieces[$i * 18 + 13];
					$passvalue['var_rounding'] = $pieces[$i * 18 + 14];
					$passvalue['var_missing_value'] = $pieces[$i * 18 + 15];
					$passvalue['var_notes'] = $pieces[$i * 18 + 16];
					$passvalue['var_source'] = $pieces[$i * 18 + 17];
					$passvalue['required'] = $pieces[$i * 18 + 1];
					$passvalue['nameChange'] = $pieces[$i * 18 + 2];
					$passvalue['labelChange'] =  $pieces[$i * 18 + 3];
					$passvalue['unitChange'] = $pieces[$i * 18 + 4];
					$passvalue['typeChange'] = $pieces[$i * 18 + 5];
					$passvalue['roundChange'] =  $pieces[$i * 18 + 6];
					$passvalue['missValChange'] =  $pieces[$i * 18 + 7];
					$passvalue['noteChange'] = $pieces[$i * 18 + 8];
					$passvalue['sourceChange'] =  $pieces[$i * 18 + 9];
					//print_r($passvalue['var_notes']);
					$this->MSpec->saveUpdateValue('dataset_structure', $passvalue, $spec_id, $version_id);
				}

				// -------------- derivations table;
				$derives = $_REQUEST["derive"];
				$pieces = explode("@@", $derives);
				$derive = [];
				for( $i = 0; $i<count($pieces)/2-1; $i++ ) {
					$derive['field'] = xss_clean($pieces[$i*2]);
					$derive['algorithm'] = xss_clean($pieces[$i*2+1]);
					$this->MSpec->saveUpdateValue('derivations', $derive, $spec_id, $version_id);
				}

				// -------------- missing data;
				$missings['missing'] = $_REQUEST["missingadd"];
				$this->MSpec->saveUpdateValue('missing_outlier', $missings, $spec_id, $version_id);

				// -------------- flag table;
				$flg = $_REQUEST["flgs"];
				$piece = explode("@@", $flg);
				$flgs = [];
				for( $i = 0; $i<count($piece)/4-1; $i++ ) {
					$flgs['flag_number'] =  xss_clean($piece[$i*4]);
					$flgs['flag_comment'] =  $piece[$i*4+1];
					$flgs['flag_notes'] =  $piece[$i*4+2];
					$flgs['required'] =  xss_clean($piece[$i*4+3]);
					$this->MSpec->saveUpdateValue('flag', $flgs, $spec_id, $version_id);

				}

				// confirmation table 
			    $confs = $_REQUEST["confs"];
			    $piece = explode("@@", $confs);

	    		// write to s3 bucket
	    
			    if (isset($_FILES["fileToUpload"])) {

			        include "S3connection.php";
			    
			        for( $i = 0; $i<count($_FILES["fileToUpload"]["name"]); $i++ ) {
			        
			            //$data=file_get_contents($_FILES["fileToUpload"]["tmp_name"][$i]);
			            $name =  $_FILES["fileToUpload"]["name"][$i];
			            $type =  $_FILES["fileToUpload"]["type"][$i];
			            $file_data = array(
			            'spec_id' => $spec_id,
			            'confirmed' => xss_clean($piece[$i]),
			             'type' =>  $type,
			             'name' =>  $name,
			             
			            );
			             $this->MSpec->saveUpdatefiledata('files', $file_data); 
			             $ds_path = $this->input->post("dataset_path");
			            $source_path = s3_bucket_path;
			            $target_path = $ds_path;
			            $status = "Pending";

			            $fileType = strtolower(pathinfo($name,PATHINFO_EXTENSION));
			            $filenameOnly = basename($name, ".".$fileType); 

			            $filepath = str_replace(pkms_path, '', $target_path);
			            $filepath = str_replace(pkms_path2, '', $filepath);
			            $filepath = str_replace('/', '_', $filepath);   

			            $file_name = $filenameOnly.$filepath.".".$fileType;

			            // insert the record into metatable

			             $fileData = [
			            'spec_id' => $spec_id,
			            'file_name' => $file_name,
			            'source_path' => $source_path,
			            'target_path' => $target_path,
			            'status' => $status,
			        ];

			        $this->MSpec->insert_file("file_transfer", $fileData);
			           

			            //move the file to S3 bucket;
			            $target_file = $attachmentpath.$filenameOnly.$filepath.".".$fileType;

			            if(!is_dir($attachmentpath)){
			                mkdir($attachmentpath, 0755, true);
			            }       
			                                                
			            if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
			                error_log("Attachment is not uploaded because of error #" . $_FILES["fileToUpload"]["error"][0], 0);
			                die("The form is submitted but attachment is not uploaded due to errors.");             
			            } else {
			                file_transfer($target_file, s3_bucket_path);
			            }

			        }
			    }

				$data['spec_id'] = $this->input->post("spec_id");
				$data['version_id'] = $version_id;
				$this->load->view('inc/h1.inc.php');
				$this->load->view('update_spec', $data);
			}
		}
	}

	public function ActionImportExisting($param=NULL) 
	{
	   	$user_details = $this->session->user_details;
		$user_email = $user_details[0]['email_address'];

		 if((empty($user_email))) {
            echo "<script>
            alert('Your session got expired.');
            window.location.href='".base_url()."';
            </script>";
            exit();
   		}

		$this->MSession->setSessionDetails();
	    $data['param']      = strtolower($param);
	    if(!empty($action))
	    {
	    	$data['selected']   = $action; 
	    }

	    if(!empty($this->session->userdata('selection')))
	    {
	     	$data['selected']   = strtolower($this->session->userdata('selection'));
	    }

	    if(!empty($_POST))
	    {
	    	$data['selected']   = $this->input->post("selectors");
	    }

	    // echo $data['selected'];die;

	    // $data['selected']   = strtolower($this->session->userdata('selection'));

	    if(strtolower($param) == "copyexist") {
			$spec_id = $this->input->post("spec_id");
			$version_id = $this->input->post("version_id");

			$data['importexisting'] = $this->MDownload->getAllSpecPdf($spec_id, $version_id);
			 //print_r($data['importexisting']);exit;
			list($dstype, $dslabel, $cname, $dataset_sorted) = $this->MSpec->getTypeLabel($data['importexisting']['user_spec']['type']);

			// echo '<pre>';print_r($dslabel);die;

			$ppk = ["PPK-standard"];

            $erother=["Blank Template","ER-ISOP-safety-efficacy"];

			$otheroptional = $this->MSpec->getotheroptional($data['importexisting']['all_var'] , $dstype, $ppk, $erother);
			
			if(is_array($otheroptional)) {
           		 $data['importexisting'] = array_merge($data['importexisting'], $otheroptional);
        	}

        	$data['importexisting']['dataset_sorted'] = $dataset_sorted;
        	$data['importexisting']['ds_label'] = $dslabel;

        	$data['importexisting']['lastactivitytimeold']      = $_SESSION['LAST_ACTIVITY'];

	        $this->load->view('inc/h1.inc.php');
	       
	        $this->load->view('copy_exist', $data['importexisting']);
	    } else {

	    	// echo $data['selected'];die;
	        if($data['param']=="") {
	           $data['param'] = NULL;
	        }

	        if(empty($data['selected']))
	        {
	        	$data['all_specs'] = $this->MSpec->getAllSpecDetailsimport();
	        }
	        else
	        {
	        	$data['all_specs'] = $this->MSpec->getAllSpecDetails();
	        }

	        foreach ($data['all_specs'] as $key => $specs)
			{
				$all_modified_spec = $this->MSpec->getModifiedAllSpecDetails($specs['spec_id']);
				if(!empty($all_modified_spec))
				{
					$islocked = array_unique(array_column($all_modified_spec, 'islocked'));
					$sumoflocked = array_sum($islocked);
					// echo '<pre>';print_r($islocked);
					$revised_by = array_unique(array_column($all_modified_spec, 'revised_by'));
					$revised_by = implode(', ',$revised_by);
					$data['all_specs'][$key]['last_modified_by'] = $revised_by;
					if($sumoflocked > 0)
					{
						$lockedby = array_filter(array_unique(array_column($all_modified_spec, 'lockedby')));
						$lockedby = implode(',', $lockedby);
						$statuslocked = 'Locked';
					}
					else{
						$statuslocked = 'Un-Locked';
						$lockedby = '';
					}
					$data['all_specs'][$key]['islocked'] = $statuslocked;
					$data['all_specs'][$key]['lockedby'] = $lockedby;
				}
				else
				{
					$data['all_specs'][$key]['last_modified_by'] = '';
					$data['all_specs'][$key]['islocked'] = 'Un-Locked';
				}
			}

			// echo '<pre>';print_r($data);die;

			$data['spec_info'] = $this->MSpec->getSpecInfo();
			// echo '<pre>';print_r($data['spec_info']);die;

			$data['spec_id']   = $this->input->post("spec_id");
			$this->load->view('inc/h1.inc.php');
			$this->load->view('import_exist', $data);
	    }
	}

	public function ActionModify($param=NULL) 
	{
		$this->MSession->setSessionDetails();
	    $data['param']      = strtolower($param);
	    $data['selected']   = strtolower($this->session->userdata('selection'));
	    if(strtolower($param) == "available") {
	        $this->load->view('inc/h1.inc.php');
	        $spec_id = $this->input->post("spec_id");
	        $version_id = $this->input->post("version_id");
	        $data['modify'] = $this->MDownload->getAllSpecPdf($spec_id, $version_id);
	        //print_r($data['modify']);exit;

	        list($dstype, $dslabel, $cname, $dataset_sorted) = $this->MSpec->getTypeLabel($data['modify']['user_spec']['type']);
			$ppk = ["PPK-standard"];
            $erother=["Blank Template"];
           // print_r($data['modify']['all_var']);exit;
			$otheroptional = $this->MSpec->getotheroptional($data['modify']['all_var'] , $dstype, $ppk, $erother);

			// echo '<pre>';print_r($otheroptional);die;
			
			if(is_array($otheroptional)) {
           		 $data['modify'] = array_merge($data['modify'], $otheroptional);
        	}
        	$data['modify']['lastactivitytimeold']      = $_SESSION['LAST_ACTIVITY'];


        	$checkotherspecinprocess = $this->MUser->checkotherspecinprocess($spec_id, 1);
        	if(!empty($checkotherspecinprocess))
        	{
        		$data['modify']['existmodifying']      = 'inprocess';
        		$data['modify']['lockedby']      = '';
        	}
        	else
        	{

        		$checkotherspecinprocess = $this->MUser->checkotherspecinprocesshome($spec_id, 1);
        		if(!empty($checkotherspecinprocess))
	        	{
	        		$data['modify']['existmodifying']      = 'otherusing';
	        		
	        		$where_cond=('user_id="'.$checkotherspecinprocess['0']->lockedby.'"');
	        		$datausers = $this->MUser->GetUserData("users",$where_cond);
	        		if(!empty($datausers))
	        		{
	        			$lockedby = $datausers['0']['first_name'].' '.$datausers['0']['last_name'];
	        		}
	        		else{
	        			$lockedby = '';
	        		}

	        		$data['modify']['lockedby']      = $lockedby;
	        	}
	        	else
	        	{
	        		$data['modify']['existmodifying']      = 'free';
        			$data['modify']['lockedby']      = '';
	        	}
        	}

        	// echo '<pre>'; print_r($data);die;

	        $this->load->view('modify_exist', $data['modify']);
	    } else {
	        redirect('home/import/existing','location',301);
	    }
	}

	public function ActionReviewApprove($param=NULL) {
	    $data['param']     = strtolower($param);
	    $data['selected']  = strtolower($this->session->userdata('selection'));

	    if(strtolower($param) == "specinspect") {
	        $this->load->view('inc/h2.inc.php');
	        $spec_id = $_POST['spec_id']; 
           $version_id = $_POST['version_id'];
	       $data['pdf_specs'] = $this->MDownload->getAllSpecPdf($spec_id, $version_id);
	       //print_r($data['pdf_specs']);
	        $this->load->view('review_approve', $data['pdf_specs']);
	    } elseif (strtolower($param) == "dspecinspect") {
	       $this->load->view('inc/h2.inc.php');
	       $spec_id = $_POST['spec_id']; 
           $version_id = $_POST['version_id'];
	       $data['pdf_specs'] = $this->MDownload->getAllSpecPdf($spec_id, $version_id);
	       //print_r($data['pdf_specs']);
	        $this->load->view('review_dapprove', $data['pdf_specs']);
	    }

	    else {
	        redirect('home/import/existing','location',301);
	    }
	}

	public function ActionExportEsub($param=NULL) {
	    $data['param']     = strtolower($param);
	    $data['selected']  = strtolower($this->session->userdata('selection'));

	    if(strtolower($param) == "esub") {
	        redirect('home/export/esub','location', 301);
	    } else if(strtolower($param) == "exportesub") {
	        redirect('home/export/esubcsv','location', 301);
	    } else {
	        redirect('home/import/existing','location', 301);
	    }
	}

	public function ActionDownload($param=NULL) {
	    $data['param']     = strtolower($param); //pdffile
	    $data['selected']  = strtolower($this->session->userdata('selection')); //download
	 	//print_r($data['selected']);exit;
	    if(strtolower($param) == "pdffile") { 
           $spec_id = $_POST['spec_id']; 
           $version_id = $_POST['version_id'];
	       $data['pdf_specs'] = $this->MDownload->getAllSpecPdf($spec_id, $version_id);
	       downlondPdf($data['pdf_specs']);
	    } else if(strtolower($param) == "pdffilereview") { 
           $spec_id = $_POST['spec_id']; 
           $version_id = $_POST['version_id'];
	       $data['pdf_specs'] = $this->MDownload->getAllSpecPdf($spec_id, $version_id);
	       downlondReviewPdf($data['pdf_specs']);
	    } else if(strtolower($param) == "csvfile") {
	    	// echo 'hi';die;
	        $this->load->view('inc/h1.inc.php');
	        $spec_id = $this->input->post('spec_id');
            $version_id = $this->input->post('version_id');
	        $data['csv_specs'] = $this->MDownload->getAllSpecCsv($spec_id, $version_id);
	        // echo '<pre>';print_r($data['csv_specs']);exit;
			downlondCsvft($data['csv_specs']);
			$this->load->view('download_csv', $data['csv_specs']);

			// $csv =& get_instance();
			// $csv->load->model('CIModUser');
			// $csv = $csv->CIModUser->notifyViaEmailDownload($spec_id);
	    
	    } else if(strtolower($param) == "wordfile") {
	        $this->load->view('inc/h1.inc.php');
	        $spec_id = $this->input->post('spec_id');
            $version_id = $this->input->post('version_id');
	       	$data['word_specs'] = $this->MDownload->getAllSpecPdf($spec_id, $version_id);
	       	//print_r($data);exit;
			downlondDocxft($data['word_specs']);
			$this->load->view('download_word', $data['word_specs']); 

			// $doc =& get_instance();
			// $doc->load->model('CIModUser');
			// $doc = $doc->CIModUser->notifyViaEmailDownload($spec_id);
	    
	    } else if(strtolower($param)=="downloadcsv") {
	         $spec_id = $_POST['spec_id']; 
             $version_id = $_POST['version_id'];
             $data['csv_specs'] = $this->MDownload->getAllSpecCsv($spec_id, $version_id);
             downlondCsv($data['csv_specs']);
	    } else if(strtolower($param)=="downloaddoxc") {

			$spec_id = $this->input->post('spec_id');
			$version_id = $_POST['version_id'];
			$data['word_specs'] = $this->MDownload->getAllSpecPdf($spec_id, $version_id);
			downlondDocx($data['word_specs']);
		}
//		else if(strtolower($param)=="downloadcsvft") {
//			$spec_id = $_POST['spec_id'];
//			$version_id = $_POST['version_id'];
//			$data['csv_specs'] = $this->MDownload->getAllSpecCsv($spec_id, $version_id);
//			//print_r($data['csv_specs']);exit;
//			downlondCsvft($data['csv_specs']);
//		}
		else if(strtolower($param)=="generatesas") {
	    	 $spec_id = $_POST['spec_id']; 
             $version_id = $_POST['version_id'];
             $data['grCode_specs'] = $this->MDownload->getAllGenerateSas($spec_id, $version_id);
             //print_r( $data['grCode_specs'] );exit;
	        $this->load->view('sas_code', $data['grCode_specs']);

	    } else if(strtolower($param)=="downloadesub") {
	         $spec_id = $_POST['spec_id']; 
             $version_id = $_POST['version_id'];
             $data['esub_specs'] = $this->MDownload->getAllSpecEsub($spec_id, $version_id);
             downlondEsub($data['esub_specs']);

	    } else if(strtolower($param)=="reviewspec") {
	        $this->session->set_userdata('data', $data);
	        redirect('home/import/existing/reviewapprove', 'location', 301);
	    } else if(strtolower($param)=="modifyspec") {
	        $this->session->set_userdata('data', $data);
	        redirect('home/import/existing/modifyexist', 'location', 301);    
	    } else if(strtolower($param) == 'unauthorized') {
			$this->load->view('inc/h1.inc.php');
			$this->load->view("unauthorized");
		}else if(strtolower($param) == 'help') {
			$this->load->view('inc/h1.inc.php');
			$this->load->view("help/help");
		}else if(strtolower($param) == 'about') {
			$data = $this->MUser->getDatabaseInfo();
			$this->load->view('inc/h1.inc.php');
			$this->load->view('about', $data);
		}else if(strtolower($param) == 'logout') {
			$data = $this->MUser->getDatabaseInfo();
			$this->load->view('inc/h1.inc.php');
			$this->load->view('logout');
		}else if(strtolower($param) == 'popup') {
			$data = $this->MUser->getDatabaseInfo();
			$this->load->view('inc/h1.inc.php');
			$this->load->view('popup-page');
		}

	    else {
	        redirect('home/import/existing', 'location', 301);
	    }
	}

	// public function getsessiontime()
 //    {
 //    	if (isset($_SESSION["LAST_ACTIVITY"])) 
	// 	{
	// 		$lastactivitytime = $_SESSION["LAST_ACTIVITY"];
	// 		$afteractivity_timespent = time() - $_SESSION["LAST_ACTIVITY"];
	// 		$timeremainingforsessiontimeout = $this->config->item('sess_expiration') - $afteractivity_timespent;

	// 		$timearray = array('lastactivitytime'=>date('m/d/Y H:i:s', $lastactivitytime),
	// 						'afteractivity_timespent'=>gmdate("H:i:s", $afteractivity_timespent),
	// 						'timeremainingforsessiontimeout'=>gmdate("H:i:s", $timeremainingforsessiontimeout),
	// 						'timeremainingforsessiontimeoutinsec'=>$timeremainingforsessiontimeout);

	// 		echo json_encode($timearray);
	// 	}
	// 	else
	// 	{
	// 		$this->MSession->setSessionDetails();
	// 		$lastactivitytime = $_SESSION["LAST_ACTIVITY"];
	// 		$afteractivity_timespent = time() - $_SESSION["LAST_ACTIVITY"];
	// 		$timeremainingforsessiontimeout = $this->config->item('sess_expiration') - $afteractivity_timespent;

	// 		$timearray = array('lastactivitytime'=>date('m/d/Y H:i:s', $lastactivitytime),
	// 						'afteractivity_timespent'=>gmdate("H:i:s", $afteractivity_timespent),
	// 						'timeremainingforsessiontimeout'=>gmdate("H:i:s", $timeremainingforsessiontimeout),
	// 						'timeremainingforsessiontimeoutinsec'=>$timeremainingforsessiontimeout);

	// 		echo json_encode($timearray);
	// 	}
 //    }

	public function getsessiontime($LAST_ACTIVITY)
    {
    	if (isset($LAST_ACTIVITY)) 
		{
			$this->MSession->setSessionDetails();
			$lastactivitytime = $LAST_ACTIVITY;
			$afteractivity_timespent = time() - $lastactivitytime;
			$timeremainingforsessiontimeout = $this->config->item('sess_expiration') - $afteractivity_timespent;

			$timearray = array('lastactivitytime'=>date('m/d/Y H:i:s', $lastactivitytime),
							'afteractivity_timespent'=>gmdate("H:i:s", $afteractivity_timespent),
							'timeremainingforsessiontimeout'=>gmdate("H:i:s", $timeremainingforsessiontimeout),
							'timeremainingforsessiontimeoutinsec'=>$timeremainingforsessiontimeout);

			echo json_encode($timearray);
		}
		else
		{
			$this->MSession->setSessionDetails();
			$lastactivitytime = $_SESSION["LAST_ACTIVITY"];
			$afteractivity_timespent = time() - $_SESSION["LAST_ACTIVITY"];
			$timeremainingforsessiontimeout = $this->config->item('sess_expiration') - $afteractivity_timespent;

			$timearray = array('lastactivitytime'=>date('m/d/Y H:i:s', $lastactivitytime),
							'afteractivity_timespent'=>gmdate("H:i:s", $afteractivity_timespent),
							'timeremainingforsessiontimeout'=>gmdate("H:i:s", $timeremainingforsessiontimeout),
							'timeremainingforsessiontimeoutinsec'=>$timeremainingforsessiontimeout);

			echo json_encode($timearray);
		}
    }

    public function specapproval() 
	{
		$user_details = $this->session->user_details;
		$user_id = $user_details[0]['user_id'];
		$name = $user_details[0]['first_name'].' '.$user_details[0]['last_name'].'('.$user_details[0]['user_id'].')';

		$email_address = $user_details[0]['email_address'];

        $config['protocol']     = 'smtp';
        $config['smtp_host']    = 'mailhost.domain.com';
        $config['port']         = 25;
        $config['charset']      = 'iso-8859-1';
        $config['wordwrap']     = TRUE;
        $config['mailtype']     = 'html';

        $this->load->library('email');

        $link = base_url().'home/specapprovalemail/'.$_POST['approval_spec_id'].'/'.$_POST['approval_version_id'];
        
        $msg = "<p style='font-family: arial; font-size: 13px;'> Dear ". $_POST['approval_name'] .",<br/><br/> 
        A New Spec Approval Request has been Initiated by ". $name ." <br/><br/>
                <a href='". $link ."' style='font-family: arial; font-size: 13px; text-decoration: underline;'>Click here </a> for Spec Approval<br/><br/>

                 <span style='font-family: arial; font-size: 13px;'>". $_POST['message'] ."</span><br/><br/>

                <span style='font-family: arial; font-size: 13px;'>Thanks & Regards,</span><br/>
                <span style='font-family: arial; font-size: 13px;'>Your Team</span> <br/><br/>
                <span style='font-size: 13px; line-height: 25px; font-family: arial;'>
                <b style='background-color:#ffec0d;'> Note:</b>&nbsp;<i>This is a Do-Not-Reply Automated Mail Generated By System. Please, Reach Out To <a href='mailto:email@domain.com?subject=Drive%20Directory%20Structure%20Request%20Form%20Submission'>email@domain.com</a>
                If You Need Any Assistance. </i></span></p>";
        
        $this->email->clear();
        $this->email->initialize($config);      
        $this->email->from("emailid@domain.com", "PMWebSpec Update"); 
        $this->email->subject("PMWebSpec Spec Approval Request");
        $this->email->message($msg);

        $recipients = explode(",",$_POST['recipiente']);

        $email_to = implode(',', $recipients);
        $this->email->to($email_to );

        $recipients_cc = array(
            "emailid@domain.com",
        );
        
        $email_cc = implode(',', $recipients_cc);
        $this->email->cc($email_cc);
        if($this->email->send()) 
        {
        	$datainsert = [
	            'spec_id' => $_POST['approval_spec_id'],
	            'approver_name' => $_POST['approval_name'],
	            'recipient' => $_POST['recipiente'],
	            'message' => $_POST['message'],
	            'request_by' => $email_address];

        	$this->MSpec->insert_request_approver($datainsert);

            $msg = [];
            $msg['msg'] = "Your Request Is Sent Successfully To Spec Approval !";
            $msg['level2'] = "";
            $msg['level3'] = "";
            $msg['level3desc'] = "";
            $msg['level5'] = "";
            $msg['description'] = "";
            echo '<script> alert("Your Request Is Sent Successfully To Spec Approval!"); window.location.href = "'.base_url("home/import/existing").'";</script>'; 

        } else {
            $msg = "Email Sending Failed !";
            echo '<script> alert("Email Sending Failed!"); window.location.href = "'.base_url("home/import/existing").'";</script>'; 
        }
    }

    public function specapprovalemail($spec_id=NULL,$version_id = Null)
    {
    	$this->MSession->setSessionDetails();
		$this->load->view('inc/h2.inc.php');
        $data['pdf_specs'] = $this->MDownload->getAllSpecPdf($spec_id, $version_id);
        // echo '<pre>'; print_r($data); die;
        $this->load->view('review_approve', $data['pdf_specs']);
    }

    public function access()
    {
    	$this->load->view('access_error');
    }

    public function lockspec($spec_id=NULL,$version_id = Null)
    {
    	// echo $spec_id;die;
    	$checkotherspecinprocess = $this->MUser->checkotherspecinprocess(urldecode($spec_id), $version_id -1 );

    	// echo '<pre>';print_r($checkotherspecinprocess);die;
    	if(empty($checkotherspecinprocess))
    	{
    		$updatelockspec = $this->MUser->updatelockspec(urldecode($spec_id), $version_id -1 );
    		echo '1';
    	}
    	else
    	{
    		//$updatelockspec = $this->MUser->updatelockspecexisting(urldecode($spec_id), $version_id-2);
    		echo '0';
    	}
    }

    public function discardchange($spec_id=NULL)
    {
    	if(!empty($spec_id))
    	{
    		$spec_id = urldecode($spec_id);
			$checkexistingavailable = $this->MSpec->getSpecDetails($spec_id);

			if(!empty($checkexistingavailable))
			{
				$version_id = $checkexistingavailable['0']->version_id;

				$where_cond=array('spec_id'=> $spec_id, 'version_id'=> $version_id);
				$spec_general = $this->MSpec->deleteDataspec("spec_general",$where_cond);

				$dataset_general = $this->MSpec->deleteDataspec("dataset_general",$where_cond);

				$pk_data = $this->MSpec->deleteDataspec("pk_data",$where_cond);

				$pkms_path = $this->MSpec->deleteDataspec("pkms_path",$where_cond);

				$clinical_data = $this->MSpec->deleteDataspec("clinical_data",$where_cond);

				$dataset_structure = $this->MSpec->deleteDataspec("dataset_structure",$where_cond);

				$derivations = $this->MSpec->deleteDataspec("derivations",$where_cond);

				$missing_outlier = $this->MSpec->deleteDataspec("missing_outlier",$where_cond);

				$flag = $this->MSpec->deleteDataspec("flag",$where_cond);

				echo "<script>
		            alert('Changes has been discarded.');
		            window.location.href='".base_url()."';
		            </script>";
		            exit();
			}
			else
			{
				$updatelockspec = $this->MUser->discardchange(urldecode($spec_id));
	    		if($updatelockspec)
	    		{
	    			echo "<script>
		            alert('Changes has been discarded.');
		            window.location.href='".base_url()."';
		            </script>";
		            exit();
	    		}
	    		else
	    		{
	    			echo "<script>
		            alert('Unable to discarded change against Spec ID.');
		            window.location.href='".base_url()."';
		            </script>";
		            exit();
	    		}
			}	
    	}
    	else
    	{
    		echo "<script>
	            alert('Spec ID not Found.');
	            window.location.href='".base_url()."';
	            </script>";
	            exit();
    	}
    }

    public function discardchangemanage($spec_id=NULL)
    {
    	if(!empty($spec_id))
    	{
    		$spec_id = urldecode($spec_id);
			$checkexistingavailable = $this->MSpec->getSpecDetails($spec_id);

			if(!empty($checkexistingavailable))
			{
				$version_id = $checkexistingavailable['0']->version_id;

				$where_cond=array('spec_id'=> $spec_id, 'version_id'=> $version_id);
				$spec_general = $this->MSpec->deleteDataspec("spec_general",$where_cond);

				$dataset_general = $this->MSpec->deleteDataspec("dataset_general",$where_cond);

				$pk_data = $this->MSpec->deleteDataspec("pk_data",$where_cond);

				$pkms_path = $this->MSpec->deleteDataspec("pkms_path",$where_cond);

				$clinical_data = $this->MSpec->deleteDataspec("clinical_data",$where_cond);

				$dataset_structure = $this->MSpec->deleteDataspec("dataset_structure",$where_cond);

				$derivations = $this->MSpec->deleteDataspec("derivations",$where_cond);

				$missing_outlier = $this->MSpec->deleteDataspec("missing_outlier",$where_cond);

				$flag = $this->MSpec->deleteDataspec("flag",$where_cond);

				echo "<script>
		            alert('Changes has been discarded.');
		            window.location.href='".base_url('admin/manage/users')."';
		            </script>";
		            exit();
			}
			else
			{
				$updatelockspec = $this->MUser->discardchange(urldecode($spec_id));
	    		if($updatelockspec)
	    		{
	    			echo "<script>
		            alert('Changes has been discarded.');
		            window.location.href='".base_url('admin/manage/users')."';
		            </script>";
		            exit();
	    		}
	    		else
	    		{
	    			echo "<script>
		            alert('Unable to discarded change against Spec ID.');
		            window.location.href='".base_url('admin/manage/users')."';
		            </script>";
		            exit();
	    		}
			}	
    	}
    	else
    	{
    		echo "<script>
	            alert('Spec ID not Found.');
	            window.location.href='".base_url('admin/manage/users')."';
	            </script>";
	            exit();
    	}
    }

    public function removeBomUtf8($s){
	  if(substr($s,0,3)==chr(hexdec('EF')).chr(hexdec('BB')).chr(hexdec('BF'))){
	       return substr($s,3);
	   }else{
	       return $s;
	   }
	}

    public function datasetsave()
    {
    	if ( isset($_FILES["file"])) 
    	{
    		$csv = array();

			// check there are no errors
			if($_FILES['file']['error'] == 0){
			    $name = $_FILES['file']['name'];
			    $ext = strtolower(end(explode('.', $_FILES['file']['name'])));
			    $type = $_FILES['file']['type'];
			    $tmpName = $_FILES['file']['tmp_name'];

			    $requiredHeaders = array('var_name','var_label','units','type','round','missVal','note','source');

				$f = fopen($tmpName, 'r');
				$firstLine = fgets($f); //get first line of csv file
				fclose($f); // close file    

				$foundHeaders = str_getcsv(trim($firstLine), ',', '"'); //parse to array

				foreach($foundHeaders as $key=>$val)
				{
					if($requiredHeaders[$key] !== utf8_encode($this->removeBomUtf8($val)))
					{
						$header = 'Headers do not match: '.implode(', ', $foundHeaders);
				   		die(json_encode(array('return' => $header,'status'=>'false')));
					}
				}

			    //check the file is a csv
			    if($ext === 'csv')
			    {
			        if(($handle = fopen($tmpName, 'r')) !== FALSE) {
			            // necessary if a large csv file
			            set_time_limit(0);

			            $row = 0;

			            while(($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
			                // number of fields in the csv
			                $col_count = count($data);

			                $length = strlen(utf8_encode($this->removeBomUtf8($data[0])));

			                if(strlen(utf8_encode($this->removeBomUtf8($data[0]))) <= 8)
			                {
			                	$row1 = str_pad($row, 3, '0', STR_PAD_LEFT);
				                $csv[$row]['varorder'] = $row1;
				                $csv[$row]['var_name'] = $data[0];
				                $csv[$row]['var_label'] = $data[1];
				                $csv[$row]['unit'] = $data[2];
				                $csv[$row]['type'] = $data[3];
				                $csv[$row]['round'] = $data[4];
				                $csv[$row]['missVal'] = $data[5];
				                $csv[$row]['note'] = $data[6];
				                $csv[$row]['source'] = $data[7];
			                }
			                else
			                {
			                	die(json_encode(array('return' => 'Variable Name length should be less than or equal to 8 digit','status'=>'false')));
			                }
		                	
			                $row++;
			            }
			            fclose($handle);
			        }
			    }
			    else
			    {
			    	die(json_encode(array('return' => 'File type not allowed','status'=>'false')));
			    }
			}

			// echo '<pre>';print_r($csv);die;

			unset($csv['0']);

			$content = '';
			if(!empty($csv))
			{
				foreach($csv as $arr) 
				{
					if($arr['varorder'] != NULL) 
					{
						$content .= '
					                <tr>
					                    <td style="width:30px;"><input type="checkbox" class="checkboxc" />&nbsp;</td>
					                    <td style="width:70px;"><input type="text" class="struct" value="' . $arr['varorder'] . '" readonly /></td>

					                    <td style="display:none;"><input type="text" class="struct" value="0" readonly /></td>
					                   <td style="display:none;"><input type="text" class="struct" value="' . $arr['var_name'] . '" readonly /></td>
										<td style="display:none;"><input type="text" class="struct" value="' . $arr['var_label'] . '" readonly /></td>
										<td style="display:none;"><input type="text" class="struct" value="' . $arr['unit'] . '" readonly /></td>
										<td style="display:none;"><input type="text" class="struct" value="' . $arr['type'] . '" readonly /></td>
										<td style="display:none;"><input type="text" class="struct" value="' . $arr['round'] . '" readonly /></td>
										<td style="display:none;"><input type="text" class="struct" value="' . $arr['missVal'] . '" readonly /></td>
										<td style="display:none;"><input type="text" class="struct" value="' . $arr['note'] . '" readonly /></td>
										<td style="display:none;"><input type="text" class="struct" value="' . $arr['source'] . '" readonly /></td>




					                    <td style="width:130;"><input type="text" class="struct" maxlength="8" value="' . $arr['var_name'] . '" style="text-transform:uppercase" ' . ($arr['var_name'] == 0? '':'') . ' /></td>
					                    <td style="width:340px;"><input type="text" class="struct" maxlength="40" value="' . $arr['var_label'] . '" ' . ($arr['var_label'] == 0? '':'') . ' /></td>
					                    <td style="width:108px;"><input type="text" class="struct" maxlength="40" value="' . $arr['unit'] . '" ' . ($arr['unit'] == 0? '':'') . ' /></td>
					                     <td style="width:108px;"><input type="text" class="struct" maxlength="40" value="' . $arr['type'] . '" ' . ($arr['type'] == 0? '':'') . ' /></td>
					                    <td style="width:108px;"><input type="text" class="struct" maxlength="40" value="' . $arr['round'] . '" ' . ($arr['round'] == 0? '':'') . ' /></td>
					                    <td style="width:108px;"><input type="text" class="struct" value="' . $arr['missVal'] . '" ' . ($arr['missVal'] == 0? '':'') . ' /></td>
					                    <td style="width:325px;"><textarea class="struct" ' . ($arr['note'] == 0? '':'') . ' >'. htmlspecialchars($arr['note']) .'</textarea></td>
					                    <td style="width:310px;"><textarea class="struct" ' . ($arr['source'] == 0? '':'') . ' >'. htmlspecialchars($arr['source']) .'</textarea></td>
					                </tr>';
					}
				}
			}

			if(empty($content))
			{
				die(json_encode(array('return' => 'Data not found','status'=>'false')));
			}
			else
			{
				die(json_encode(array('status'=>'true','content'=>$content)));
			}
    	}
    	else{
    		die(json_encode(array('return' => 'File not uploaded')));
    	}
    }
}