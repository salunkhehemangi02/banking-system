<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <style>
h1{text-align: center;}
</style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="#">Banking System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.html">Home</a>
        </li>
           <li class="nav-item">
          <a class="nav-link" href="about.php">View Customers</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="transfer.php">Transfer Money</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="history.php">Transaction History</a>
        </li>
      </div>
  </div>
</nav>


<div class="container">
<br><br>
<h1><span>T</span>ransfer Money</h1>
<br>
<div style="overflow-x:auto;">
<!-- <div style="background-color: green;"> -->
<table class="table">
        <thead class = 'thead-dark'>
            <tr><!--for row-->
            <th>Sr.No</th>
                <th >Name</th><!--column in bold-->
                <th>Email Id</th>
                <th>Balance</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody><!--body of table-->
			
			<?php
     include 'config.php';
	$selectquery = "SELECT * FROM Customers";
	$query = mysqli_query($conn,$selectquery);
	
	
while( $res = mysqli_fetch_array($query)){
	?>
	
	 <tr>
            <td data-th="id"><?php echo $res['Id']; ?></td>
                <td data-th="Name"><?php echo $res['Name']; ?></td><!--column not in bold-->
                <td data-th="Email"><?php echo $res['Email']; ?></td>
                <td data-th="Balance"><?php echo $res['Balance']; ?></td>
                <td data-th="Balance"><a href="send.php?id=<?php echo $res['Id']; ?>"> <button type="button" class="btn" style="background-color : #555555; color: #ffffff; font-weight: 700;">Transfer</button></a></td>
            </tr>
			
			<?php
	
}
?>         
        </tbody>
       
</table>
</div>
</div>



