
<form action="" method="post">
  <dl>
      <dt><h4>First name:</h4></dt>
      <dd>  <input type="text" name="fname" value="<?php echo $user->fname ?>"/></dd>
      <dt><h4>Last name:</h4></dt>
      <dd> <input type="text" name="lname" value="<?php echo $user->lname ?>" /></dd>
      <dt><h4>Username:</h4></dt>
      <dd> <input type="text" name="username" value="<?php echo $user->username ?>"/></dd>
      <dt><h4>Password:</h4></dt>
      <dd> <input type="password" name="password"/></dd>
      <dt><h4>Confirm Password:</h4></dt>
      <dd> <input type="password" name="cpassword"/></dd>
      <dt><h4>Phone no: </h4></dt>
      <dd> <input type="text" name="phoneno" value="<?php echo $user->phoneno ?>"/></dd>
      <dd> <input type="submit" name="save" value="Save"/></dd>
    </dl>
  </form>
   