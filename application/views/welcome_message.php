<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Welcome to CodeIgniter Pagination System</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
</head>
<body>

<div id="container">
<h1>Welcome to CodeIgniter Pagination System!</h1>

<div id="body">

<table class="table">
	<thead>
		<td>ID</td>
		<td>Name</td>
		<td>Email</td>
		<td>Mobile</td>
		<td>Address</td>
	</thead>
	<?php foreach ($records as $record): ?>
		<tr>
		<td><?php echo $record['id']; ?></td>
		<td><?php echo $record['name']; ?></td>
		<td><?php echo $record['email']; ?></td>
		<td><?php echo $record['mobile']; ?></td>
		<td><?php echo $record['address']; ?></td>
		</tr>
	<?php endforeach ?>
</table>

 <?php //echo $this->table->generate($records); ?>
 <?php echo $this->pagination->create_links(); ?>
 </div>

<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>