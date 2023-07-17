<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CIModSpec extends CI_Model {
    public $spec_id;
    public $aws_conn_obj;

    public function __construct() {
        parent::__construct();
        $this->load->helper("security");
		$this->load->model('CIModHome', 'MHome');
		$this->load->model('CIModSession', 'MSession');
    }

    public function getSpecType() 
    {
        $oldspec = $this->config->item('oldspec');
        $this->db->distinct();
        $this->db->select("SpecType");
        $this->db->from("dsstruct");
        $this->db->where_not_in('SpecType', $oldspec);
        $this->db->order_by('varorder','ASC');
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            foreach( $query->result_array() as $index => $row ) {
                if($row['SpecType']!='ER-optional') {
                    if ($row['SpecType']=='Blank Template') {
                        $template = "Other";
                    } else {
                        $template = $row['SpecType'];
                    }
                    $spec_types[$template] = $row['SpecType'];
                }
            }

            $specordering = $this->config->item('specordering');
            $finalspecs = array();
            foreach($specordering as $specorderingname)
            {
                if (in_array($specorderingname, $spec_types))
                {
                    $finalspecs[$specorderingname] = $specorderingname;
                }
            }

            return $finalspecs;
        } else {
//          error_log('Cannot execute '.$this->db->last_query(), 3, base_url().'logs/sql_errors.log');
            return NULL;
        }
    }

    public function getvariable() 
    {
        $this->db->close();
        $this->aws_conn_obj = $this->load->database('aws_db', TRUE);
        $this->aws_conn_obj->distinct();
        $this->aws_conn_obj->select('spec_id,var_name,var_label,var_units,var_type,var_rounding,var_missing_value,var_notes,var_source');
        $this->aws_conn_obj->from('dataset_structure');
        if(!empty($_POST['vname']))
        {
            // $this->aws_conn_obj->like('var_name', $_POST['vname']);
            $this->aws_conn_obj->where('var_name', $_POST['vname']);
        }
        if(!empty($_POST['vlable']))
        {
            // $this->aws_conn_obj->like('var_label', $_POST['vlable']);
             $this->aws_conn_obj->where('var_label', $_POST['vlable']);
        }
        if(!empty($_POST['spec_id']))
        {
            // $this->aws_conn_obj->like('var_label', $_POST['vlable']);
             $this->aws_conn_obj->where('spec_id', $_POST['spec_id']);
        }
        if(!empty($_POST['vsource']))
        {
            $this->aws_conn_obj->like('var_source', $_POST['vsource']);
        }
        $flags = $this->aws_conn_obj->get();
        if($flags->num_rows() > 0) {
            foreach($flags->result_array() as $flag) {
                $flags_details[] = $flag;
            }
        }
        return $flags_details;
        $this->aws_conn_obj->close();
    }
    

    public function gettrackstudy() 
    {
        $this->db->close();
        $this->aws_conn_obj = $this->load->database('aws_db', TRUE);

        $this->aws_conn_obj->select('max(sg.version_id) as version_id,sg.spec_id,sg.modification_date,dg.dataset_inclusion,dg.dataset_path');
         $this->aws_conn_obj->distinct();
        $this->aws_conn_obj->from('spec_general as sg');
        $this->aws_conn_obj->join('dataset_general as dg', 'sg.spec_id = dg.spec_id');
        $this->aws_conn_obj->where('spec_status','0');
        $this->aws_conn_obj->group_by('spec_id');       
        $user_spec_query = $this->aws_conn_obj->get();
        if($user_spec_query->num_rows() > 0) {
            foreach($user_spec_query->result_array() as $user_spec) 
            {
                $version_id = $user_spec['version_id'];
                $spec_id = $user_spec['spec_id'];

                $this->db->close();
                $this->aws_conn_obj = $this->load->database('aws_db', TRUE);

                $this->aws_conn_obj->select('GROUP_CONCAT(study) as study');
                $this->aws_conn_obj->from('clinical_data');
                $this->aws_conn_obj->where('version_id',$version_id);
                $this->aws_conn_obj->where('spec_id',$spec_id);       
                $user_spec_query1 = $this->aws_conn_obj->get();

                if($user_spec_query1->num_rows() > 0) 
                {

                    foreach($user_spec_query1->result_array() as $clinical_data) 
                    {
                        $user_spec['study'] = $clinical_data['study'];
                    }
                }
                else
                {
                   $user_spec['study'] = ''; 
                }

                $user_spec_details[] = $user_spec;     
            }
        }

        // echo '<pre>';print_r($user_spec_details);exit;

        return $user_spec_details;
        $this->aws_conn_obj->close();
    }


    // pre-populate dataset label, type and compound name
    public function getTypeLabel($type) {

        if ($type == 'PPK-standard') {
            $label = 'Data for Population PK Analysis';
            $dataset_sorted = 'STUDYID, USUBJID, AFRELTM, EVID'; 
        }else if(strpos($type, 'PPK') !== false) {
            $label = 'Data for Population PK Analysis';
            $dataset_sorted = 'STUDYID, USUBJID, AFRELTM, EVID';
        }
        else if ($type == 'ER-ISOP-safety-efficacy') {
            $label = 'Exposure-response safety and efficacy'; 
            $dataset_sorted = 'STUDYID, USUBJID';      
        }
        else {
            $label = '';
            $type = 'Other';
        }

        $cname = '';

        return array($type, $label, $cname, $dataset_sorted);
    }

    // return variables of selected template
    public function tempVarsQuery($type, $ppk1, $er1, $other1) 
    {
        $isop=["ER-ISOP-safety-efficacy"];

        $ERisop=["ER-ISOP-safety-efficacy"];

        if($type == 'Blank-Template') {
            $type = str_replace('-', ' ', $type);
        }
        // echo $type;exit;
        if (in_array($type, $ppk1)) {

            $this->db->select('*');
            $this->db->from('dsstruct');
            $this->db->where(array('SpecType' => $type, 'requiredFlag' => 1));
            $requiredquery = $this->db->get();

            $this->db->select('*');
            $this->db->from('dsstruct');
            $this->db->where(array('SpecType' => $type, 'requiredFlag' => 0));
            $this->db->order_by('var_name','asc');
            $optionalquery = $this->db->get();

        } elseif (in_array($type, $er1)) {
            

            $this->db->select('*');
            $this->db->from('dsstruct');
            $this->db->where('SpecType', $type);
            $requiredquery = $this->db->get();

            $this->db->select('*');
            $this->db->from('dsstruct');
            //$this->db->where('SpecType', 'ER-optional');
            $this->db->where('SpecType = "ER-optional" or (SpecType= "'.$type.'" and requiredFlag = 0)');
            $this->db->order_by('var_name','asc');
            $optionalquery = $this->db->get();

            // $result = $optionalquery->result_array();
            // echo '<pre>';print_r($result);die;

        } elseif (in_array($type, $other1)) {

            $this->db->select('*');
            $this->db->from('dsstruct');
            $this->db->where(array('SpecType' => $type, 'requiredFlag' => 1));
            $requiredquery = $this->db->get();

            $this->db->select('*');
            $this->db->from('dsstruct');
            $this->db->where('SpecType = "ER-optional" or (SpecType= "'.$type.'" and requiredFlag = 0)');
            $this->db->order_by('var_name','asc');
            $optionalquery = $this->db->get();
        }
        elseif(in_array($type, $isop)) 
        {    

            if(in_array($type, $ERisop))
            {
                $this->db->select('*');
                $this->db->from('dsstruct');
                $this->db->where(array('SpecType' => $type, 'requiredFlag' => 1));
                $requiredquery = $this->db->get();

                $this->db->select('*');
                $this->db->from('dsstruct');
                $this->db->where('SpecType = "ER-optional" or (SpecType= "'.$type.'" and requiredFlag = 0)');
                $this->db->order_by('var_name','asc');
                $optionalquery = $this->db->get();
            }
            else
            {
                $this->db->select('*');
                $this->db->from('dsstruct');
                $this->db->where(array('SpecType' => $type, 'requiredFlag' => 1));
                $requiredquery = $this->db->get();
                
                $this->db->select('*');
                $this->db->from('dsstruct');
                $this->db->where(array('SpecType' => $type, 'requiredFlag' => 0));
                 $this->db->order_by('var_name','asc');
                $optionalquery = $this->db->get();
            }
        }

        // echo 'hi';die;

        $structarray    = [];
        $optional       = [];
		$required        = [];
        // required query

		if($requiredquery->num_rows() > 0) {
            //echo "huree";exit;
			foreach( $requiredquery->result_array() as $index => $sts ) {
				$structarray[$index] = $sts;

				if ($sts['requiredFlag']==1) {
					$structarray[$index]['sr_no'] = sprintf('%03d', ($index+1));
				} else {
					$optional[] = $sts;
				}
			}
		}

        // optional query
		//print_r($this->MHome->ppk);exit;
        if($optionalquery->num_rows() > 0) {
            foreach( $optionalquery->result_array() as $index => $row ) {
                $otheroptional[] = $row;
            }
        }
        // echo '<pre>';print_r($otheroptional);exit;
        // print_r($structarray);exit;
        return array($structarray, $optional, $otheroptional);
    }

    public function getotheroptional($invars, $datasettype, $pkdataset, $otherdataset) {
        //$this->aws_conn->close();
        $this->db = $this->load->database('default', TRUE);
        $isop=["ER-ISOP-safety-efficacy"];

       // print_r($otherdataset);exit;
        if (in_array($datasettype, $pkdataset)) {
            
            $this->db->select('*');
            $this->db->from('dsstruct');
            $this->db->where(array('SpecType' => $datasettype, 'requiredFlag' => 0));
             $this->db->order_by('var_name','asc');
            $optionalquery = $this->db->get();
            //echo $this->db->last_query();exit;
        } else if(in_array($datasettype, $otherdataset)) {
            // echo "2";die;
            $this->db->select('*');
            $this->db->from('dsstruct');
            $this->db->where('SpecType = "ER-optional" or (SpecType= "'.$datasettype.'" and requiredFlag = 0)');
             $this->db->order_by('var_name','asc');
            $optionalquery = $this->db->get();
        }
        elseif(in_array($datasettype, $isop)) {   
            // echo "3";die;
            $this->db->select('*');
            $this->db->from('dsstruct');
            $this->db->where('SpecType = "ER-optional" or (SpecType= "'.$datasettype.'" and requiredFlag = 0)');
            //$this->db->where(array('SpecType' => $datasettype, 'requiredFlag' => 0));
             $this->db->order_by('var_name','asc');
            $optionalquery = $this->db->get();
        }

        if($optionalquery->num_rows() > 0) {
         foreach( $optionalquery->result_array() as $index => $row ) {
            //print_r($row['var_name']);exit;
            if(!in_array($row['var_name'], $invars)) {
                $otheroptional1['otheroptional'][] = $row;
            }
         }
     }

    return $otheroptional1;

    }

    public function tempFlagQuery($spec_type) {
        $this->db->select('*');
        $this->db->from('dsflag');
        $this->db->where('SpecType', $spec_type);
        $this->db->order_by('FlagNum', 'ASC');
        $sql = $this->db->get();

        if($sql->num_rows() > 0) {
            foreach( $sql->result_array() as $index => $row ) {
                $flagarray[] = $row;
            }
        } else {
            $flagarray = NULL;
        }
        return $flagarray;
    }

    public function saveSpecDataByTable($db_obj, $tbl_name, $data_arr) {
       // $data_arr = $this->security->xss_clean($data_arr);
        $db_obj->insert($tbl_name , $data_arr);

        if ($db_obj->affected_rows() < 0) {
            $last_insert_id = NULL;
        } else {
            $last_insert_id = $db_obj->insert_id();
        }
    }
    public function saveSpecData() 
    {
        $this->db->close();
        $this->aws_conn_obj = $this->load->database('aws_db', TRUE);
        $t          = date("h:i:sa");
        $cdate = date('Y-m-d');
        
        $cname = $this->input->post("cname");
        $dstype = $this->input->post("dstype");
        $ctype = $this->input->post("ctype");
        $version_id = $this->input->post("version_id");
        if((empty($cname)) || (empty($dstype)) || (empty($ctype)) || (empty($version_id)) || (empty($this->input->post("username")))) {
            echo "<script>
            alert('Your session got expired.');
            window.location.href='".base_url()."';
            </script>";
            exit();
        }

        $spec_id    = stripslashes($this->input->post("cname", TRUE)) . '-' . stripslashes($this->input->post("dstype", TRUE)) . '-' . strtoupper(stripslashes($this->input->post("ctype", TRUE))) . '-' . $cdate . '-' . $t;
        $version_id = stripslashes($this->input->post("version_id", TRUE));

        $this->session->userdata('spec_id', $spec_id);

        // ----------- user_spec table;
        $user_spec_data = array(
                            'spec_id'       => $spec_id,
                            'created_by'    => stripslashes($this->input->post("username", TRUE)),
                            'compound'      => stripslashes($this->input->post("cname", TRUE)),
                            'indication'    => strtoupper(stripslashes($this->input->post("ctype", TRUE))),
                            'creation_date' => stripslashes($this->input->post("cdate", TRUE)),
                            'approved'      => 0,
                            'type'          => stripslashes($this->input->post("dstype", TRUE))
                          );

        $this->saveSpecDataByTable($this->aws_conn_obj, 'user_spec', $user_spec_data);

        // ------------- spec_general table;
        $ds_programmer = implode(',', $this->input->post('ds_programmer'));
        if($ds_programmer == null) {
            $ds_programmer = "----------";
        }
        $spec_gen_data = array(
                            'spec_id'           => $spec_id,
                            'version_id'        => $version_id,
                            'title'             => stripslashes($this->input->post("title", TRUE)),
                            'project_name'      => stripslashes($this->input->post("project_name", TRUE)),
                            'modification_date' => stripslashes($this->input->post("cdate", TRUE)),
                            'pk_scientist'      => stripslashes($this->input->post("pk_scientist", TRUE)),
                            'pm_scientist'      => stripslashes($this->input->post("pm_scientist", TRUE)),
                            'statistician'      => stripslashes($this->input->post("statistician", TRUE)),
                            'ds_programmer'     => $ds_programmer,
                            'changes_made'      => 'Initial Request',
                            'revised_by'        => stripslashes($this->input->post("username", TRUE))
                         );

        $this->saveSpecDataByTable($this->aws_conn_obj, 'spec_general', $spec_gen_data);

        // -------------- dataset_general table;
        $ds_gen_data = array(
                            'spec_id'                   => $spec_id,
                            'version_id'                => $version_id,
                            'dataset_number'            => 1,
                            'dataset_name'              => stripslashes($this->input->post("dataset_name", TRUE)),
                            'dataset_description'       => stripslashes($this->input->post("dataset_descriptor", TRUE)),
                            'dataset_path'              => stripslashes($this->input->post("dataset_path", TRUE)),
                            'dataset_due_date'          => stripslashes($this->input->post("dataset_date", TRUE)),
                            'dataset_label'             => stripslashes($this->input->post("dataset_label", TRUE)),
                            'dataset_multiple_record'   => stripslashes($this->input->post("dataset_records", TRUE)),
                            'dataset_inclusion'         => stripslashes($this->input->post("dataset_criteria", TRUE)),
                            'dataset_sort'              => strtoupper(stripslashes($this->input->post("dataset_sort", TRUE))),
                            'dataset_dev_path'          => stripslashes($this->input->post("dataset_dev_path", TRUE)),
                            'dataset_qc_path'           => stripslashes($this->input->post("dataset_qc_path", TRUE))
                        );

        $this->saveSpecDataByTable($this->aws_conn_obj, 'dataset_general', $ds_gen_data);

        // -------------- pk_data table;
        $request    = $this->input->method();
        $pks        = $this->input->$request("pkdata");
        $pieces     = explode("@@", $pks);

        for( $i=0; $i<count($pieces)/3-1; $i++ ) {
            $pk_data = array(   
                            'spec_id'       => $spec_id,
                            'version_id'    => $version_id,
                            'study'         => xss_clean($pieces[$i*3]),
                            'study_type'    => xss_clean($pieces[$i*3+1]),
                            'lock_type'     => xss_clean($pieces[$i*3+2])
                        );

            $this->saveSpecDataByTable($this->aws_conn_obj, 'pk_data', $pk_data);
        }

        // -------------- clinical_data table;
        $request    = $this->input->method();
        $clinicals  = $this->input->$request("clinical");
        $pieces     = explode("@@", $clinicals);

        for( $i = 0; $i<count($pieces)/6-1; $i++ ) {
            $clinical_data = array(
                                'spec_id'       => $spec_id,
                                'version_id'    => $version_id,
                                'study'         => xss_clean($pieces[$i*6]),
                                'statistician'  => xss_clean($pieces[$i*6+1]),
                                'level0'        => xss_clean($pieces[$i*6+2]),
                                'level1'        => xss_clean($pieces[$i*6+3]),
                                'level2'        => xss_clean($pieces[$i*6+4]),
                                'format'        => xss_clean($pieces[$i*6+5])
                             );

            $this->saveSpecDataByTable($this->aws_conn_obj, 'clinical_data', $clinical_data);
        }

        $request    = $this->input->method();
        $pkmspath   = $this->input->$request("pkms");
        $pieces     = explode("@@", $pkmspath);

        for( $i = 0; $i<count($pieces)/2-1; $i++ ) {
            $pkms_path_data = array(    
                                'spec_id' => $spec_id,
                                'version_id' => stripslashes($this->input->post("version_id", TRUE)),
                                'libname' => xss_clean($pieces[$i*2]),
                                'libpath' => xss_clean($pieces[$i*2+1])
                              );
            
            $this->saveSpecDataByTable($this->aws_conn_obj, 'pkms_path', $pkms_path_data);
        }



        // -------------- dataset structure table;
        $request = $this->input->method();
        $lname = $this->input->$request("passvalue");
        $pieces = explode("@@", $lname);

        for( $i = 0; $i<count($pieces)/18-1; $i++ ) {
            $ds_struct_data = array(
                                'spec_id'           => $spec_id,
                                'version_id'        => $version_id,
                                'var_name'          => xss_clean(strtoupper($pieces[$i*18+10])),
                                'var_label'         => $pieces[$i*18+11],
                                'var_units'         => $pieces[$i*18+12],
                                'var_type'          => $pieces[$i*18+13],
                                'var_rounding'      => $pieces[$i*18+14],
                                'var_missing_value' => $pieces[$i*18+15],
                                'var_notes'         => $pieces[$i*18+16],
                                'var_source'        => $pieces[$i*18+17],
                                'required'          => $pieces[$i*18+1],
                                'nameChange'        => $pieces[$i*18+2],
                                'labelChange'       => $pieces[$i*18+3],
                                'unitChange'        => $pieces[$i*18+4],
                                'typeChange'        => $pieces[$i*18+5],
                                'roundChange'       => $pieces[$i*18+6],
                                'missValChange'     => $pieces[$i*18+7],
                                'noteChange'        => $pieces[$i*18+8],
                                'sourceChange'      => $pieces[$i*18+9]
                              );
              //print_r($ds_struct_data['var_label']);
            $this->saveSpecDataByTable($this->aws_conn_obj, 'dataset_structure', $ds_struct_data);
        }



      //exit;

        // -------------- derivations table;
        $request = $this->input->method();
        $derives = $this->input->$request("derive");
        $pieces = explode("@@", $derives);

        for( $i = 0; $i<count($pieces)/2-1; $i++ ) {
            $derivations_data = array(
                                    'spec_id'       => $spec_id,
                                    'version_id'    => $version_id,
                                    'field'         => xss_clean($pieces[$i*2]),
                                    'algorithm'     => xss_clean($pieces[$i*2+1])
                                );

            $this->saveSpecDataByTable($this->aws_conn_obj, 'derivations', $derivations_data);
        }

        // -------------- outliers and missing data;
        $request = $this->input->method();
        $missings = $this->input->$request("missingadd", TRUE);

        $missing_outlier_data = array(
                                    'spec_id'           => $spec_id,
                                    'version_id'        => $version_id,
                                    'missing'           => $missings
                                );

        $this->saveSpecDataByTable($this->aws_conn_obj, 'missing_outlier', $missing_outlier_data);

        // -------------- flag table;
        $request    = $this->input->method();
        $flg        = $this->input->$request("flgs");
        $piece      = explode("@@", $flg);

        for( $i = 0; $i<count($piece)/4-1; $i++ ) {          
            $flag_data = array(
                            'spec_id'       => $spec_id,
                            'version_id'    => $version_id,
                            'flag_number'   => xss_clean($piece[$i*4]),
                            'flag_comment'  => xss_clean($piece[$i*4+1]),
                            'flag_notes'    => $piece[$i*4+2],
                            'required'      => xss_clean($piece[$i*4+3])
                         );
            
            $this->saveSpecDataByTable($this->aws_conn_obj, 'flag', $flag_data);
        }



    
        // confirmation table 
        $confs = $_REQUEST["confs"];
        $piece = explode("@@", $confs);

         // write to s3 bucket
    
    if (isset($_FILES["fileToUpload"])) {

        //include "S3connection.php";
    
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



            $this->saveSpecDataByTable($this->aws_conn_obj, 'files', $file_data); 
             $ds_path = $this->input->post("dataset_path");
            $source_path = s3_bucket_path;
            $target_path = $ds_path;
            $status = "Pending";



            $fileType = strtolower(pathinfo($name,PATHINFO_EXTENSION));
            $filenameOnly = basename($name, ".".$fileType); 

            // $filepath = str_replace(pkms_path, '', $target_path);
            // $filepath = str_replace(pkms_path2, '', $filepath);
            // $filepath = str_replace('/', '_', $filepath);   

            $file_name = $filenameOnly.$filepath.".".$fileType;

            // insert the record into metatable

             $fileData = [
            'spec_id' => $spec_id,
            'file_name' => $file_name,
            'source_path' => $source_path,
            'target_path' => $target_path,
            'status' => $status,
        ];

        $this->insert_file("file_transfer", $fileData);

        // echo 'hi';die;
           

            //move the file to S3 bucket;
            $target_file = $attachmentpath.$filenameOnly.$filepath.".".$fileType;

            if(!is_dir($attachmentpath)){
                mkdir($attachmentpath, 0755, true);
            }       
                                                
            if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
                error_log("Attachment is not uploaded because of error #" . $_FILES["fileToUpload"]["error"][0], 0);
                die("The form is submitted but attachment is not uploaded due to errors.");             
            } else {
                //file_transfer($target_file, s3_bucket_path);
            }

        }

       $this->aws_conn_obj->close();
       $this->db = $this->load->database('default', TRUE);

       
    }

     return $spec_id;
}

    public function getFlagsList() {
        $this->db->close();
        $this->aws_conn_obj = $this->load->database('aws_db', TRUE);
        $this->aws_conn_obj->distinct();
		$this->aws_conn_obj->select('u.compound, u.type, f.flag_number, f.flag_comment, f.flag_notes');
		$this->aws_conn_obj->from('user_spec as u');
		$this->aws_conn_obj->join('(SELECT * FROM flag WHERE (spec_id, version_id) IN (SELECT spec_id, max(version_id) FROM flag GROUP BY spec_id)) f', 'u.spec_id = f.spec_id and u.removed!=1', 'left');
		$this->aws_conn_obj->order_by('compound, type, flag_number');
		$flags = $this->aws_conn_obj->get();

		//echo $this->aws_conn_obj->last_query();exit;

		if($flags->num_rows() > 0) {
			foreach($flags->result_array() as $flag) {
				$flags_details[] = $flag;
			}
		}
		//print_r($flags_details);exit;
		return $flags_details;


        $this->aws_conn_obj->close();

    }

    public function getAllSpecDetails() {
        $this->db->close();
        $this->aws_conn_obj = $this->load->database('aws_db', TRUE);

        $this->aws_conn_obj->select('us.spec_id, us.created_by,dg.dataset_path,us.indication,us.type ,us.creation_date,us.approved,us.approved_by,us.compound');
         $this->aws_conn_obj->distinct();
        $this->aws_conn_obj->from('user_spec as us');
        $this->aws_conn_obj->join('dataset_general as dg', 'us.spec_id = dg.spec_id');
        //$this->aws_conn_obj->where('approved = 0');
        $this->aws_conn_obj->where('removed != 1');
        $this->aws_conn_obj->where('dg.version_id = (select max(dg_inner.version_id) from dataset_general as dg_inner where dg.spec_id = dg_inner.spec_id);');
        //$this->aws_conn_obj->order_by('version_id', 'desc');
        //$this->aws_conn_obj->limit('1');
       
        $user_spec_query = $this->aws_conn_obj->get();
      // print_r($this->aws_conn_obj->last_query());  exit;
        if($user_spec_query->num_rows() > 0) {
            foreach($user_spec_query->result_array() as $user_spec) {
                $user_spec_details[] = $user_spec;     
            }
        }
        //print_r($user_spec_details);exit;
        return $user_spec_details;
        
    }

    public function getAllSpecDetailsimport() 
    {
        $specnotallowed = $this->config->item('specnotallowed');

        $this->db->close();
        $this->aws_conn_obj = $this->load->database('aws_db', TRUE);

        $this->aws_conn_obj->select('us.spec_id, us.created_by,dg.dataset_path,us.indication,us.type ,us.creation_date,us.approved,us.approved_by,us.compound');
        $this->aws_conn_obj->distinct();
        $this->aws_conn_obj->from('user_spec as us');
        $this->aws_conn_obj->join('dataset_general as dg', 'us.spec_id = dg.spec_id');
        $this->aws_conn_obj->where('removed != 1');
        // $this->aws_conn_obj->where_not_in('type', $specnotallowed);
        $this->aws_conn_obj->where('dg.version_id = (select max(dg_inner.version_id) from dataset_general as dg_inner where dg.spec_id = dg_inner.spec_id);');
        
        $user_spec_query = $this->aws_conn_obj->get();
      // print_r($this->aws_conn_obj->last_query());  exit;
        if($user_spec_query->num_rows() > 0) {
            foreach($user_spec_query->result_array() as $user_spec) {
                $user_spec_details[] = $user_spec;     
            }
        }
        //print_r($user_spec_details);exit;
        return $user_spec_details;
    }

    public function getSpecInfo() {
        $this->db->close();
        $this->aws_conn_obj = $this->load->database('aws_db', TRUE);

        $data = NULL;

        // get the spec information
        if(!empty($this->input->post('spec_id'))) {
            $spec_id = $this->input->post("spec_id");
            $this->aws_conn_obj->select("*");
             $this->aws_conn_obj->distinct(); 
            $this->aws_conn_obj->from("spec_general");
            $this->aws_conn_obj->where("spec_id", $spec_id);
            $spec_query = $this->aws_conn_obj->get();

            if($spec_query->num_rows() > 0) {
                foreach($spec_query->result_array() as $spec) {
                    // echo '<pre>';print_r($spec);die;
                    if($spec['spec_status'] == '1')
                    {
                        $user_name = $this->session->user_details;
                        $created_by_session = $user_name[0]['user_id'];
                        if($spec['lockedby'] == $created_by_session)
                        {
                            $spec_gnrl[]     = $spec;
                            $version_array[] = $spec['version_id'];
                        }
                    }
                    else
                    {
                        $spec_gnrl[]     = $spec;
                        $version_array[] = $spec['version_id'];
                    }
                }

                arsort($version_array);
                $crrnt_vrsn = max($version_array);
                $data['spec_gnrl']  = $spec_gnrl;
                $data['crrnt_vrsn'] = $crrnt_vrsn;
                $data['vrsn_list']  = $version_array;
            }
        }
        return $data;
    }
    public function getApprovedInfo($spec_id) {
		$this->aws_conn_obj = $this->load->database('aws_db', TRUE);
		$this->aws_conn_obj->select("approved");
		$this->aws_conn_obj->where("spec_id", $spec_id);
		$this->aws_conn_obj->from('user_spec');
		$result = $this->aws_conn_obj->get()->row();
		//print_r($result);exit;
		return $result->approved;
	}
	public function getMaxVersion($table, $where)
	{
		$this->aws_conn = $this->load->database('aws_db', TRUE);
		$this->aws_conn->select_max('version_id');
		$this->aws_conn->where('spec_id',$where);
		$result = $this->aws_conn->get($table)->row();
		return $result->version_id;
	}

   function get_escap_str($var) {
	   $this->db->close();
	   $this->aws_conn = $this->load->database('aws_db', TRUE);
    	return $this->aws_conn->escape_str($var);
   }

   public function saveUpdateValue($table, $data, $spec_id, $version_id) {
   $this->db->close();
   $this->aws_conn = $this->load->database('aws_db', TRUE);

    if((empty($spec_id)) || (empty($version_id))) {
                echo "<script>
                alert('Your session got expired.');
                window.location.href='".base_url()."';
                </script>";
                exit();
            }

    $dataInsert = [];
    $dataInsert['spec_id'] = $spec_id;
    $dataInsert['version_id'] = $version_id;
	   foreach($data as $key => $val) {
		   $dataInsert[$key] = $val;
		}
	   //print_r($dataInsert);exit;
	   $this->aws_conn->insert($table,$dataInsert);
	   return 1;
   }


   public function saveUpdatefiledata($table, $data) {
   $this->db->close();
   $this->aws_conn = $this->load->database('aws_db', TRUE);
   
       $this->aws_conn->insert($table,$data);
       $this->aws_conn->close();
       return 1;
   }

	public function insert_file($table_name, $data) {
        //echo "hureee";exit;
		$this->db->close();
		$this->aws_conn = $this->load->database('aws_db', TRUE);
		$user_name = $this->session->user_details;
		$created_by = $user_name[0]['user_id'];
		//date_default_timezone_set('US/Eastern');
		$created_date = date("Y-m-d H:i:s");

		$data = [
			'spec_id' => $data['spec_id'],
			'file_name' => $data['file_name'],
			'source_path' => $data['source_path'],
			'target_path' => $data['target_path'],
			'status' => $data['status'],
			'created_by' => 'testu1',
			'created_date' => $created_date,
			];
		$this->aws_conn->insert($table_name,$data);
        $this->aws_conn->close();
         return 1;
        //echo $this->aws_conn->last_query(); exit;
	}

    public function getModifiedAllSpecDetails($spec_id) 
    {
        $this->db->close();
        $this->aws_conn_obj = $this->load->database('aws_db', TRUE);

        $this->aws_conn_obj->select('*');
        $this->aws_conn_obj->from('spec_general');
        $this->aws_conn_obj->where('spec_id',$spec_id);
        $query = $this->aws_conn_obj->get();

        return $spec_ids_data = $query->result();
    }

    public function insert_request_approver($data) 
    {
        $this->db->close();
        $this->aws_conn = $this->load->database('aws_db', TRUE);
        $created_date = date("Y-m-d H:i:s");
        $this->aws_conn->insert('approve_request',$data);
        $this->aws_conn->close();
         return 1;
    }

    public function getSpecDetails($spec_id) 
    {
        $this->db->close();
        $this->aws_conn_obj = $this->load->database('aws_db', TRUE);

        $this->aws_conn_obj->select('*');
        $this->aws_conn_obj->from('spec_general');
        $this->aws_conn_obj->where('spec_id',$spec_id);
        $this->aws_conn_obj->where('spec_status','1');
        $query = $this->aws_conn_obj->get();

        return $spec_ids_data = $query->result();
    }

    public function deleteDataspec ($table,$condition) 
    {
        $this->db->close();
        $this->aws_conn_obj = $this->load->database('aws_db', TRUE);
        $this->aws_conn_obj->where($condition);
        $this->aws_conn_obj->delete($table);
        return 1;
    }
}