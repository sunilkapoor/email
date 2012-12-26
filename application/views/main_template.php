<html>
  <head>
    <title><?php echo $title ?></title>

    <link rel="stylesheet" href="http://localhost/cdg/css/screen.css" type="text/css" media="screen, projection">
    <link rel="stylesheet" href="http://localhost/cdg/css/print.css" type="text/css" media="print">    
    <!--[if lt IE 8]><link rel="stylesheet" href="http://localhost/cdg/css/ie.css" type="text/css" media="screen, projection"><![endif]-->

    <link rel="stylesheet" href="http://localhost/cdg/css/my.css" type="text/css" media="screen, projection">
  </head>

  <body>
    <div class="container">

      <!--HEADER-->
      <div class="span-24 last"><h1>Logo here</h1></div>

      <div class="span-24 last">
        <ul class="header-nevigation">
          <li><a href="">Home</a></li>
          <li><a href="<?php echo base_url('email/aboutus'); ?>">About us</a></li>
          <li><a href="<?php echo base_url('email/contactus'); ?>">Contact us</a></li>

          <li><a href="<?php echo base_url('email/career'); ?>">Career</a></li>
          <?php if ($this->emailfunctions->is_logged_in()): ?>          
            <li><a href="<?php echo base_url('email/compose'); ?>">Compose</a></li>  
          <?php else: ?>



          <?php endif; ?>

          <?php if ($this->emailfunctions->is_logged_in()): ?>
            <li><a href="<?php echo base_url('user/logout'); ?>">Logout</a></li>
          <?php else: ?> 
            <li><a href="<?php echo base_url('user/login'); ?>">Login</a></li>
          <?php endif; ?>

          <?php if ($this->emailfunctions->is_logged_in()): ?>          
          <?php else: ?> 

            <li><a href="<?php echo base_url('user/signup'); ?>">signup</a></li>
          <?php endif; ?>

        </ul>
      </div>


      <div class="middle">

        <!--left sidebar -->
        <div class="span-19">
          <h3 class="page-heading"> <?php echo $heading ?></h3>
          <hr/>
          <?php
          if ($message = $this->session->flashdata('success_message')) {
            echo "<div class=\"success\">{$message}</div>";
          }
          ?>
          <?php
          if ($message = $this->session->flashdata('error_message')) {
            echo "<div class=\"error\">{$message}</div>";
          }
          ?>
          <?php
          if ($message = $this->session->flashdata('notice_message')) {
            echo "<div class=\"notice\">{$message}</div>";
          }
          ?>
          <?php
          if (validation_errors() != '') {
            echo "<div class=\"error_group\">" . validation_errors() . "</div>";
          }
          ?>
          <?php include(dirname(__FILE__) . '/' . $view . '.php'); ?>
        </div>
        <!--right sidebar-->
        <div class="span-5 last">
          <?php include(dirname(__FILE__) . '/sidebar/right.php'); ?>
        </div>
      </div>
      <!--FOOTER-->
      <div class="span-24 last">
        <ul class="footer-nevigation">
          <li><a href="">Home</a></li>
          <li><a href="<?php echo base_url('email/aboutus'); ?>">About us</a></li>
          <li><a href="<?php echo base_url('email/contactus'); ?>">Contact us</a></li>
          <li><a href="<?php echo base_url('email/career'); ?>">Career</a></li>
          <li><a href="<?php echo base_url('email/compose'); ?>">Compose</a></li>
          <li><a href="<?php echo base_url('user/login'); ?>">Login</a></li>
          <li><a href="<?php echo base_url('user/signup'); ?>">signup</a></li>
        </ul>
      </div>

    </div>
  </body>

</html>


