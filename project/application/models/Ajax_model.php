<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_model extends CI_Model {

    /**
     * @vars
     */
    private $_db;
    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        $this->load->database();	
    }
	
	
	/**
     * get student feedback
     */

    function get_where($table, $where = '',$action) 
    {
        $query = $this->db->get_where($table, $where); 

        if($action == 'array'){
            return $query->result_array();
        }
        elseif($action == 'count'){
            return $query->num_rows();
        }
        
    }
}