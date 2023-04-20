<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CIModUser extends CI_Model {

    public $user_id;

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('email');
        // $this->user_id = $this->session->userdata('user_id');
        $this->user_id = 'testu1';
    }

	public function getDatabaseInfo() {
		$this->db->close();
		$this->aws_conn = $this->load->database('aws_db', TRUE);
		//print_r($this->aws_conn);exit;
		//exit;
		return $this->aws_conn;
		$this->aws_conn->close();
	}


	// Get user details of given user name
    public function getUserDetailsByUserId() {
        $url = base_url();

        $cookie_params = $_COOKIE;
        if (isset($cookie_params['sm_user']) && !empty($cookie_params['sm_user'])) 
        {
            setcookie('sm_user', 'testu1', time() + (86400 * 30), '/');
            $this->session->set_userdata('user_id', 'testu1');
        }
        else
        {
            $cookie_name = "sm_user";
            $cookie_value = "testu1";
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

            $this->session->set_userdata('user_id', 'testu1');
        }

        // $this->user_id = $this->session->userdata('user_id');
        $this->user_id = 'testu1';
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('user_id', trim($this->user_id));
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            foreach( $query->result_array() as $row ) {
                //$user_details[$row['user_id']] = $row;
				$user_details[] = $row;
            }
            return $user_details;
        } else {
//              error_log('Cannot execute '.$this->db->last_query(), 3, base_url().'logs/sql_errors.log');
            return NULL;
        }
    }

    // Get active users list
    public function getDistinctUserId() {
        $this->db->distinct('u.user_id');
        $this->db->from('users as u');
        $this->db->join('user_role_mapping as urm', 'urm.user_id=u.user_id');
        $this->db->where('end_date IS NULL');
        $this->db->where('isactive','1');
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            foreach( $query->result_array() as $row ) {
                $distinct_users[] = $row['user_id'];
            }
            return $distinct_users;
        } else {
//             error_log('Cannot execute '.$this->db->last_query(), 3, base_url().'logs/sql_errors.log');
            return NULL;
        }
    }

    // Get all access related data from vw_user_access
    public function getUserAccessDataByUserName() {
        // $this->user_id = $this->session->userdata('user_id');
        $this->user_id = 'testu1';
        $this->db->select('screen_name');
        $this->db->from('vw_user_access as vua');
        $this->db->where('vua.user_id', $this->user_id);
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            foreach( $query->result_array() as $row ) {
                $user_access_data['screen_name'][] = $row['screen_name'];
            }
            return $user_access_data;
        } else {
//             error_log('Cannot execute '.$this->db->last_query(), 3, base_url().'logs/sql_errors.log');
            return NULL;
        }
    }

    // Get all super users details
    public function getAllSuperUserDetails() {
        $this->db->distinct();
        $this->db->select('user_id, first_name, last_name');
        $this->db->from('vw_user_access');
        $this->db->where('role_name', 'SuperUser');
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $super_user_details[] = $row;
            }
           
            return $super_user_details;
        } else {
//             error_log('Cannot execute '.$this->db->last_query(), 3, base_url().'logs/sql_errors.log');
            return NULL;
        }
    }
    
    public function notifyViaEmail($data) {
       //print_r($data);exit;
        $user_details = $this->session->user_details;
        $user_email = $user_details[0]['email_address'];
        $name = $user_details[0]['first_name']." ".$user_details[0]['last_name'];
        //print_r($user_details);exit;
        $config['protocol']     = 'smtp';
        $config['smtp_host']    = 'mailhost.domain.com';
        $config['port']         = 25;
        $config['charset']      = 'iso-8859-1';
        $config['wordwrap']     = TRUE;
        $config['mailtype']     = 'html';
        
        $msg = "<p style='font-family: arial; font-size: 13px;'> Dear All,<br/><br/> A New Directory Request Has Been Submitted By ".$name." ! <br/><br/>
                <span style='font-family: arial; font-size: 13px; text-decoration: underline;'>Request Summary</span><br/><br/>
                <span style='font-family: arial; font-size: 13px;'>Request By : ". $data['requester'] ."</span><br/>
                <span style='font-family: arial; font-size: 13px;'>Level 1 : ". $data['level1'] ."</span><br/>
                <span style='font-family: arial; font-size: 13px;'>Level 2 : " . $data['level2'] ."</span><br/>
                <span style='font-family: arial; font-size: 13px;'>Level 3 : " . $data['level3'] ."</span><br/>
                  <span style='font-family: arial; font-size: 13px;'>Level 3 Description : " . $data['level3desc'] ."</span><br/>
                <span style='font-family: arial; font-size: 13px;'>Level 5 : ". $data['level5'] ."</span><br/>

                 <span style='font-family: arial; font-size: 13px;'>Analysis Directory Description : ". $data['description'] ."</span><br/><br/>

                <span style='font-family: arial; font-size: 13px;'>Thanks & Regards,</span><br/>
                <span style='font-family: arial; font-size: 13px;'>Your Team</span> <br/><br/>
                <span style='font-size: 13px; line-height: 25px; font-family: arial;'>
                <b style='background-color:#ffec0d;'> Note:</b>&nbsp;<i>This is a Do-Not-Reply Automated Mail Generated By System. Please, Reach Out To <a href='mailto:email@domain.com?subject=Drive%20Directory%20Structure%20Request%20Form%20Submission'>email@domain.com</a>
                If You Need Any Assistance. </i></span></p>";
        
        $this->email->clear();
        $this->email->initialize($config);      
        $this->email->from("emailid@domain.com", "PMWebSpec Update"); 
        $this->email->subject("Drive Directory Structure Request");
        $this->email->message($msg);

        $recipients = array(
            "emailid@domain.com",
             $user_email,
        );

        if ((base_url() == 'https://application.domain.com/') || (base_url() == 'http://localhost/') || (base_url() == 'https://application.dev.domain.com/') || (base_url() == 'https://application.demo.domain.com/') || (base_url() == 'https://dev.domain.com/')){
            $recipients =  array(
            "email@domain.com",);
        }

        $email_to = implode(',', $recipients);
        $this->email->to($email_to );

        $recipients_cc = array(
            "emailid@domain.com",
            
        );
        
        $email_cc = implode(',', $recipients_cc);
        $this->email->cc($email_cc);
    
        $this->email->attach($data['file_path'], "attachment");

        if($this->email->send()) {
            $msg = [];
            $msg['msg'] = "Your Request Is Sent Successfully To DS Programmer !";
            $msg['level2'] = "";
            $msg['level3'] = "";
            $msg['level3desc'] = "";
            $msg['level5'] = "";
            $msg['description'] = "";


        } else {
            $msg = "Email Sending Failed !";
        }
       
        return $msg;
    }

	public function notifySpecSubmitted($data) {
        $user_details = $this->session->user_details;
        $user_email = $user_details[0]['email_address'];
    
		$config['protocol']     = 'smtp';
		$config['smtp_host']    = 'mailhost.domain.com';
		$config['port']         = 25;
		$config['charset']      = 'iso-8859-1';
		$config['wordwrap']     = TRUE;
		$config['mailtype']     = 'html';

		$msg = "<p style='font-family: arial; font-size: 13px;'> Dear All,<br/><br/> New Spec is submitted successfully. <br/><br/>
                <span style='font-family: arial; font-size: 13px; text-decoration: underline;'>Please find below Spec Id</span><br/><br/>
                <span style='font-family: arial; font-size: 13px;'>Spec ID : ". $data['spec_id'] ."</span><br/>
               <br/><br/>
                <span style='font-family: arial; font-size: 13px;'>Thanks & Regards,</span><br/>
                <span style='font-family: arial; font-size: 13px;'>Your Team</span> <br/><br/>
                <span style='font-size: 13px; line-height: 25px; font-family: arial;'>
                <b style='background-color:#ffec0d;'> Note:</b>&nbsp;<i>This is a Do-Not-Reply Automated Mail Generated By System. Please, Reach Out To <a href='mailto:email@domain.com?subject=Drive%20Directory%20Structure%20Request%20Form%20Submission'>email@domain.com</a>
                If You Need Any Assistance. </i></span></p>";

		$this->email->clear();
		$this->email->initialize($config);
		$this->email->from("emailid@domain.com", "PMWebSpec Update");
		$this->email->subject("Spec Submitted Successfully");
		$this->email->message($msg);
		 $recipients = array(
            "emailid@domain.com",
             $user_email,
        );

        if ((base_url() == 'https://application.domain.com/') ||  (base_url() == 'http://localhost/') || (base_url() == 'https://application.dev.domain.com/') || (base_url() == 'https://application.demo.domain.com/')){
            $recipients =  array(
            "email@domain.com",);
         } 
        $email_to = implode(',', $recipients);
        $this->email->to($email_to );

        $recipients_cc = array(
            "emailid@domain.com",
            
        );
        
        $email_cc = implode(',', $recipients_cc);
        $this->email->cc($email_cc);
		$this->email->send();
		return $msg;
	}


    public function notifyViaEmailDownload($spec_id) {
        $user_details = $this->session->user_details;
        $user_email = $user_details[0]['email_address'];
        //print_r($user_details);exit;
        $config['protocol']     = 'smtp';
        $config['smtp_host']    = 'mailhost.domain.com';
        $config['port']         = 25;
        $config['charset']      = 'iso-8859-1';
        $config['wordwrap']     = TRUE;
        $config['mailtype']     = 'html';

        $msg = "<p style='font-family: arial; font-size: 13px;'> Hi ". $user_details[0]['first_name'].",<br/><br/> Spec is download  successfully. <br/><br/>
                <span style='font-family: arial; font-size: 13px; text-decoration: underline;'>Please find below Spec Id</span><br/><br/>
                <span style='font-family: arial; font-size: 13px;'>Spec ID : ". $spec_id ."</span><br/>
               <br/><br/>
                <span style='font-family: arial; font-size: 13px;'>Thanks & Regards,</span><br/>
                <span style='font-family: arial; font-size: 13px;'>Your Team</span> <br/><br/>
                <span style='font-size: 13px; line-height: 25px; font-family: arial;'>
                <b style='background-color:#ffec0d;'> Note:</b>&nbsp;<i>This is a Do-Not-Reply Automated Mail Generated By System. Please, Reach Out To <a href='mailto:email@domain.com?subject=Drive%20Directory%20Structure%20Request%20Form%20Submission'>email@domain.com</a>
                If You Need Any Assistance. </i></span></p>";

        $this->email->clear();
        $this->email->initialize($config);
        $this->email->from("emailid@domain.com", "PMWebSpec Update");
        $this->email->subject("Spec Download Successfully");
        $this->email->message($msg);
         $recipients = array(
             $user_email,
        );
        if ((base_url() == 'https://application.domain.com/') ||  (base_url() == 'http://localhost/') || (base_url() == 'https://application.dev.domain.com/') || (base_url() == 'https://application.demo.domain.com/')){
            $recipients =  array(
            "email@domain.com",);
         }
        $email_to = implode(',', $recipients);
        $this->email->to($email_to );

        $recipients_cc = array(
            "emailid@domain.com",
           
        );
        
        $email_cc = implode(',', $recipients_cc);
        $this->email->cc($email_cc);
        $this->email->send();
        return $msg;
    }

    public function saveUpdatedUserData ($data) {
        $date = date("Y-m-d H:i:s");
		$user_name = $this->session->user_details;
		$fullname = $user_name[0]['first_name']." ".$user_name[0]['last_name'];
        $created_by_session = $user_name[0]['user_id'];
        $data_info = [
            'first_name'   => $data['fname'],
            'last_name'   =>  $data['lname'],
            'email_address'   => $data['email'],
            'last_updated_by' => $created_by_session,
            'last_updated_date' => $date,
        ];
        $this->db->where('user_id', $data['userid']);
        $this->db->update('users', $data_info);

        $data_role_info = [
            'role_name' => $data['new_role'],
            'last_modified_by' => $created_by_session, //$_SESSION['username'],
            'last_modified_date' => $date,
        ];
        $this->db->where('user_id', $data['userid']);
        $this->db->update('user_role_mapping', $data_role_info);
    
    return "Users is added Successfully!";
    }

    public function getUserDetailsToAddUserId() 
    {
        $this->db->select("role_name");
        $this->db->from('roles');
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            foreach( $query->result_array() as $row ) {
                $roles['roles'][] = $row;
            }
        }

        // echo '<pre>';print_r($roles);die;

        return $roles;
    }

    public function getUserinformation() {
        $this->db->from('users');
        $user_count= $this->db->count_all_results();
        return $user_count;         
    }

     public function getUserDetailsToUpdateUserId($user_id) {
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('user_id', trim($user_id));
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            foreach( $query->result_array() as $row ) {
                $user_details = $row;
            }
        }else {
               $user_details = Null; 
            }

        $this->db->select('role_name');
        $this->db->from('user_role_mapping');
        $this->db->where('user_id', trim($user_id));
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            foreach( $query->result_array() as $row ) {
                $role['role'][] = $row;
            }
        }

        $details = array_merge($user_details, $role);


        $this->db->select('role_name');
        $this->db->from('roles');
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            foreach( $query->result_array() as $row ) {
                $roles['roles'][] = $row;
            }
        }
        $details = array_merge($details,$roles);
        return $details;
    }

    public function getUserId() {
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('isactive','1');
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            foreach( $query->result_array() as $row ) {
                $user_details[] = $row;
            }
        }else {
               $user_details = Null; 
            }        
            return $user_details;
    }

	public function getUserIds($table,$user_id) {
		$this->db->select("*");
		$this->db->from($table);
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			foreach( $query->result_array() as $row ) {
				$user_details[] = $row;
			}
		}else {
			$user_details = Null;
		}
		return $user_details;
	}

	public function removeUserData($user_id) {
    	//echo $user_id;exit();
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            foreach( $query->result_array() as $row ) {
                $user_details = $row;
            }
        }else {
               $user_details = Null; 
            }

        $this->db->select('role_name');
        $this->db->from('user_role_mapping');
        $this->db->where('user_id', trim($user_id));
        $this->db->distinct();
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            foreach( $query->result_array() as $row ) {
                $role['role'][] = $row;
            }
        }
        return $details = array_merge($user_details, $role);

    }

    public function removeUseAndRole($data) 
    {
        foreach ($data['role'] as $value) {
            $this->db->where('user_id', $data['user_id']);
            $this->db->where('role_name', $value);
            $this->db->delete('user_role_mapping');    
        }



        $this->db->select('role_name');
        $this->db->from('user_role_mapping');
        $this->db->where('user_id', trim($data['user_id']));
        $query = $this->db->get();

        $date = date("Y-m-d H:i:s");
        $user_name = $this->session->user_details;
        $fullname = $user_name[0]['first_name']." ".$user_name[0]['last_name'];
        $created_by_session = $user_name[0]['user_id'];

        if($query->num_rows() > 0) 
        {
            $data_info = [
                'isactive'   => '0',
                'last_updated_by' => $created_by_session,
                'last_updated_date' => $date,
            ];
            $this->db->where('user_id', $data['user_id']);
            $this->db->update('users', $data_info);
            return 1;
        } else 
        {
            $data_info = [
                'isactive'   => '0',
                'last_updated_by' => $created_by_session,
                'last_updated_date' => $date,
            ];
            $this->db->where('user_id', $data['user_id']);
            $this->db->update('users', $data_info); 
            return 1;
        }
    }

    public function getRolevsScreen() {
        //Roles
        $this->db->select('role_name, role_description');
        $this->db->from('roles');
        $query = $this->db->get();
        if($query->num_rows() > 0) { 
            foreach( $query->result_array() as $row ) {
                $roles['roles'][] = $row ;
            }
             // $roles['roles'][] = array($roles1['role_name'] => $roles1['role_description']);
        }

        $this->db->select('screen_name');
        $this->db->distinct();
        $this->db->from('screens');
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            foreach( $query->result_array() as $row ) {
                $screens['screens'][] = $row;
            }
             // $screens['screens'][] = $row['screen_name'];

        }
         $details = array_merge($roles, $screens);
        $maparray = [];
        foreach ( $roles['roles'] as $value) {
        $associatedscreens =[];
        $this->db->select('screen_name');
        $this->db->where('role_name', $value['role_name']);
        $this->db->from('role_screen_mapping');
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            foreach( $query->result_array() as $row ) {
                $associatedscreens[] = $row['screen_name'] ;
            }
        }
            $maparray['mapping'][] = array($value['role_name'] => $associatedscreens);
        }
       //print_r($maparray);exit;

        return  $details = array_merge( $details, $maparray);

    }

    public function saveData ($table,$data) {
    	$this->db->insert($table,$data);
    	return 1;
    }
    public function updateData ($table,$condition,$data) {
    	$this->db->where( $condition);
    	$this->db->update($table,$data);
    	return 1;
    }



    public function saveMultipleData ($table,$data) {
       
    $this->db->insert_batch($table,$data);
        
    return 1;
    }

    public function deleteData ($table,$condition) {
		//echo $this->aws_conn->last_query();exit;
        $this->db->where($condition);
        $this->db->delete($table);
        return 1;
    }

    public function deleteformula ($table,$condition) {
        //echo $this->aws_conn->last_query();exit;
        $data = array('isactive'=>'0');
        $this->db->close();
        $this->aws_conn = $this->load->database('aws_db', TRUE);
        $this->aws_conn->where($condition);
        $this->aws_conn->update($table,$data);
        return 1;
    }

     public function updateformula ($table,$condition,$data) {
         $this->db->close();
        $this->aws_conn = $this->load->database('aws_db', TRUE);
        $this->aws_conn->where( $condition);
        $this->aws_conn->update($table,$data);
        //echo $this->aws_conn->last_query();exit;
        return 1;
    }


     public function GetUserData ($table,$condition) {
        //echo $this->aws_conn->last_query();exit;
         $this->db->select("*");
        $this->db->from('users');
        $this->db->where($condition);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;

        $res=[];
        if($query->num_rows() > 0) {
            foreach( $query->result_array() as $row ) {
               $res[]= $row;
            }
        }
        
       // print_r($res);exit();  
        return $res;
  
    }

    public function getSpecDetailsToRemove ($spec_id) {
        $this->db->close();
        $this->aws_conn = $this->load->database('aws_db', TRUE);   
        $where_array = array('removed !=' => '1', 'spec_id' => $spec_id); 
        $this->aws_conn->select("*");
        $this->aws_conn->from('user_spec');
        $this->aws_conn->where($where_array);
        $query = $this->aws_conn->get();
        $res=[];
        if($query->num_rows() > 0) {
           $res= $query->row();
        }
        $this->aws_conn->close();
        //print_r($res);exit();  
        return $res;
    }

    public function getSpecDetailsToUnapprove($spec_id) {
        $this->db->close();
        $this->aws_conn = $this->load->database('aws_db', TRUE);   
        $where_array = array('approved !=' => '0', 'spec_id' => $spec_id); 
        $this->aws_conn->select("*");
        $this->aws_conn->from('user_spec');
        $this->aws_conn->where($where_array);
        $query = $this->aws_conn->get();
        //echo $this->aws_conn->last_query();exit;
        $res=[];
        if($query->num_rows() > 0) {
           $res= $query->row();
        }
        $this->aws_conn->close();
        //print_r($res);exit();  
        return $res;

    }

    public function getTeamplate() 
    {
        $oldspec = $this->config->item('oldspec');
        $specordering = $this->config->item('specorderingmanage');

       $this->db->select('SpecType');
       $this->db->distinct();
       $this->db->from("dsstruct");       
       $this->db->where_not_in('SpecType', $oldspec);
       
       $query = $this->db->get();
        if($query->num_rows() > 0) {
            foreach( $query->result_array() as $row ) {
                $temp['temp'][] = $row['SpecType'] ;
            }
        }

        $finalarr = array();
        foreach($specordering as $spec ) 
        {
            if (in_array($spec, $temp['temp']))
            {
              $finalarr['temp'][] = $spec;
            }
        }

        return $finalarr;
    }

    public function getVariables($temp_type) {
        $this->db->select('var_name');
        $this->db->from('dsstruct');
        $where = 'SpecType = "'.$temp_type.'" or SpecType = "ER-optional"';
        $this->db->where($where);
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            foreach( $query->result_array() as $row ) {
                $variables['var'][] = $row['var_name'] ;
            }
        }
        return $variables;
    }

     public function getFlags($temp_type) {
        $this->db->from('dsflag');
        $this->db->where('SpecType', $temp_type);
        $this->db->order_by('FlagNum');
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            foreach( $query->result_array() as $row ) {
                $flags['flag'][] = $row['FlagNum'] ;
            }
        }
        //print_r($flags);
        return $flags;
    }


    public function updateAWSData ($table,$condition,$data) {
        $this->db->close();
        $this->aws_conn = $this->load->database('aws_db', TRUE); 

         $this->aws_conn->where( $condition);
        $this->aws_conn->update($table,$data);
        $this->aws_conn->close();
        
    return 1;
    }

    public function saveAWSData ($table,$data) {
        $this->db->close();
        $this->aws_conn = $this->load->database('aws_db', TRUE); 
       $this->aws_conn->insert($table,$data);
        $this->aws_conn->close();
    return 1;
    }

    public function checkApprove($spec_id) {
        $this->db->close();
        $this->aws_conn = $this->load->database('aws_db', TRUE); 
        $this->aws_conn->select('*');
        $this->aws_conn->from('user_spec');
        $where = 'spec_id = "'.$spec_id.'" AND  approved= "1"';
        $this->aws_conn->where($where);
        $query = $this->aws_conn->get();

        if($query->num_rows() > 0) {
            return 1;
            $this->aws_conn->close();
            } 
            else {
                return 0;
                $this->aws_conn->close();
            }
    }

    public function getSSignature($spec_id) {
        $this->db->close();
        $this->aws_conn_obj = $this->load->database('aws_db', TRUE);
        $this->aws_conn_obj->select('*');
        $this->aws_conn_obj->from('signature');
        $this->aws_conn_obj->where('spec_id', $spec_id);

        $signature = $this->aws_conn_obj->get();
        if($signature->num_rows() > 0) {
            foreach($signature->result_array() as $ssignature) {
                $signature_details['signature']= $ssignature;    
            }           
        }
        return $signature_details['signature'];
    }


 public function getFormula() {

         $this->db->close();
        $this->aws_conn = $this->load->database('aws_db', TRUE);
       
        $this->aws_conn->from('formula');
        $this->aws_conn->where('isactive','1');
        $query = $this->aws_conn->get();

        if($query->num_rows() > 0) {
            foreach( $query->result_array() as $row ) {
                $formula[] = $row;
            }
            return $formula;
        } else {
//             error_log('Cannot execute '.$this->db->last_query(), 3, base_url().'logs/sql_errors.log');
            return NULL;
        }
    }

    public function getusercount()
    {
        $this->db->select('count(user_id) as activeuser');
        $this->db->from('users');
        $this->db->where('isactive','1');
        $query = $this->db->get();

        if($query->num_rows() > 0) 
        {
            $row = $query->result_array();
            $activeuser = $row['0']['activeuser'];
        }
        else
        {
            $activeuser = 0;
        }

        $this->db->select('count(user_id) as deactiveuser');
        $this->db->from('users');
        $this->db->where('isactive','0');
        $query = $this->db->get();

        if($query->num_rows() > 0) 
        {
            $row = $query->result_array();
            $deactiveuser = $row['0']['deactiveuser'];
        }
        else
        {
            $deactiveuser = 0;
        }

        $finalCount = array('activeuser'=>$activeuser,
                            'deactiveuser'=>$deactiveuser,
                            'All'=>$activeuser+$deactiveuser);


        return $finalCount;
    }

    public function checkRequestExist($spec_id) 
    {
        $this->db->close();
        $this->aws_conn = $this->load->database('aws_db', TRUE); 
        $this->aws_conn->select('*');
        $this->aws_conn->from('approve_request');
        $where = 'spec_id = "'.$spec_id.'"';
        $this->aws_conn->where($where);
        $query = $this->aws_conn->get();

        if($query->num_rows() > 0) 
        {
            return $query->result_array();
            $this->aws_conn->close();
        } 
        else 
        {
            return 0;
            $this->aws_conn->close();
        }
    }

    public function getUserDetails($user_email) 
    {
        $this->db->select('*');
        $this->db->from('users');
        $where = 'email_address = "'.$user_email.'"';
        $this->db->where($where);
        $query = $this->db->get();

        if($query->num_rows() > 0) 
        {
            return $query->result_array();
            $this->aws_conn->close();
        } 
        else 
        {
            return 0;
            $this->aws_conn->close();
        }
    }

    public function updatelockspec($spec_id,$versionid) 
    {
        $this->aws_conn_obj = $this->load->database('aws_db', TRUE);

        $date = date("Y-m-d H:i:s");
        $user_name = $this->session->user_details;
        $fullname = $user_name[0]['first_name']." ".$user_name[0]['last_name'];
        $created_by_session = $user_name[0]['user_id'];
        $data_info = [
            'islocked'   => '1',
            'lockedby'   =>  $created_by_session,
            // 'modification_date' => $date,
        ];
        $this->aws_conn_obj->where('spec_id', $spec_id);
        $this->aws_conn_obj->where('version_id', $versionid);
        $this->aws_conn_obj->update('spec_general', $data_info);
        return 1;
    }

    public function updatelockspecexisting($spec_id,$versionid) 
    {
        $this->aws_conn_obj = $this->load->database('aws_db', TRUE);

        $date = date("Y-m-d H:i:s");
        $user_name = $this->session->user_details;
        $fullname = $user_name[0]['first_name']." ".$user_name[0]['last_name'];
        $created_by_session = $user_name[0]['user_id'];
        $data_info = [
            'islocked'   => '0',
            'lockedby'   =>  $created_by_session,
            'modification_date' => $date,
        ];
        $this->aws_conn_obj->where('spec_id', $spec_id);
        $this->aws_conn_obj->where('version_id', $versionid);
        $this->aws_conn_obj->update('spec_general', $data_info);

        return 1;
    }

    public function checkotherspecinprocess($spec_id,$versionid) 
    {
        $this->aws_conn_obj = $this->load->database('aws_db', TRUE);

        $date = date("Y-m-d H:i:s");
        $user_name = $this->session->user_details;
        $fullname = $user_name[0]['first_name']." ".$user_name[0]['last_name'];
        $created_by_session = $user_name[0]['user_id'];

        $this->aws_conn_obj->select('*');
        $this->aws_conn_obj->from('spec_general');
        $this->aws_conn_obj->where('spec_id !=',$spec_id);
        $this->aws_conn_obj->where('lockedby',$created_by_session);
        $this->aws_conn_obj->where('islocked','1');
        $query = $this->aws_conn_obj->get();
        return $spec_ids_data = $query->result();
    }

    public function checkotherspecinprocesshome($spec_id,$versionid) 
    {
        $this->aws_conn_obj = $this->load->database('aws_db', TRUE);

        $date = date("Y-m-d H:i:s");
        $user_name = $this->session->user_details;
        $fullname = $user_name[0]['first_name']." ".$user_name[0]['last_name'];
        $created_by_session = $user_name[0]['user_id'];
        
        //checked whether other spec is in process for current user
        $this->aws_conn_obj->select('*');
        $this->aws_conn_obj->from('spec_general');
        $this->aws_conn_obj->where('spec_id !=',$spec_id);
        $this->aws_conn_obj->where('lockedby',$created_by_session);
        $this->aws_conn_obj->where('islocked','1');
        $query = $this->aws_conn_obj->get();
        $spec_ids_data = $query->result();

        if(!empty($spec_ids_data))
        {
            return $spec_ids_data;
        }
        else
        {
            $this->aws_conn_obj->select('*');
            $this->aws_conn_obj->from('spec_general');
            $this->aws_conn_obj->where('spec_id',$spec_id);
            $this->aws_conn_obj->where('lockedby !=',$created_by_session);
            $this->aws_conn_obj->where('islocked','1');
            $query1 = $this->aws_conn_obj->get();
            return $spec_ids_data1 = $query1->result();
        }
    }

    public function discardchange($spec_id) 
    {
        $this->aws_conn_obj = $this->load->database('aws_db', TRUE);

        $date = date("Y-m-d H:i:s");
        $user_name = $this->session->user_details;
        $fullname = $user_name[0]['first_name']." ".$user_name[0]['last_name'];
        $created_by_session = $user_name[0]['user_id'];
        $data_info = [
            'islocked'   => '0',
            //'modification_date' => $date,
        ];
        $this->aws_conn_obj->where('spec_id', $spec_id);
        // $this->aws_conn_obj->where('lockedby', $created_by_session);
        $this->aws_conn_obj->where('islocked', '1');
        $this->aws_conn_obj->update('spec_general', $data_info);
        return 1;
    }

    public function getlockedspec() 
    {
        $this->aws_conn_obj = $this->load->database('aws_db', TRUE);

        $this->aws_conn_obj->select('*');
        $this->aws_conn_obj->from('spec_general');
        $this->aws_conn_obj->where('islocked','1');
        $query = $this->aws_conn_obj->get();
        return $spec_ids_data = $query->result();
    }
}