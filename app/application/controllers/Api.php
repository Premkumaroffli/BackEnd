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
        $formdata = json_decode(file_get_contents('php://input'), true);
        $data = $formdata['formdata'];
        $email = $data['email'];
        $password = $data['password'];
        $user = $this->app_user->validate_user($email, $password);
        

        if($user) {
            $response['status'] = 'success';
            $response['message'] = 'Login successful';
            $response['user'] = $user;
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'Invalid username or password';
        }

        echo json_encode($response);
    }

    // public function generate_token($user_id) {
    //     $this->load->library('jwt');
    //     $payload = array(
    //         'user_id' => $user_id,
    //         'exp' => time() + 3600, 
    //     );
    //     // Generate the token
    //     $token = $this->jwt->encode($payload, '12345');
    //     // Return the token to the client
    //     $this->output->set_content_type('application/json')->set_output(json_encode(array('token' => $token)));
    // }

    public function signup()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $formdata = $data['formdata'];
        echo json_encode($formdata);
        $user_id = $this->app_user->save_user($formdata);

        // Generate JWT token
        // $this->load->library('jwt');
        // $token = $this->generate_token($user_id);

        if($user)
        {
            $response['status'] = 'success';
            $response['message'] = 'Login successful';
            $response['user'] = $user;
        } 
        else
        {
            $response['status'] = 'failed';
            $response['message'] = 'Invalid username or password';
        }
        
    }

    public function issuedetails()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $formdata = $data['formdata'];
        echo json_encode($formdata);
        $user_id = $this->app_user->save_user($formdata);

        // Generate JWT token
        // $this->load->library('jwt');
        // $token = $this->generate_token($user_id);

        if($user)
        {
            $response['status'] = 'success';
            $response['message'] = 'Login successful';
            $response['user'] = $user;
        } 
        else
        {
            $response['status'] = 'failed';
            $response['message'] = 'Invalid username or password';
        }
        
    }
}
