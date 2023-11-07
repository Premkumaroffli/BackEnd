<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 3600");

// ... rest of your PHP code

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('App_users_model', 'app_user');
    }
    
    public function login() {
        //Handle login logic here
        $data = json_decode(file_get_contents('php://input'), true);
        $username = $data['username'];
        $password = $data['password'];
        $user = $this->app_user->validate_user($username, $password);

        if ($user) {
            $response['status'] = 'success';
            $response['message'] = 'Login successful';
            $response['user'] = $user;
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'Invalid username or password';
        }

        echo json_encode($response);
    }

    public function emailsave() {
        //Handle login logic here
        $data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'];
        $user = $this->app_user->saveUser($email);

        $response['status'] = 'saved';
        $response['message'] = 'email registered';
        $response['user'] = $email;
       

        echo json_encode($response);
    }
	
}
