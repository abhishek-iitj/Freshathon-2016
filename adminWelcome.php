<?php
session_start();
include ("constant.php");
$connect=mysqli_connect(SERVER, USER, PASS, DB) or die("error in myql_connect");
if ($_SESSION['auth_login']==false)
	header("location:adminLogin.php");
if (isset($_POST['xsub'])){
	$prob=$_POST['xprob'];
  $probid=$_POST['xprobid'];
	$url=$_POST['xurl'];
	$check="SELECT * from problems WHERE problem='$prob'";
	$res=mysqli_query($connect, $check) or die ("Check error");
	if (mysqli_num_rows($res)==0){
		  $qry="INSERT into problems VALUES ('$prob' , '$url' , '$probid' )";
      //echo $qry;
		  $res=mysqli_query($connect, $qry) or die ("Insert Error");
	}
	else{
		$error="Problem Already Submitted, Try Another One";
	}

}
?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Starter Template - Materialize</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

</head>

<body>
	<nav class="light-blue lighten-1" role="navigation">
	    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Programming Club IIT Jodhpur</a>
	    <ul class="right hide-on-med-and-down">
        <li>
        <button data-target="modal1" type="submit" name='xlogout' class="btn modal-trigger"><a href='logout.php'>Logout</a></button>
         
        </li>
	     <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
	    </div>

  	</nav>
  	<center><br>Logged in as <b><?php echo $_SESSION['auth_id']; ?></b></center>
  	<h5>Add Problems Here</h5>
  	<div class="row">
  		<?php if(!empty($error)) echo $error; ?><br>
         <form class="col s12" action="" method="post">
            <div class="row">
               <div class="input-field col s6">
                  <input id="name" placeholder="Problem Name" name="xprob" type="text" required>
               </div>
             </div>
             <div class="row">
               <div class="input-field col s6">
                  <input id="name" placeholder="Problem ID" name="xprobid" type="text" required>
               </div>
             </div>
             <div class="row">
               <div class="input-field col s6">      
                  
                  <input id="password" placeholder="Problem URL" type="text" name="xurl" required>          
               </div>
             </div>
            <button data-target="modal1" type="submit" value="SUBMIT" name="xsub" class="btn modal-trigger">SUBMIT</button>
          </form>
</div>


  	</div>
 </body>

 </html>
