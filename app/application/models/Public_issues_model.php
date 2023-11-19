<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 3600");

// ... rest of your PHP code

class Public_issues_model extends CI_Model {
    
    protected $table = 'public_issues';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function validate_user($email, $password) {
        $this->db->where('email', $email);
        $this->db->where('password', $password); // Hash the password before comparing
        $query = $this->db->get('app_users');

        if ($query->num_rows() == 1) {
            return true;
        } 
        else {
            return false;
        }
    }
   
    public function saveformData($data) {
        $this->db->insert('public_issues', $data);
        return $this->db->insert_id();
    }

}
