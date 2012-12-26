<form action="" method="POST">
  Lable name:<input type="text" name="name" value="<?php echo $lable_name ?>"/>
  <input type="submit" name="<?php echo isset($this->uri->segments[3])?'update':'save'  ?>" value="<?php echo isset($this->uri->segments[3])?'Update':'Save'  ?>"/>
</form>

<table>
  <?php
  foreach ($lables as $lable) {
    echo"<tr><td>{$lable->id}</td><td> {$lable->name}</td><td><a href=\"http://localhost/cdg/lable/delete/{$lable->id}\">delete</a></td><td><a href=\"http://localhost/cdg/lable/index/{$lable->id}\">update</td></tr>";
  }
  ?>
</table>