<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 3600");

// CREATE TABLE `myDB`.`app_users` (`id` INT NOT NULL AUTO_INCREMENT , 
// `username` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

class App_users_model extends CI_Model {
    
    protected $table = 'app_users';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function validate_user($email, $password) {
        $this->db->select('user_type');
        $this->db->where('email', $email);
        $this->db->where('password', $password); // Hash the password before comparing
        $query = $this->db->get('app_users');

        if ($query->num_rows() == 1) {
            return $query->result();
        } 
        else {
            return false;
        }
    }
   
    public function save_user($data) {
        $this->db->insert('app_users', $data);
        return true;
    }

}
