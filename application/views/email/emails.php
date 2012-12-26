<script language="javascript">
  function select_all(clickedObject, oform){
    if(clickedObject.checked){
      for(i=1; i<=50; i++){
        if(oform[i].type=='checkbox'){
          oform[i].checked = true;
        }
      }
    }else{
      for(i=1; i<=50; i++){
        if(oform[i].type=='checkbox'){
          oform[i].checked = false;
        }
      }
    }
  }
</script>

<form action="<?php echo base_url("email/bulk") ?>" method="post">
  <ul class="footer-nevigation">
    <li><b>Lables:</b>
      <select name="lable_id"> 
        <option value="0">Inbox</option>
        <?php
        foreach ($this->lables as $lable) {
          echo '<option value="' . $lable->id . '">' . $lable->name . '</option>';
        }
        ?>
      </select>
    </li>
    <li><input type="submit" value="move" name="move"/></li>
    <li><input type="submit" value="delete" name="delete"/></li>
  </ul>


  <table width="100%">

    <tr class="header-row">
      <td width="32"><input type="checkbox" value="1" name="selectall" onChange="javascript: select_all(this, this.form);" /></td>
      <td width="32">&nbsp;</td>
      <td>Subject</td>
      <td>From</td>
      <td>Action</td>
    </tr>

    <?php
    if (isset($this->uri->segments[3]) && is_numeric($this->uri->segments[3])) {
      $current_lable = $this->uri->segments[3];
    } else {
      $current_lable = 0;
    }
    foreach ($query->result() as $row):
      ?>
      <tr> 
        <td><input name="message_ids[]" type="checkbox" value="<?php echo $row->id; ?>" /></td>
        <td>
          <?php if (!empty($row->attachment)): ?>
            <a target="_blank" href="<?php echo base_url("uploads/{$row->from_user}/{$row->attachment}"); ?>"><img src="<?php echo base_url('images/attach.png') ?>" /></a>
          <?php elseif ($row->is_read): ?>
            <img src="<?php echo base_url('images/tick.png') ?>" />
          <?php else: ?>
            <img src="<?php echo base_url('images/email.png') ?>" />
  <?php endif; ?>
        </td>
        <td><a href="<?php echo base_url("email/inbox/{$current_lable}/" . $row->id); ?>" title="Click here to see this message"><?php echo $row->subject; ?></a></td>
        <td><?php echo "$row->fname $row->lname"; ?></td>
        <td><a href="<?php echo base_url("email/delete/{$row->id}") ?>">delete</a></td>
      </tr>
<?php endforeach; ?>
  </table>
</form>
<div>
  <?php
  if (isset($body) && $body) {
    print_r($body->message);
  }
  ?>
</div>