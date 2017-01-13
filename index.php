<!DOCTYPE html>
<?php
session_start();
include("constant.php");
$conn=mysqli_connect(SERVER,USER,PASS,DB)or die("not connect");
if (isset($_POST['xlog'])){
  $user_id=$_POST['xuser'];
  $password=$_POST['xpass'];
  $chkqry="select * from leaderboard where id='$user_id' and password='$password'";
  $res=mysqli_query($conn,$chkqry)or die("not fire check");
  if(mysqli_affected_rows($conn)>=1)
  {
    $row=mysqli_fetch_array($res,MYSQLI_NUM);
    //echo $row[0];
    $_SESSION['name']=$row[0];
    $_SESSION['score']=$row[1];
    $_SESSION['url']=$row[2];
    $_SESSION['login']=true;
    header("location:welcome.php");
  }
  else  
    $xlogm="<font color='red'>INVALID CREDENTIALS</font>";
}

if (isset($_POST['xsign'])){
  $name=$_POST['xname'];
  $handle=$_POST['xhandle'];
  $id=$_POST['xnewid'];
  $password=$_POST['xpass'];

  $sql = 'SELECT * FROM leaderboard where id = "'.$_POST['xnewid'].'"';
  $res = mysqli_query($conn, $sql);

  $idsql='SELECT * FROM leaderboard where url = "'.$_POST['xhandle'].'"';
  $res1=mysqli_query($conn, $idsql);

  if($res && mysqli_num_rows($res)>0){
     $xsign="<font color='red'><b>User ID alerady taken</b></font>";
  } 
  else if($res1 && mysqli_num_rows($res1)>0){
     $xsign="<font color='red'><b>Handle already registered</b></font>";
  } 
  else {
    //echo $name, $handle, $id, $password;
  $chkqry="INSERT into leaderboard VALUES ('$name',0,'$handle','$id', '$password')";
  $res=mysqli_query($conn,$chkqry)or die("not fire check");
  $create="CREATE TABLE ".$handle." (problems VARCHAR(33) NOT NULL, status INT(1) NOT NULL, UNIQUE (problems))";
  mysqli_query($conn, $create);
  $xsign="<font color='green'><b>Account Created Successfully</b></font>";
   }
}

?>

<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Freshathon IIT Jodhpur</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

</head>

<body>

  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Programming Club IIT Jodhpur</a>
    </div>
  </nav>

    <div class="row">

    <div class="col s6">
     
    <?php if(!empty($xlogm)) echo $xlogm; ?><br>
         <form class="col s12" action="" method="post">
            <div class="row">
               
               <div class="input-field col s8">
                  <center><b><h4>Log In</h4></b></center>
                  <input placeholder="Username" id="name" name="xuser"type="text" class="active validate" required>
                  <label for="name"></label>
               </div>
             </div>
             <div class="row">
               <div class="input-field col s8">      
                  <label for="password" ></label>
                  <input id="password" type="password" name="xpass" placeholder="Password" class="validate" required>          
               </div>
             </div>
            <button data-target="modal1" type="submit" value="login" name="xlog" class="btn modal-trigger">SUBMIT</button>
          </form>
      </div>

      <div class="col s6"">
        <br>
        <?php if(!empty($xsign)) echo $xsign; ?><br>
         <form class="col s12" action="" method="post">
          <div class="row">
                <b>New User</b><br>
               <div class="input-field col s8">
                  <center><b><h4>Sign Up</h4></b></center>
                  <input placeholder="Your Name" id="name" name="xname" type="text" class="active validate" required>
               </div>
             </div>

            <div class="row">
               <div class="input-field col s8">
                  <input placeholder="Username" id="name" name="xnewid"type="text" class="active validate" required>
               </div>
             </div>

             <div class="row">
               <div class="input-field col s8">
                  <input placeholder="Spoj Handle" id="name" name="xhandle"type="text" class="active validate" required>
               </div>
             </div>

             <div class="row">
               <div class="input-field col s8">      
                 
                  <input id="password" type="password" name="xpass" placeholder="Password" class="validate" required>          
               </div>
             </div>
            <button data-target="modal1" type="submit" value="login" name="xsign" class="btn modal-trigger">SUBMIT</button>
          </form>
      </div>

</div>

  <footer class="page-footer orange"></footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  
  
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
