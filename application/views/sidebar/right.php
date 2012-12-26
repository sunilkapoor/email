
<?php if ($this->emailfunctions->is_logged_in()): ?>
  <fieldset>
    <legend>Welcome, <?php echo $this->session->userdata('logged_in')->username ?></legend>
    <ul>
      <li><a href="<?php echo base_url('email/inbox'); ?>">Inbox</a></li>
      <li><a href="<?php echo base_url('user/profile'); ?>">Profile</a></li>
      <li><a href="<?php echo base_url('user/edit_my_profile'); ?>">Edit profile</a></li>
      <li><a href="<?php echo base_url('lable'); ?>">Manage Lables</a></li>
    </ul>
  </fieldset>
 <fieldset>

    <legend>Lables</legend>
    <ul>
      <?php
      foreach ($this->lables as $lable) {
        echo '<li><a href="' . base_url('email/inbox/'.$lable->id). '">' . $lable->name . '</a></li>';
      }
      ?>
    </ul>
  </fieldset>
<?php else: ?>
<?php endif; ?>


