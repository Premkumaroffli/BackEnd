<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 3600");

// ... rest of your PHP code

class App_users_model extends CI_Model {
    
    protected $table = 'app_users';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function validate_user($username, $password) {
        $this->db->where('email', $username);
        $this->db->where('password', $password); // Hash the password before comparing
        $query = $this->db->get($this->table);

        if ($query->num_rows() == 1) {
            return $query->row();
        } 
        else {
            return $query;
        }
    }

    public function saveUser($email) {
        $table = 'emails';
        $email = array(
            'email' => $email
        );
        $this->db->insert($table, $email);
    }
}
