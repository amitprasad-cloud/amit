<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_model extends CI_Model {

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
	

    function insert($table,$data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();

    }
    
	function get_all($table) 
    {
         $query = $this->db->get($table);
         return $query->result();
    }    

    function get_where($table, $where = '') 
    {
        $query = $this->db->get_where($table, $where);
        return $query->result_array();
    }
}
