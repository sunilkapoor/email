<?php

class VerifyLogin extends Z_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('User_model');
  }

  function index() {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('username', "Username", 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', "Password", 'trim|required|xss_clean|callback_check_database');
    if (!$this->form_validation->run()) {
      $data['title'] = 'Sitename: login';
      $data['heading'] = 'login';
      $this->renderView('user/login', $data);
    } else {
      redirect(base_url('email/inbox'));
    }
  }

  function check_database($password) {
    //Field validation succeeded.  Validate against database
    $username = $this->input->post('username');
    //query the database
    $result = $this->User_model->login($username, $password);
    if ($result) {
      $this->session->sess_create();
      $this->session->set_userdata('logged_in', $result[0]);
      return TRUE;
    } else {
      $this->form_validation->set_message('check_database', 'Invalid username or password');
      return false;
    }
  }

}

?>