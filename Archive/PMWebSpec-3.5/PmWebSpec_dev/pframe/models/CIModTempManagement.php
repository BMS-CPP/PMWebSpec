<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CIModTempManagement extends CI_Model {

    public $spec_id;
    public $aws_conn;

    public function __construct() {
        parent::__construct();
        $this->load->helper("security");
    } 
    public function saveVariableData ($table,$data) { 
        $dataInsert = [
                'varorder' => Null,
                'var_name' => $this->db->escape_str($data['var_name']),
                'var_label' => $this->db->escape_str($data['var_label']),
                'units' => $this->db->escape_str($data['units']),
                'type' => $this->db->escape_str($data['type']),
                'round' => $this->db->escape_str($data['round']),
                'missVal' => $this->db->escape_str($data['missVal']),
                'note' => $this->db->escape_str($data['note']),
                'source' => $this->db->escape_str($data['source']),
                'SpecType' => $this->db->escape_str($data['SpecType']),

                'requiredFlag' => $data['requiredFlag'],
                'nameChange' => $data['nameChange'],
                'labelChange' => $data['labelChange'],
                'unitChange' => $data['unitChange'],
                'typeChange' => $data['typeChange'],
                'roundChange' => $data['roundChange'],
                'missValChange' => $data['missValChange'],
                'noteChange' => $data['noteChange'],
                'sourceChange' => $data['sourceChange'],
               
        ];
        //print_r($dataInsert);exit;
        $this->db->insert($table,$dataInsert);   
        return 1;
    }
    public function getListother($table,$temp_type) {
        $this->db->select("var_name");
        $this->db->from($table);
        $where = 'SpecType = "'.$temp_type.'" or SpecType = "ER-optional"';
        $this->db->where($where);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            foreach( $query->result_array() as $row ) {
                $variables[] = $row;
            }
        } else {
               $variables = Null; 
            }
        return $variables;
    }

	public function getList($table,$temp_type) {
		$this->db->select("var_name");
		$this->db->from($table);
		//$where = 'SpecType = $temp_type;
		$this->db->where('SpecType', $temp_type);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			foreach( $query->result_array() as $row ) {
				$variables[] = $row;
			}
		} else {
			$variables = Null;
		}
		return $variables;
	}

	public function getUpdateVarList($table, $temptomodify2, $vartoupdate ) {
        $this->db->select("*");
        $this->db->from($table);
        $where_array = array('SpecType' => $temptomodify2, 'var_name' => $vartoupdate); 
        $this->db->where($where_array);
        $query = $this->db->get();
        $res=[];
        if($query->num_rows() > 0) {
           $res= $query->row();
        }
        return $res;
       
    }

    public function updateVariableData($table, $data) {
        $dataInsert = [
            'varorder' => Null,
            'var_name' => $this->db->escape_str($data['var_name']),
            'var_label' => $this->db->escape_str($data['var_label']),
            'units' => $this->db->escape_str($data['units']),
            'type' => $this->db->escape_str($data['type']),
            'round' => $this->db->escape_str($data['round']),
            'missVal' => $this->db->escape_str($data['missVal']),
            'note' => $this->db->escape_str($data['note']),
            'source' => $this->db->escape_str($data['source']),
            'SpecType' => $this->db->escape_str($data['SpecType']),

            'requiredFlag' => $data['requiredFlag'],
            'nameChange' => $data['nameChange'],
            'labelChange' => $data['labelChange'],
            'unitChange' => $data['unitChange'],
            'typeChange' => $data['typeChange'],
            'roundChange' => $data['roundChange'],
            'missValChange' => $data['missValChange'],
            'noteChange' => $data['noteChange'],
            'sourceChange' => $data['sourceChange'],        
        ];

        $condition = array('var_name' => $dataInsert['var_name'], 'SpecType' => $dataInsert['SpecType']);
        
        $this->db->where($condition);
        $this->db->update($table,$data);

    }

     public function saveFlagData ($table,$data) { 
        $dataInsert = [
                 'FlagNum' => $this->db->escape_str($data['FlagNum']),
                 'FlagCom' => $this->db->escape_str($data['FlagCom']),
                 'FlagNotes' => $this->db->escape_str($data['FlagNotes']),
                 'required' => $data['required'],
                 'SpecType' =>$data['SpecType'],               
        ];
        //print_r($dataInsert);exit;
        $this->db->insert($table,$dataInsert);   
        return 1;
    }

     public function getUpdateFlagList($table, $temptomodify2, $vartoupdate ) {
        $this->db->select("*");
        $this->db->from($table);
        $where_array = array('SpecType' => $temptomodify2, 'FlagNum' => $vartoupdate); 
        $this->db->where($where_array);
        $query = $this->db->get();
        $res=[];
        if($query->num_rows() > 0) {
           $res= $query->row();
        }
        return $res;
       
    }

    public function updateFlagData($table, $data) {
        $dataInsert = [
                 'FlagNum' => $this->db->escape_str($data['FlagNum']),
                 'FlagCom' => $this->db->escape_str($data['FlagCom']),
                 'FlagNotes' => $this->db->escape_str($data['FlagNotes']),
                 'required' => $data['required'],
                 'SpecType' =>$data['SpecType'],               
        ];
         $condition = array('FlagNum' => $dataInsert['FlagNum'], 'SpecType' => $dataInsert['SpecType']);
        
        $this->db->where($condition);
        $this->db->update($table,$data);
    }
}

?>
