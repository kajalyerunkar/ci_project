<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css';?>">

</head>
<body>
	<div class="container">
		<a href="<?php echo base_url('index.php/crud/show')?>">show data</a>

    <!-- <?php print_r($xyz);?> -->

		<form method="post" action="<?php echo base_url('index.php/crud/action_update')?>">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter email" name="uemail" value="<?php echo $xyz->uemail;?>">
    </div>
    
      <input type="hidden" class="form-control" id="pwd" placeholder="Enter password" name="id" value="<?php echo $xyz->id;?>">
   
    
    <button type="submit" class="btn btn-default">update</button>
  </form>
  	

	</div>

</body>
</html>