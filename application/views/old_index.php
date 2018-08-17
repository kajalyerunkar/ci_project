<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css';?>">
  <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.min.js';?>">
  </script>

</head>
<body>
	<div class="container">
		<a href="<?php echo base_url('index.php/crud/show')?>">show data</a>
		<form method="post" action="<?php echo base_url('index.php/crud/action_page')?>">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter email" name="uemail">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="upass">
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="remember"> Remember me</label>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
  	<?php echo validation_errors();?>

	</div>

  <div class="container">
    <?php
      echo form_open('crud/action_page1', array("id" =>"formData"));
      echo form_input('uemail', '');
      echo form_input('upass', '');
      echo form_button('','submit post!',array("class"=>"btn btn_add"));

      echo form_close();
    ?>

  </div>
  <div class="err"></div>
  <script type="text/javascript">

    $(function(){
      $(".btn_add").click(function(){
        //alert(1);

        rec = $("#formData").serialize()
        //alert(rec);

        $.ajax({
          type : "post",
          data :rec,
          url: "http://localhost/kajal_ci/index.php/crud/action_page1",
          success:function(res){

            //alert(res)
            $(".err").html(res)
          }
        })
      })
    })
    
  </script>

</body>
</html>