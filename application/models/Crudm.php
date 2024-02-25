<?php

class Crudm extends CI_Model  {
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    // Insert query
    function db_insert($post_array, $table_name){
    	$insert = $this->db->insert($table_name,$post_array);
    	if($insert){
            return $this->db->insert_id();
    	}
    	return false;
    }

    // check existence
    function is_exists($table,$col,$val,$where=array()){
        $where_condition = array($col => $val);
        if(count($where) > 0){
            $where_condition = array_merge($where_condition,$where);
        }
        $q = $this->db->get_where($table, $where_condition, 1);
		if($q->num_rows() > 0){
            return true;
        }
        return false;
    }

    // fetch rows
    function get_all($table_name,$extra_where=array(),$columns=array(),$order_by='',$limit=0,$offset=0,$group_by=""){
        if(is_array($extra_where)){
            if(count($extra_where) > 0){
            foreach($extra_where as $column => $value){
                if(is_array($value) && count($value) == 2){
                    if($value[0] == "in"){
                        $this->db->where_in($column,$value[1]);    
                    }
                    if($value[0] == "not_in"){
                        $this->db->where_not_in($column,$value[1]);    
                    }
                }else{
                    $this->db->where($column,$value);
                }
            }
            }
        }elseif($extra_where != ""){
            $this->db->where($extra_where);
        }
        
        if(count($columns) > 0){
            $columns = implode(",",$columns);            
            $this->db->select($columns,false);
        }
                        
        if(is_array($order_by) && count($order_by) > 0){    
            foreach($order_by as $orderRow){
                $this->db->order_by($orderRow[0],$orderRow[1]);
            }
        }else{
            if($order_by != ""){
                $this->db->order_by($order_by);    
            }            
        }
        
        if($limit > 0){
            $this->db->limit($limit);
        }
        
        if($group_by != ""){
            $this->db->group_by($group_by);
        }
        
        $q = $this->db->get($table_name);
         
        return $q->result();
    }

    // get rows with start end
    function get_rows($params = array()){

        if($params['table'] == 'task') {
            $this->db->select('*, task.description as taskDesc');
        } else {
            $this->db->select('*');
        }

        $this->db->from($params['table']);
        
        if(array_key_exists("join", $params)){
            foreach($params['join'] as $tableJoin){
                $this->db->join($tableJoin[0],$tableJoin[1],(isset($tableJoin[2]))?$tableJoin[2]:"");
            }            
        }

        if(array_key_exists("conditions", $params)){
            foreach($params['conditions'] as $column => $value){
                if(is_array($value) && count($value) == 2){
                    if($value[0] == "in"){
                        $this->db->where_in($column,$value[1]);    
                    }
                    if($value[0] == "not_in"){
                        $this->db->where_not_in($column,$value[1]);    
                    }
                    if($value[0] == "like"){ // by jk for like
                        $this->db->or_like($column,$value[1]);    
                    }
                }else{
                    $this->db->where($column,$value);
                }
                // $this->db->where($key, $val);
            }
        }
        
        if(!empty($params['searchKeyword'])){
            $this->db->like($params['searchKeyword']);
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            
            if(array_key_exists("join", $params)){
                foreach($params['join'] as $tableJoin){
                    $check_exist = "SELECT * FROM ".$tableJoin[0];
                    if( $result = $this->db->query($check_exist)  &&  isset($result['created_at']) ){
                        $this->db->order_by($tableJoin[0].'.'.'created_at','desc');
                    }
                }            
            } else {
                $this->db->order_by('created_at','desc');
            }

            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            
            $query = $this->db->get();
            
            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
        
        return $result;
    }

    // update column
    function db_update($table_name, $post_array, $where){    	
    	return $this->db->update($table_name,$post_array,$where);
    }

    
    function get_all_join($table_name,$join=array(),$extra_where=array(),$columns=array(),$order_by='',$limit=0,$offset=0,$group_by=""){
        if(count($extra_where) > 0){
            foreach($extra_where as $column => $value){
                if(is_array($value) && count($value) == 2){
                    if($value[0] == "in"){
                        $this->db->where_in($column,$value[1]);    
                    }
                    if($value[0] == "not_in"){
                        $this->db->where_not_in($column,$value[1]);    
                    }
                    if($value[0] == "like"){ // by jk for like
                        $this->db->or_like($column,$value[1]);    
                    }
                }else{
                    $this->db->where($column,$value);
                }
            }
        }        
        if(count($columns) > 0){
            $columns = implode(",",$columns);            
            $this->db->select($columns,false);
        }        
        if(is_array($order_by) && count($order_by) > 0){
            foreach($order_by as $orderRow){
                $this->db->order_by($orderRow[0],$orderRow[1]);
            }
        }else{
            if($order_by != ""){
                $this->db->order_by($order_by);    
            }
        }
        
        if(count($join) > 0){
            foreach($join as $tableJoin){
                $this->db->join($tableJoin[0],$tableJoin[1],(isset($tableJoin[2]))?$tableJoin[2]:"");
            }            
        }
        
        if($limit > 0){
            $this->db->limit($limit);
        }
        
        if($group_by != ""){
            $this->db->group_by($group_by);
        }
        
        $q = $this->db->get($table_name);
                  
        $result = $q->result();
    	return $result;        
    }

    function get_any_data_query($query)
    {
        $q = $this->db->query($query);
        $result = $q->result();
        //echo $this->db->last_query();
        return $result;
    }
}

?>