<?php

class Lable_model extends CI_Model {

  function __construct() {
    // Call the Model constructor
    parent::__construct();
  }

  function add($user, $data = array()) {
    $data = array(
        'name' => $data['name'],
        'user_id' => $user->id
    );
    $this->db->insert('lables', $data);
  }

  function getLables($user, $lable_id = false) {
    $this->db->select('l.*')->where('l.user_id', $user->id);
    if ($lable_id) {
      $this->db->where('l.id', $lable_id);
    }
    return $this->db->get('lables l')->result();
  }

  function delete($id, $user) {
    return $this->db->delete('lables', array('id' => $id, 'user_id' => $user->id));
  }
  
  function update($lable_id, $data){
    return $this->db->where('l.id', $lable_id)->update('lables l',$data);
  }

}