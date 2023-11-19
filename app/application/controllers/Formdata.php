<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 3600");

// ... rest of your PHP code

class Formdata extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('App_users_model', 'app_user');
        $this->load->model('Public_issues_model', 'public_issues');
    }

    public function uploadFile() {
        echo json_encode(json_decode(file_get_contents('php://input'), true));
        $config['upload_path'] = './uploads/'; // Specify your upload folder
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1000;
        
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
            $this->output->set_output(json_encode(['status' => 'error', 'message' => $error]));
        } else {
            $data = array('upload_data' => $this->upload->data());

            // Handle the file data as needed, e.g., save the file path to the database
            $file_path = $data['upload_data']['full_path'];
            $this->saveFilePathToDatabase($file_path);

            $this->output->set_output(json_encode(['status' => 'success', 'message' => 'File uploaded successfully']));
        }
    }

    public function issuedetails()
    {
        echo json_encode(json_decode(file_get_contents('php://input'), true));

        $config['upload_path'] = '../uploads/images'; // Set your upload directory
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1000;
        $upload = $this->load->library('upload', $config);
     
        if ($this->upload->do_upload('profileImage')) {
            $data = $this->upload->data();
            
            // Save the file details to your database along with other form data
            // Example: $this->your_model->saveUser($data, $otherFormData);
            // ...
            echo json_encode(['status' => 'success']);
        } else {
            $error = $this->upload->display_errors();
            echo json_encode(['status' => 'error', 'message' => $error]);
        }
        
    }
}
