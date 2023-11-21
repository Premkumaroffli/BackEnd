<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 3600");

// ... rest of your PHP code

class Formdata extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('App_users_model', 'app_user');
        $this->load->model('Public_issues_model', 'public_issues');
        $this->load->helper('url');
    }

    public function issuedetails()
    {
        $name = $this->input->post('name');
        $issues = $this->input->post('issues');
        $selectedOption = $this->input->post('selectedOption');
        $complaint = $this->input->post('complaint');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');

        if (!empty($_FILES['image']['name'])) 
        {
            $config['upload_path'] = '/Applications/XAMPP/xamppfiles/htdocs/Backend/app/application/uploads';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $this->load->library('upload', $config);

            $path_url = 'uploads/';
        
            if($this->upload->do_upload('image')) {
              // File upload success
              $fileData = $this->upload->data();
              // Process file data or save to the database
              $data = array(
                'name' => $this->input->post('name'),
                'issue' => $this->input->post('issues'),
                'complaint' => $this->input->post('complaint'),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
                'image_url' => $path_url . $this->upload->data('file_name')
              );

              $user = $this->public_issues->saveformData($data);

                if($user) 
                {   
                    $response['status'] = 'success';
                    $response['message'] = 'data submitted';
                    $response['user'] = $user;
                }
                else 
                {
                    $response['status'] = 'failed';
                    $response['message'] = 'Invalid data not submitted';
                }
              echo json_encode($response);
            } 
            else{
              // File upload failure
              $error = $this->upload->display_errors();
              echo json_encode(['status' => 'error', 'message' => $error]);
            }
          }
        else 
        {
            echo json_encode(['status' => 'error', 'message' => 'No file uploaded']);
        }
        
    }

    public function getAllData() {
        $query = $this->db->get('public_issues');
        $data = $query->result();
        echo json_encode($data);
    }
    
}
