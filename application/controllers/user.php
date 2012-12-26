<?php

class User extends Z_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('User_model');
  }

  public function signup() {


    $this->load->library('form_validation');
    if ($this->input->post('signup')) {
      $this->form_validation->set_rules('username', "Username", 'trim|required|xss_clean');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]|md5');
      $this->form_validation->set_rules('cpassword', 'Password Confirmation', 'trim|required');


      if (!$this->form_validation->run()) {
        //null
      } else {
        $user_data = array(
            'fname' => $this->input->post('fname'),
            'lname' => $this->input->post('lname'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'dob' => $this->input->post('dob'),
            'gender' => $this->input->post('gender'),
            'phoneno' => $this->input->post('phoneno'),
        );
        $this->User_model->register($user_data);
      }
    }
    $data['title'] = 'Sitename: signup';
    $data['heading'] = 'signup';
    $this->renderView('user/signup', $data);
  }

  public function login() {
    $data['title'] = 'Sitename: login';
    $data['heading'] = 'login';
    $this->renderView('user/login', $data);
  }

  public function logout() {
    $this->session->unset_userdata('logged_in');
    $this->session->flashdata('success_message', 'You have successfully loggedout.');
    redirect(base_url('user/login'));
  }

  public function edit_my_profile() {
    $this->emailfunctions->gatekeeper();
    $this->load->model('User_model');
    

    $this->load->library('form_validation');
    $data['title'] = 'edit profile';
    $data['heading'] = 'edit profile';
    if ($this->input->post('save') === 'Save') {
     
      $this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');
       $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]|md5');
       $this->form_validation->set_rules('cpassword', 'Password Confirmation', 'trim|required');
      
      if (!$this->form_validation->run()) {
        //null
      } else {
       
         $user_data = array(
             'username' => $this->input->post('username'),
            
            'password' =>md5($this->input->post('password')),
             
             
        );
         

        $this->User_model->update($this->session->userdata('logged_in')->id, $user_data);
      }
    }
    $data['user']=$this->session->userdata('logged_in');
    $this->renderView('user/edit_my_profile', $data);
  }
 public function profile() {
   
    $data['title'] = 'user profile';
    $data['heading'] = 'Profile';
     $data['user']=$this->session->userdata('logged_in');
    $this->renderView('user/profile', $data);
  }
}

?>
