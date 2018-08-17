<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css';?>">

</head>
<body>
	<div class="container">

		<?php

			// echo "<pre>";
			// print_r($xyz);
			// echo "</pre>";


		?>

		<table class="table">
    <thead>
      <tr>
        <th>id</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <?php
      	foreach($xyz as $val):
      ?>
      <tr>
      		<td><?php echo $val['id'];?></td>
      		<td><?php echo $val['uemail'];?></td>
      		<td><?php echo $val['upass'];?></td>
          <td><a href="<?php echo base_url('index.php/crud/deleteData/'.$val['id']);?>">delete</a></td>
          <td><a href="<?php echo base_url('index.php/crud/editData/'.$val['id']);?>">edit</a></td>

      </tr>
      <?php

      		endforeach;
      ?>
    </tbody>
  </table>
	</div>

</body>
</html>