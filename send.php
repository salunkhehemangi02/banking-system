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
<?php
  include 'config.php';

if (isset($_POST['submit'])) {
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $showquery = "SELECT * from Customers where Id=$from";
    $query = mysqli_query($conn, $showquery);
    $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

    $showquery = "SELECT * from Customers where Id=$to";
    $query = mysqli_query($conn, $showquery);
    $sql2 = mysqli_fetch_array($query);



    // constraint to check input of negative value by user
    if (($amount) < 0) {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
        echo '</script>';
    }



    // constraint to check insufficient balance.
    else if ($amount > $sql1['Balance']) {

        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }



    // constraint to check zero values

    else if ($amount == 0) {

        echo "<script type='text/javascript'>";
        echo "alert('Oops! Zero value cannot be transferred')";
        echo "</script>";
    } else {

        // deducting amount from sender's account
        $newbalance = $sql1['Balance'] - $amount;
        $showquery = "UPDATE Customers set Balance=$newbalance where id=$from";
        mysqli_query($conn, $showquery);


        // adding amount to reciever's account
        $newbalance = $sql2['Balance'] + $amount;
        $showquery = "UPDATE Customers set Balance=$newbalance where id=$to";
        mysqli_query($conn, $showquery);

        $sender = $sql1['Name'];
        $receiver = $sql2['Name'];
        $showquery = "INSERT INTO Transaction(`sender`, `receiver`, `Balance`) VALUES ('$sender','$receiver','$amount')";
        $query = mysqli_query($conn, $showquery);

        if(!$query){
                   echo "Error : " . $showquery  . "<br>" . mysqli_error($conn);
        
        }

        if ($query) {
            
            echo "<script> alert('Transaction Successful');
                                     window.location='history.php';
                           </script>";
        }

        $newbalance = 0;
        $amount = 0;
    }
}
?>


<style>
  select {
  -webkit-appearance: none;
  -moz-appearance: none;
  -ms-appearance: none;
  appearance: none;
  outline: 0;
  box-shadow: none;
    border-radius: .3em;
   border: 1px solid gray;
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
 
  background-image: none;
}
/* Remove IE arrow */
select::-ms-expand {
  display: none;
}
/* Custom Select */
.select {
  position: relative;
  display: flex;
  width: 18em;
  height: 2.8em;
  line-height: 3;
  background: ;
  overflow: hidden;
  border-radius: .25em;
}
select {
  flex: 1;
  padding: 0 .4em;
  color: #000
  cursor: pointer;
}
/* Arrow */
.select::after {
  content: '\25BC';
  position: absolute;
  top: 0;
  right: 0;
  padding: 0 1em;
  background: ;
  cursor: pointer;
  pointer-events: none;
  -webkit-transition: .25s all ease;
  -o-transition: .25s all ease;
  transition: .25s all ease;
}
/* Transition */
.select:hover::after {
  color: black;
}
</style>



<section class="contact-section">
<br><br>
<h1><span>T</span>ransaction</h1>
<br>
<div style="overflow-x:auto;">
<table class="table">
        <thead class = 'thead-dark'>
            <tr><!--for row-->
            <th>Sr.No</th>
                <th>Name</th><!--column in bold-->
                <th>Email Id</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody><!--body of table-->
    <?php
      include 'config.php';
    $ids = $_GET['id'];
  $showquery = "SELECT * FROM Customers where Id={$ids}";
  $showdata = mysqli_query($conn,$showquery);
  if(!$showdata){
    echo "Error : " . $showquery  . "<br>" . mysqli_error($conn);
        
  }
  
    $res = mysqli_fetch_assoc($showdata);
  ?>
      
  
   <tr>
            <td data-th="id"><?php echo $res['Id'] ?></td>
                <td data-th="Name" value=""><?php echo $res['Name']; ?></td><!--column not in bold-->
                <td data-th="Email"><?php echo $res['Email'] ?></td>
                <td data-th="Balance"><?php echo $res['Balance'] ?></td>
            </tr>
      <?php
  

?>        
        </tbody>
       
</table>
</div>
  <br>
  <br>
  
     <div class="container">
            <div class="contact">
                

                <form action="" method="post" >
                    <label for="name">AMOUNT</label><br>
                    <input type="number" placeholder="Enter Amount" id="name" name="amount" required><br>
                    <br>
                    <label for="message">TRANSFER TO</label>
                   <div class="select">
  <select name="to" id="slct" required>
 
    <option value="" disabled selected>Choose</option>
    
         <?php
              include 'config.php'; 
   $ids = $_GET['id'];
                $showquery = "SELECT * FROM Customers where id!=$ids";
                $showdata = mysqli_query($conn, $showquery);
                if (!$showdata) {
                    echo "Error " . $showquery . "<br>" . mysqli_error($conn);
                }

while($res = mysqli_fetch_assoc($showdata)){
  ?>
                    <option  value=" <?php echo $res['Id']; ?>">

                        <?php echo $res['Name']; ?> (Balance:
                        <?php echo $res['Balance']; ?> )

                    </option>
                <?php
                }
                ?>
  </select>
</div><br>
                    <input type="submit" name="submit" class="send-message-cta" value="TRANSFER">
                </form>
            </div>
           
      

</div>
</section>