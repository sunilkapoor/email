<?php

class EmailFunctions {

  public function is_logged_in() {
     $CI =& get_instance();
    if($CI->session->userdata('logged_in')){
      return true;
    }
    return false;
  }

  public function gatekeeper() {
    $CI =& get_instance();
    if(!$CI->session->userdata('logged_in')){
      $CI->session->set_flashdata('error_message','You are not authorized to access this page.');
      redirect(base_url('/user/login'));
    }
  }

}

