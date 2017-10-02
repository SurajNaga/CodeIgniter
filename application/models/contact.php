<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class contact extends CI_Model{
    function __construct() {
        $this->contactTbl = 'contact';
    }
    /*
     * get rows from the users table
     */
    // function getRows($params = array()){
    //     $this->db->select('*');
    //     $this->db->from($this->contactTbl);
        
    //     //fetch data by conditions
    //     if(array_key_exists("conditions",$params)){
    //         foreach ($params['conditions'] as $key => $value) {
    //             $this->db->where($key,$value);
    //         }
    //     }
        
    //     //set start and limit
    //     if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
    //         $this->db->limit($params['limit'],$params['start']);
    //     } elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
    //         $this->db->limit($params['limit']);
    //     }

    //     $query = $this->db->get();

    //     // if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
    //     //     $result = $query->num_rows();
    //     // } else {
    //     //     $result = $query->result_array();
    //     // }

    //     $result = $query->result_array();

    //     //return fetched data
    //     return $result;
    // }
    
    /*
     * Insert contact information
     */
    public function insert($data = array()) {
        //add created data if not included
        if(!array_key_exists("cnt_created_on", $data)){
            $data['cnt_created_on'] = date("Y-m-d H:i:s");
        }
        
        //insert contact data to contact table
        $insert = $this->db->insert($this->contactTbl, $data);
        
        //return the status
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    function getRows($start,$offset){

        //die($start."llllllll".$offset);
        $this->db->select('*');
        $this->db->from($this->contactTbl);

        $this->db->limit($start,$offset);

        if(!empty($arr_search)) {

        }
        

        $query = $this->db->get();

        if($result = $query->num_rows() >0){
            return $query->result_array();
        } else {
            return false;
        }
    }

    function getTotalRows(){

        $this->db->select('*');
        $this->db->from($this->contactTbl);

        if(!empty($arr_search)) {

        }
        

        $query = $this->db->get();

        return $query->num_rows();
    }

}