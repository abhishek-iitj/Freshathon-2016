<?php
session_start();
include ("constant.php");
$connect=mysqli_connect(SERVER, USER, PASS, DB) or die("error in myql_connect");
if ($_SESSION['login']==false)
	header("location:index.php");

$url="https://www.spoj.com/users/".$_SESSION['url'];

function find($x){
    $chk="SELECT * from ".$_SESSION['url']." where problems='".$x."'";
    $connect=mysqli_connect(SERVER, USER, PASS, DB) or die("error in myql_connect");
    $result=mysqli_query($connect, $chk); //or die("not fire");
    if (mysqli_num_rows($result)==0)
      return false;
    else 
      return true;
}

function update($x){
  $upqry="UPDATE ".$_SESSION['url']." SET status=1 where problems='".$x."'";
  //echo $upqry;
  $connect=mysqli_connect(SERVER, USER, PASS, DB) or die("error in myql_connect");
  $result=mysqli_query($connect, $upqry) or die("update error");
}

function score(){
  $chk="SELECT * from ".$_SESSION['url']." where status=1";
  //echo $chk;
  $connect=mysqli_connect(SERVER, USER, PASS, DB) or die("error in myql_connect");
  $result=mysqli_query($connect, $chk);
  $count=mysqli_num_rows($result);
  $update="UPDATE leaderboard SET score=".$count." where url='".$_SESSION['url']."'";
  //echo $update;
  mysqli_query($connect, $update) or die("not update");
  return $count;
}

?>

<html>
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
	    <ul class="right hide-on-med-and-down">
        <li>
        <button data-target="modal1" type="submit" name='xlogout' class="btn modal-trigger"><a href='logout.php'>Logout</a></button>
         
        </li>
	     <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
	    </div>

  	</nav>
  	<div class="row">
        <div class="col s2" >
        <b><h4>Profile</h4></b>
        <label><b>Name: </label><?php echo $_SESSION['name']; ?><br><br></b>
        <label><b>Score: </label><?php echo score(); ?>&nbsp&nbsp<a href="refresh.php">Refresh</a></b><br><br>
        <b><label>URL: </label><?php echo "<a href='$url';>Click Here</a>"?><br><br></b>

        </div>

        <div class="col s5">
          <h5><b>Your Status</b></h5>
          <table>
          <?php
            $qry="SELECT * from problems";
            $table_res=mysqli_query($connect, $qry) or die("Connection failed: " . mysqli_connect_error());
            while($r=mysqli_fetch_array($table_res))
                if (find($r[2])==true){
                  echo "<tr><td>".$r[2]."</td><td><b><i class='material-icons' style='color:green;'>done</i></B></td></tr></a>";
                  //$_SESSION['score']+=1;
                  update($r[2]);
                }
                 else
                  echo "<tr><td>".$r[2]."</td><td>Not Submitted</td></tr></a>";
            ?>
              </table>
        </div>

        <div class="col s5">
          <h5><b>Problems Published</b></h5>
          <table>
          <?php
            $qry="SELECT * from problems";
            $table_res=mysqli_query($connect, $qry) or die("Connection failed: " . mysqli_connect_error());
            while($r=mysqli_fetch_array($table_res))
                  echo "<tr><td><a href=".$r[1].">".$r[0]."</a></td></tr></a>";
            ?>

              </table>
        </div>

    </div>
  	


  	</div>
 </body>

 </html>
