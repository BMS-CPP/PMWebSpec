<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CIModDownload extends CI_Model {
    public $spec_id;
    public $aws_conn;

    public function __construct() {
        parent::__construct();
        $this->load->helper("security");
    }

    public function getAllSpecPdf($id, $version_id) {

        $this->db->close();
        $this->aws_conn = $this->load->database('aws_db', TRUE);
        
        if((empty($id)) || (empty($version_id))) {
            echo "<script>
            alert('Your session got expired.');
            window.location.href='".base_url()."';
            </script>";
            exit();
        }

        // echo 'hey';die;
        
        $this->aws_conn->select('*');
        $this->aws_conn->from('spec_general');
        $this->aws_conn->where('spec_id', $id);
        $this->aws_conn->where('version_id', $version_id);
        $spec_general = $this->aws_conn->get();
        if($spec_general->num_rows() > 0) {
            foreach($spec_general->result_array() as $spec_general) {
                $spec_general_details = $spec_general;    
            }           
        }

        // echo '<pre>';print_r($spec_general_details);die;
        
        $this->aws_conn->select('*');
        $this->aws_conn->from('dataset_general');
        $this->aws_conn->where('spec_id', $id);
        $this->aws_conn->where('version_id', $version_id);
        $dataset_general = $this->aws_conn->get();
        if($dataset_general->num_rows() > 0) {
            foreach($dataset_general->result_array() as $dataset_general) {
                
                $dataset_general_details= $dataset_general;    
            }           
        }

        if(is_array($dataset_general_details)) {
             $details = array_merge($spec_general_details, $dataset_general_details);
        }


        $this->aws_conn->select('*');
        $this->aws_conn->from('spec_general');
        $this->aws_conn->where('spec_id', $id);
        $spec_generall = $this->aws_conn->get();
        if($spec_generall->num_rows() > 0) {
            foreach($spec_generall->result_array() as $spec_generall) {
                $spec_general_detailss['spec_general'][] = $spec_generall;    
            }           
        }

        if(is_array($spec_general_detailss)) {
             $details = array_merge($details, $spec_general_detailss);
        }
    
        $this->aws_conn->select('*');
        $this->aws_conn->from('pk_data');
        $this->aws_conn->where('spec_id', $id);
        $this->aws_conn->where('version_id', $version_id);
        $pk_data = $this->aws_conn->get();
        if($pk_data->num_rows() > 0) {
            foreach($pk_data->result_array() as $pk_data) {
                $pk_data_details['pk_data'][] = $pk_data;    
            }           
        }

        if(is_array($pk_data_details)) {
            $details = array_merge($details, $pk_data_details);
        }

        $this->aws_conn->select('*');
        $this->aws_conn->from('clinical_data');
        $this->aws_conn->where('spec_id', $id);
        $this->aws_conn->where('version_id', $version_id);
        $clinical_data = $this->aws_conn->get();
        if($clinical_data->num_rows() > 0) {
            foreach($clinical_data->result_array() as $clinical_data) {
                $clinical_data_details['clinical_data'][] = $clinical_data;    
            }           
        }

        if(is_array($clinical_data_details)) {
            $details = array_merge($details, $clinical_data_details);
        }
        
        $this->aws_conn->select('*');
        $this->aws_conn->from('pkms_path');
        $this->aws_conn->where('spec_id', $id);
        $this->aws_conn->where('version_id', $version_id);
        $pkms_path = $this->aws_conn->get();
        if($pkms_path->num_rows() > 0) {
            foreach($pkms_path->result_array() as $pkms_path) {
                $pkms_path_details['pkms_path'][] = $pkms_path;    
            }           
        }

        if(is_array($pkms_path_details)) {
            $details = array_merge($details, $pkms_path_details);
        }

        $this->aws_conn->select('*');
        $this->aws_conn->from('dataset_structure');
        $this->aws_conn->where('spec_id', $id);
        $this->aws_conn->where('version_id', $version_id);
        $dataset_structure = $this->aws_conn->get();
        $count =1;
        if($dataset_structure->num_rows() > 0) {
            foreach($dataset_structure->result_array() as $dataset_structure) {
                //$dataset_structure_details['dataset_structure']['sr_no'][] = $count++;
                 $all_var['all_var'][] = $dataset_structure;
                $dataset_structure_details['dataset_structure'][$count++] = $dataset_structure;    
            }           
        }
        //print_r($dataset_structure_details['dataset_structure']);exit;
        if(is_array($dataset_structure_details)) {
            $details = array_merge($details, $dataset_structure_details);
        }


         if(is_array($all_var)) {
             $details = array_merge($details, $all_var);
        }

        //print_r($all_var);exit;

        $this->aws_conn->select('*');
        $this->aws_conn->from('derivations');
        $this->aws_conn->where('spec_id', $id);
        $this->aws_conn->where('version_id', $version_id);
        $derivations = $this->aws_conn->get();
        if($derivations->num_rows() > 0) {
            foreach($derivations->result_array() as $derivations) {
                $derivations_details['derivations'][] = $derivations;    
            }           
        }

        if(is_array($derivations_details)) {
            $details = array_merge($details, $derivations_details);
        }

        $this->aws_conn->select('*');
        $this->aws_conn->from('missing_outlier');
        $this->aws_conn->where('spec_id', $id);
        $this->aws_conn->where('version_id', $version_id);
        $missing_outlier = $this->aws_conn->get();
        if($missing_outlier->num_rows() > 0) {
            foreach($missing_outlier->result_array() as $missing_outlier) {
                $missing_outlier_details['missing_outlier'][] = $missing_outlier;    
            }           
        }

        if(is_array($missing_outlier_details)) {
            $details = array_merge($details, $missing_outlier_details);
        }

        $this->aws_conn->select('*');
        $this->aws_conn->from('flag');
        $this->aws_conn->where('spec_id', $id);
        $this->aws_conn->where('version_id', $version_id);
        $flag_detail = $this->aws_conn->get();
        //print_r($this->aws_conn->last_query());  exit;

        if($flag_detail->num_rows() > 0) {
            foreach($flag_detail->result_array() as $flag) {
                $flag_details['flag'][] = $flag;    
            }           
          // print_r($flag_details);exit;
        }

        if(is_array($flag_details)) {
            $details = array_merge($details, $flag_details);
        }

        $this->aws_conn->select('*');
        $this->aws_conn->from('files');
        $this->aws_conn->where('spec_id', $id);
        //$this->aws_conn->where('version_id', $version_id);
        $files = $this->aws_conn->get();
        if($files->num_rows() > 0) {
            foreach($files->result_array() as $files) {
                $files_details['files'][] = $files;    
            }           
        }

        if(is_array($files_details)) {

            $details = array_merge($details, $files_details);
        }
		//$this->db->close();
		$this->db = $this->load->database('default', TRUE);
		$this->db->select('user_id, first_name, last_name');
		$this->db->from('vw_user_access');
		$this->db->where('role_name', 'SuperUser');
		$this->db->distinct();
		//$this->aws_conn->where('version_id', $version_id);
		$programmers = $this->db->get();
		if($programmers->num_rows() > 0) {
			foreach($programmers->result_array() as $programmer) {
				$programmers_details['programmers'][] = $programmer;
			}
		}

		if(is_array($programmers_details)) {

			$details = array_merge($details, $programmers_details);
		}
        //echo $id;exit;
		$this->aws_conn->select('*');
		$this->aws_conn->from('user_spec');
		$this->aws_conn->where('spec_id', $id);
		$user_spec = $this->aws_conn->get();
		if($user_spec->num_rows() > 0) {
			foreach($user_spec->result_array() as $user_spec) {
				$user_spec_details['user_spec']= $user_spec;
			}
		}

		if(is_array($user_spec_details)) {
			$details = array_merge($details, $user_spec_details);
		}
		//print_r($details['user_spec']['compound']);exit;

        /*start*/
         if(isset($details['user_spec']['type'])) {
             $type =  $details['user_spec']['type'];
         } else {
            echo "<script>
            alert('Your session got expired.');
            window.location.href='".base_url()."';
            </script>";
            exit;
         }

        $ppk = ["PPK-standard"];
        $er = ["ER-ISOP-safety-efficacy"];
        $other=["Blank Template"];
        $ppkother=["PPK-standard", "Blank Template"];
        $erother=["Blank Template"];
        $isop=["ER-ISOP-safety-efficacy"];

        //print_r(ppk);exit;
            if (in_array($type, $ppk)) {       
            $this->db->select('*');
            $this->db->from('dsstruct');
            $this->db->where(array('SpecType' => $type, 'requiredFlag' => 0));
             $this->db->order_by('var_name',asc);
            $optionalquery = $this->db->get();

        } elseif (in_array($type, $er)) {
           $this->db->select('*');
            $this->db->from('dsstruct');
            $this->db->where('SpecType', 'ER-optional');
             $this->db->order_by('var_name',asc);
            $optionalquery = $this->db->get();

        } elseif (in_array($type, $other)) {
            $this->db->select('*');
            $this->db->from('dsstruct');
            $this->db->where('SpecType = "ER-optional" or (SpecType= "'.$type.'" and requiredFlag = 0)');
             $this->db->order_by('var_name',asc);
            $optionalquery = $this->db->get();
        }
        elseif (in_array($type, $isop)) {
            $this->db->select('*');
            $this->db->from('dsstruct');
            $this->db->where(array('SpecType' => $type, 'requiredFlag' => 0));
             $this->db->order_by('var_name',asc);
            $optionalquery = $this->db->get();
        }


        $structarray    = [];
        $optional       = [];
        $required        = [];
        // required query
        //print_r($optionalquery->result_array());exit;
        if($optionalquery->num_rows() > 0) {
            //echo "huree";exit;
            foreach( $optionalquery->result_array() as $index => $sts ) {
                //echo "huree";exit;
                $structarray[$index] = $sts;
                //print_r($sts['requiredFlag']);
                if ($sts['requiredFlag']==0) {
                   $options_details['options'][] = $sts;
                }
            }
        }
        
        //print_r($options_details);exit;
        if(is_array($options_details)) {
         $details = array_merge($details, $options_details);
        }
        return $details;
    }


     public function getAllSpecCsv($id, $version_id) {
        $this->db->close();
        $this->aws_conn = $this->load->database('aws_db', TRUE);
    
        $this->aws_conn->select('*');
        $this->aws_conn->from('spec_general');
        $this->aws_conn->where('spec_id', $id);
        $this->aws_conn->where('version_id', $version_id);
        $spec_general = $this->aws_conn->get();
        if($spec_general->num_rows() > 0) {
            foreach($spec_general->result_array() as $spec_general) {
                $spec_general_details = $spec_general;    
            }           
        }
        
        $this->aws_conn->select('*');
        $this->aws_conn->from('dataset_general');
        $this->aws_conn->where('spec_id', $id);
        $this->aws_conn->where('version_id', $version_id);
        $dataset_general = $this->aws_conn->get();
        if($dataset_general->num_rows() > 0) {
            foreach($dataset_general->result_array() as $dataset_general) {
                $dataset_general_details= $dataset_general;    
            }           
        }

        if(is_array($dataset_general_details)) {
             $details = array_merge($spec_general_details, $dataset_general_details);
        }

        $this->aws_conn->select('var_name, var_label, var_units, var_type, var_rounding, var_missing_value');
        $this->aws_conn->from('dataset_structure');
        $this->aws_conn->where('spec_id', $id);
        $this->aws_conn->where('version_id', $version_id);
        $dataset_structure = $this->aws_conn->get();
        if($dataset_structure->num_rows() > 0) {
            foreach($dataset_structure->result_array() as $dataset_structure) {
                $dataset_structure_details['dataset_structure'][]= $dataset_structure;    
            }           
        }
        
        if(is_array($dataset_structure_details)) {
             $details = array_merge($details, $dataset_structure_details);
        }

        return $details;
    }

     public function getAllSpecEsub($id, $version_id) {
        $this->db->close();
        $this->aws_conn = $this->load->database('aws_db', TRUE);
    
        $this->aws_conn->select('*');
        $this->aws_conn->from('spec_general');
        $this->aws_conn->where('spec_id', $id);
        $this->aws_conn->where('version_id', $version_id);
        $spec_general = $this->aws_conn->get();
        if($spec_general->num_rows() > 0) {
            foreach($spec_general->result_array() as $spec_general) {
                $spec_general_details = $spec_general;    
            }           
        }
        
        $this->aws_conn->select('*');
        $this->aws_conn->from('dataset_general');
        $this->aws_conn->where('spec_id', $id);
        $this->aws_conn->where('version_id', $version_id);
        $dataset_general = $this->aws_conn->get();
        if($dataset_general->num_rows() > 0) {
            foreach($dataset_general->result_array() as $dataset_general) {
                $dataset_general_details= $dataset_general;    
            }           
        }

        if(is_array($dataset_general_details)) {
             $details = array_merge($spec_general_details, $dataset_general_details);
        }

        $this->aws_conn->select('var_name, var_label, var_units, var_type, var_rounding, var_missing_value');
        $this->aws_conn->from('dataset_structure');
        $this->aws_conn->where('spec_id', $id);
        $this->aws_conn->where('version_id', $version_id);
        $dataset_structure = $this->aws_conn->get();
        if($dataset_structure->num_rows() > 0) {
            foreach($dataset_structure->result_array() as $dataset_structure) {
                $dataset_structure_details['dataset_structure'][]= $dataset_structure;    
            }           
        }
        
        if(is_array($dataset_structure_details)) {
             $details = array_merge($details, $dataset_structure_details);
        }

        return $details;
    }

    public function getAllGenerateSas($id, $version_id) {
        $this->db->close();
        $this->aws_conn = $this->load->database('aws_db', TRUE);
        
        $this->aws_conn->select('*');
        $this->aws_conn->from('dataset_general');
        $this->aws_conn->where('spec_id', $id);
        $this->aws_conn->where('version_id', $version_id);
        $dataset_general = $this->aws_conn->get();
        if($dataset_general->num_rows() > 0) {
            foreach($dataset_general->result_array() as $dataset_general) {
                $dataset_general_details= $dataset_general;    
            }           
        }

        $this->aws_conn->select('*');
        $this->aws_conn->from('user_spec');
        $this->aws_conn->where('spec_id', $id);
        $user_spec = $this->aws_conn->get();
        if($user_spec->num_rows() > 0) {
            foreach($user_spec->result_array() as $user_spec) {
                $user_spec_details['user_spec'][]= $user_spec;    
            }           
        }
        
        if(is_array($user_spec_details)) {
             $details = array_merge($dataset_general_details, $user_spec_details);
        }

        $this->aws_conn->select('*');
        $this->aws_conn->from('dataset_structure');
        $this->aws_conn->where('spec_id', $id);
        $this->aws_conn->where('version_id', $version_id);
        $dataset_structure = $this->aws_conn->get();
        if($dataset_structure->num_rows() > 0) {
            foreach($dataset_structure->result_array() as $dataset_structure) {
                $dataset_structure_details['dataset_structure'][]= $dataset_structure;    
            }           
        }
        
        if(is_array($dataset_structure_details)) {
             $details = array_merge($details, $dataset_structure_details);
        }

        return $details;
    }

     public function getAllesub_export($id, $version_id) {
        $this->db->close();
        $this->aws_conn = $this->load->database('aws_db', TRUE);
        
        $this->aws_conn->select('*');
        $this->aws_conn->from('dataset_general');
        $this->aws_conn->where('spec_id', $id);
        $this->aws_conn->where('version_id', $version_id);
        $dataset_general = $this->aws_conn->get();
        if($dataset_general->num_rows() > 0) {
            foreach($dataset_general->result_array() as $dataset_general) {
                $dataset_general_details= $dataset_general;    
            }           
        }

        $this->aws_conn->select('*');
        $this->aws_conn->from('dataset_structure');
        $this->aws_conn->where('spec_id', $id);
        $this->aws_conn->where('version_id', $version_id);
        $dataset_structure = $this->aws_conn->get();
        if($dataset_structure->num_rows() > 0) {
            foreach($dataset_structure->result_array() as $dataset_structure) {
                $dataset_structure_details['dataset_structure'][]= $dataset_structure;    
            }           
        }


    $structarray = [];
    foreach($dataset_structure_details['dataset_structure'] as $sts) {	
		if (strtoupper($sts['var_units'])=='NA') {
			$label = $sts['var_label'] ;
		} else {
			$label = $sts['var_label'] . '[' . $sts['var_units'] . ']';
		}

		if($sts['var_notes']=='NA'){
			$note = '';
		} else {
			$note = $sts['var_notes'];
		}

		if($sts['var_missing_value']=='-99'){
			if(empty($note)){
				$note = 'Missing=-99';
			} else {
				$note = $note . ', -99=Missing';
			}
		} 

		$structarray['dataset_structure'][] = array($sts['var_name'], $label, $note);
	}


        
        if(is_array($dataset_structure_details)) {
             $details = array_merge($dataset_general_details, $structarray);
        }
      // print_r($details);exit;

        return $details;
    }

    

}



?>
