<html>
<head>
<title>Credit Card Processing Form</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
</head>
<body>
<?php
$serverName = "LEWITZKE"; //serverName\instanceName
$username = "root";
$password = "dbconnect";
$db = "intelligentdatasystems";
$conn = mysqli_connect($serverName, $username, $password, $db);
?>
<?php include('header.php'); ?>
<fieldset>
<?php

//Execute query
mysqli_query($conn,"INSERT INTO Customers (First_Name,Last_Name,Addr_1,Addr_2,City,State,Zip_Code,Phone) VALUES ('".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['addr1']."','".$_POST['addr2']."','".$_POST['city']."','".$_POST['state']."','".$_POST['zip']."','".$_POST['phone']."');");
$custID = mysqli_insert_id($conn);
mysqli_query($conn,"INSERT INTO Purchases (Cust_ID,CC_Num,CC_Type,CC_Name,Exp_Mo,Exp_Yr,CCV,Amt,Approval) VALUES ('".$custID."','".$_POST['ccnum']."','".$_POST['cctype']."','".$_POST['ccname']."','".$_POST['expmo']."','".$_POST['expyr']."','".$_POST['code']."','".$_POST['amount']."','".$_POST['approval']."');");
//Get order ID from table and display confirmation page
?>
<div class="isa_info">
<b>Thank you.</b> Your order has been processed and you will receive an email confirmation shortly.
</div>
<h2>Hi, <?php echo($_POST['firstname']); ?>!</h2>Your order # is: <b><?php echo(mysqli_insert_id($conn)); ?></b><br />
Here are the details of your order:
<br /><br />
Order Date: <?php echo(date("m/d/Y")); ?>
<br /><br />
<u>Billing Name & Address:</u><br />
<?php echo($_POST['ccname']); ?><br />
<?php echo($_POST['addr1'].' '.$_POST['addr2']); ?><br />
<?php echo($_POST['city'].', '.$_POST['state'].' '.$_POST['zip']); ?>
<br /><br />
Order Total: $<?php echo($_POST['amount']); ?>
<br /><br />
Your order was charged to <?php
if($_POST['cctype']=='AX'){echo('American Express');}
if($_POST['cctype']=='DS'){echo('Discover');}
if($_POST['cctype']=='MC'){echo('MasterCard');}
if($_POST['cctype']=='VS'){echo('VISA');}
?> ending <?php echo(substr($_POST['ccnum'],-4,4)); ?>
</fieldset>
</body>
</html>