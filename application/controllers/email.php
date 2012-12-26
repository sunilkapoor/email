<?php

class Email extends Z_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Message_model');
  }
  // this is new comment
  public function inbox($label_id = 0, $message_id = 0) {
    $this->emailfunctions->gatekeeper();
    $this->load->model('Message_model');
    if($message_id){
      $this->Message_model->readMessage($message_id);
      $data['body'] = $this->Message_model->pullMessage($message_id);
    }
    $data['title'] = 'Email title here';
    $data['heading'] = 'This is new heading';
    $data['query'] = $this->Message_model->getMessages($this->session->userdata('logged_in'), $label_id);
    
    $this->renderView('email/emails', $data);
  }

  public function index() {
    $data['title'] = 'Home page of the site.';
    $data['heading'] = 'Here we have home page';
    $this->renderView('email/index', $data);
  }

  public function career() {
    $this->load->library('form_validation');
    $this->load->model('Message_model');

    if ($this->input->post('save')) {
      $this->form_validation->set_rules('fname', 'Fname', 'trim|required|xss_clean');
      if (!$this->form_validation->run()) {
        //null
      } else {

        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $message = $fname . "<br />" . $lname;

        $data = array(
            'subject' => "New resume request: {$fname} {$lname}",
            'to_user' => 2,
            'from_user' => 2,
            'message' => $message,
            'time_created' => 'now()',
            'lable_id' => 1,
            'attachment' => $this->input->post('attachment'),
        );

        $this->Message_model->send($data);
      }
    }
    $data['title'] = 'Sitename: career';
    $data['heading'] = 'career';

    $this->renderView('email/career', $data);
  }

  public function aboutus() {
    
  //  echo get_file_contents('http://yahoo.com');
    $data['site_data'] = file_get_contents('http://'.$_GET['site']);
    $data['title'] = 'Sitename: About us';
    $data['heading'] = 'About us';
    $this->renderView('email/aboutus', $data);
  }

  public function contactus() {

    $this->load->library('form_validation');
    $this->load->model('Message_model');
    if ($this->input->post('save')) {
      $this->form_validation->set_rules('fname', 'Fname', 'trim|required|xss_clean');
      if (!$this->form_validation->run()) {
        //null
      } else {

        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $message = $fname . "<br />" . $lname;
        $data = array(
            'subject' => "New resume request: {$fname} {$lname}",
            'to_user' => 2,
            'from_user' => 2,
            'message' => $message,
            'time_created' => 'now',
            'lable_id' => 1,
            'attachment' => $this->input->post('attachment'),
        );

        $this->Message_model->send($data);
      }
    }

    $data['title'] = 'Sitename: contact us ';
    $data['heading'] = 'contact us';

    $this->renderView('email/contactus', $data);
  }

  public function view($id) {
    $this->load->model('Message_model');
    $data['entity'] = $this->Message_model->view($id);
    $data['title'] = 'Sitename: contact us';
    $data['heading'] = $data['entity']->subject;
    $this->renderView('email/view', $data);
  }

  public function delete($id) {

    $this->load->model('Message_model');
    if ($this->Message_model->delete($id, $this->session->userdata('logged_in'))) {

      $this->session->set_flashdata('success_message', 'Record has been deleted.');
    }

    redirect(base_url('email/inbox'));
  }

  public function bulk() {
    $this->load->model('Message_model');
    if ($this->input->post('move') == 'move') {
      $this->Message_model->move($this->input->post('message_ids'), $this->input->post('lable_id'), $this->session->userdata('logged_in'));
      $this->session->set_flashdata('success_message', 'Messages has been moved.');
    } elseif ($this->input->post('delete') == 'delete') {
      $this->Message_model->multi_del($_POST['message_ids'], $this->session->userdata('logged_in'));
      $this->session->set_flashdata('success_message', 'Record has been deleted.');
    }

    redirect(base_url('email/inbox'));
  }

  public function compose() {
    $this->load->library('form_validation');
    $this->load->model('Message_model');
    $this->load->model('User_model');
    if ($this->input->post('send')) {
      $this->form_validation->set_rules('subject', 'subject', 'trim|required|xss_clean');
      if (!$this->form_validation->run()) {
        //null
      } else {
        $data = array(
            'subject' => $this->input->post('subject'),
             'to_user' => $this->input->post('user_id'),
            'from_user' => $this->session->userdata('logged_in')->id,
            'message' => $this->input->post('message')
        );
        if(isset($_FILES['file_upload'])){
          $destination = dirname(dirname(dirname(__FILE__))).'/uploads/'.$this->session->userdata('logged_in')->id;
          @mkdir($destination);
          $destination = $destination.'/'.$_FILES['file_upload']['name'];
          if(move_uploaded_file($_FILES['file_upload']['tmp_name'], $destination)){
            
          $data['attachment'] = $_FILES['file_upload']['name'];
          }
          
        }
        $this->Message_model->send($data);
      }
    }
    $data['title'] = 'Sitename: compose';
    $data['heading'] = 'compose';
    $data['users'] = $this->User_model->getMyFriends($this->session->userdata('logged_in')->id);

    $this->renderView('email/compose', $data);
  }

}

?>
