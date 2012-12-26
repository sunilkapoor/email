<?php

class Lable extends Z_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('lable_model');
  }

  public function index($lable_id = false) {
    $this->emailfunctions->gatekeeper();
    $this->load->model('Lable_model');
    $this->load->library('form_validation');
    $data['title'] = 'lable';
    $data['heading'] = 'lable';
    if ($this->input->post('save') === 'Save') {
      $this->form_validation->set_rules('name', 'Lable name', 'trim|required|xss_clean');
      if (!$this->form_validation->run()) {
        //null
      } else {
        $lable_data = array(
            'name' => $this->input->post('name'));
        $this->Lable_model->add($this->session->userdata('logged_in'), $lable_data);

        $this->session->set_flashdata('success_message', 'Lable has been inserted.');
      }
      redirect(base_url('lable/index'));
    } elseif ($this->input->post('update') === 'Update') {
      $this->form_validation->set_rules('name', 'Lable name', 'trim|required|xss_clean');
      if (!$this->form_validation->run()) {
        //null
      } else {
        $lable_data = array('name' => $this->input->post('name'));
        $this->Lable_model->update($lable_id, $lable_data);

        $this->session->set_flashdata('success_message', "Lable {$lable_data[name]} has been update.");
      }

      redirect(base_url('lable/index'));
    }
    if ($lable_id) {
      $lable_object = $this->Lable_model->getLables($this->session->userdata('logged_in'), $lable_id);
      $data['lable_name'] = $lable_object[0]->name;
    } else {

      $data['lable_name'] = '';
    }
    $data['lables'] = $this->Lable_model->getLables($this->session->userdata('logged_in'));
    $this->renderView('lable/lables', $data);
  }

  public function setlable() {
    $this->emailfunctions->gatekeeper();
    $this->load->model('lable_model');
    $data['title'] = 'Email title here';
    $data['heading'] = 'This is new heading';
    $data['query'] = $this->lable_model->getlables($this->session->userdata('logged_in'));
    $this->renderView('lable/lables', $data);
  }

  public function delete($id) {

    $this->load->model('lable_model');
    if ($this->lable_model->delete($id, $this->session->userdata('logged_in'))) {
      $this->session->set_flashdata('success_message', 'Record has been deleted.');
    }
    redirect(base_url('lable/index'));
  }

}

?>
