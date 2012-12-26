<?php

class Z_Controller extends CI_Controller {
  public $lables = false;
  public function __construct() {
    parent::__construct();
    if ($this->session->userdata('logged_in')) {
      $this->load->model('Lable_model');
      $this->lables = $this->Lable_model->getLables($this->session->userdata('logged_in'));
    }
  }

  public function renderView($view, &$data) {
    $data['view'] = $view;
    $this->load->view($this->config->config['page_shell'], $data);
  }

}
