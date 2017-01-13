<?php
session_start();
include("constant.php");
$conn=mysqli_connect(SERVER,USER,PASS,DB)or die("not connect");
if (isset($_POST['xlog'])){
	$user_id=$_POST['xuser'];
	$password=$_POST['xpass'];
	$chkqry="select * from admins where user_id='$user_id' and password='$password'";
	$res=mysqli_query($conn,$chkqry)or die("not fire check");
	if(mysqli_affected_rows($conn)>=1)
	{
		$row=mysqli_fetch_array($res,MYSQLI_NUM);
		//echo $row[0];
		$_SESSION['auth_id']=$row[0];
		$_SESSION['auth_login']=true;
		header("location:adminWelcome.php");
	}
	else	
		$xlogm="<font color='red'>INVALID CREDENTIALS</font>";
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
      
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
<div class="row">
		<?php if(!empty($xlogm)) echo $xlogm; ?><br>
         <form class="col s12" action="" method="post">
            <div class="row">
               <div class="input-field col s6">
                  
                  <input placeholder="Username" id="name" name="xuser"type="text" class="active validate" required>
                  <label for="name"></label>
               </div>
             </div>
             <div class="row">
               <div class="input-field col s6">      
                  <label for="password" ></label>
                  <input id="password" type="password" name="xpass" placeholder="Password" class="validate" required>          
               </div>
             </div>
            <button data-target="modal1" type="submit" value="login" name="xlog" class="btn modal-trigger">SUBMIT</button>
          </form>
</div>


</body>
</html>