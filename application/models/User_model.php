<?php

class User_model extends CI_Model {

  function __construct() {
    // Call the Model constructor
    parent::__construct();
  }

  function login($username, $password) {
    $password = md5($password);
    $query = $this->db->select("username, fname, lname,phoneno ,id")
                    ->from('users')
                    ->where("username = '$username'")
                    ->where("password = '$password'")->get();
    if ($query->num_rows() == 1) {
      return $query->result();
    } else {
      return false;
    }
  }

  function register($data = array()) {
    $data = array(
        'fname' => $data['fname'],
        'lname' => $data['lname'],
        'username' => $data['username'],
        'password' => $data['password'],
        'dob' => $data['dob'],
        'gender' => $data['gender'],
        'phoneno' => $data['phoneno'],
    );
    $this->db->insert('users', $data);
  }

  function getuser($user, $user_id = false) {
    $this->db->select('u.*')->where('u.user_id', $user->id);
    if ($user_id) {
      $this->db->where('u.id', $user_id);
    }
    return $this->db->get('users u');
  }
  
  function getMyFriends($exclude_user_id = false){
    $this->db->select('u.*');
    if ($exclude_user_id) {
      $this->db->where_not_in('u.id', $exclude_user_id);
    }
    return $this->db->get('users u')->result();
  }
  
  function update($user_id, $data) {
    return $this->db->where('u.id', $user_id)->update('users u', $data);
  }

}