<?php

class Message_model extends CI_Model {

  function __construct() {
    // Call the Model constructor
    parent::__construct();
  }

  function get_last_ten_entries() {
    $query = $this->db->get('messages', 10);
    return $query->result();
  }

  function view($id) {
    $this->db->select();
    $this->db->where('id', $id);
    return current($this->db->get('messages')->result());
  }

  function delete($id, $user) {
    return $this->db->delete('messages', array('id' => $id, 'to_user' => $user->id));
  }

  function getMessages($user, $lable_id = 0) {
    return $this->db->select('m.*, u.fname, u.lname')
                    ->join('users u', 'u.id = m.from_user')
                    ->where('m.to_user', $user->id)
                    ->where('m.lable_id', $lable_id)
                    ->get('messages m');
  }
  
  function pullMessage($message_id = false){
     $return = $this->db->select('m.*')
                    ->where('m.id', $message_id)
                    ->get('messages m')->result();
     return $return[0];
  }
  
  function readMessage($message_id){
    return $this->db->where('id', $message_id)->update('messages', array('is_read' => 1));
  }

  function multi_del($id) {
    $this->db->where_in('id', $id)->delete('messages');
    return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
  }

  function move($message_ids, $lable_id, $user) {
    $this->db->where_in('id', (array) $message_ids)
            ->where('to_user', $user->id)
            ->update('messages', array('lable_id' => $lable_id));
    return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
  }

  function send($params = array()) {
    $data = array(
        'subject' => $params['subject'],
        'to_user' => $params['to_user'],
        'from_user' => $params['from_user'],
        'message' => $params['message'],
        'time_created' => 'NOW()'
    );
    if(isset($params['attachment'])){
      $data['attachment'] = $params['attachment'];
    }
    $this->db->insert('messages', $data);
  }

  
}

