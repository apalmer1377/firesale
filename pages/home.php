<?php
  session_start();
  $_SESSION['primary_color'] = '#000000';
  $_SESSION['secondary_color'] = '#ffffff';

  if (isset($_SESSION['user_email'])) {
    if (isset($_GET['logout'])) {
      $_SESSION = array();
      if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(),'',time() - 3600);
      }
      session_destroy();
      header('Location: ../markup/tryout.php',true,301);
      exit();
    } 
    
    else {
    require('../php/getcolors.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf 8">
		<link rel="stylesheet" href="../stylesheets/style.php">

		<title> firesale--The College Market </title>
	</head>
	<body>
		<header>
			<table>
				<tr id="nav">
					<td id="leftnav">
						<h1>firesale</h1>
					</td>

					<th class="clicknav" id="booknav"> BOOKS </th>
					<th class="unclicknav" id="apartnav"> APARTMENTS </th>
					<th class="unclicknav" id="servicenav"> SERVICES </th>
					<th class="unclicknav" id="miscnav"> MISCELLANEOUS </th>

					<td id="rightnav">
						<span id="account">MY ACCOUNT</span>
					</td>
				</tr>
			</table>
		</header>
		<?php
		  require('../php/accountbar.php');
		?>
		<div id="searchwrapper" class="wrapper">
			<table id="search">
				<tr>
					<td>
						<form id="shadow">
							<input type="text" class="searcher" name="searchinput" id="searchinput" placeholder=" Search for books" size="30">
							<span> Near: </span>
							<select name="colinput" id="colinput">
							<?php
							$dbconn = new mysqli('localhost','austinpalmer','thereisnone1!','firesale');
							$getc = $dbconn->query('SELECT name,abbreviation FROM colleges ORDER BY name');
							while ($row = $getc->fetch_assoc()) {
							  echo '<option value="' . $row['abbreviation'] . '"';
							  if ($row['abbreviation']==$_SESSION['college']) {
							    echo 'selected="true"';
							  }
							  echo ' >' . $row['name'] . '</option>';
							}
							$dbconn->close();
							?></select>
							<!--<input type="text" name="locinput" placeholder=" Address / City / Zip Code" size="25">-->
							<input type="submit" value="Search" id="homesearch">
						</form>
					</td>
					<th id="refine"> ADVANCED<br> SEARCH </th>
				</tr>
			</table>	
			<div id="test">
				<table id="refinewrapper">
				<tr>
				<th>
				<form id="searchrefine">
				  <table>
				    <tr>
				      <td class="labelwrap">
				        <label for="wauth">Author: </label>
				      </td>
				      <td>
				        <input type="text" name="wauth" id="wauth">
				      </td>
				      <td class="labelwrap">
				        <label for="wpub">Publisher: </label>
				      </td>
				      <td>
				        <input type="text" name="wpub" id="wpub">
				      </td>
				    </tr>
				    <tr class="fdet7">
				    </tr>
				  </table>
				</th>
				</tr>
				</table>
				</form>
			</div>
		</div>
		
		<div id="content">
		<div id="searchcontent">
		</div>
		<table id="fill">
		<tr id="filler"></tr>
		<tr><td id="fillcont">
		</td>
		</tr>
		</table>
		</div>
		
		<script src="../scripts/jquery-1.12.4.js"></script>
		<script src="../scripts/refinesearch.js"></script>
		<script src="../scripts/account.js"></script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTCgnawrKrN2G1zJSAVZ7Nj2OigW1-CrI&libraries=places"></script>
	</body>
<html>

<?php
    }
  } else {
    $continue = false;
    $log = false;
  
    if (isset($_POST['createuser'])) {
      if (!(isset($_POST['confirm']))) {
      
    $confmatch = true;
    $email = trim($_POST['email']);
		$newpass = trim($_POST['newpassword']);
		$confirmpass = trim($_POST['confirmpassword']);
		
	  $next = false;
		$nicetry = true;
    $passfull = true;
		$passlong = true;
		$passmatch = true;
		$correctemail = true;
		$goodcoll = true;
		
    if (!(empty($email) && empty($newpass) && empty($confirmpass))) {
    $continue = true;
    $next = false;
    
    if ($_POST['college'] != 'none') {
      $goodcoll = true;
    } else {
      $goodcoll = false;
    }
    
		if ( sha1($newpass) == sha1($confirmpass) ) {
		  $passmatch = true;
		  if ($newpass!='') {
		    $passfull = true;
		    if (8 <= strlen($newpass) && strlen($newpass) <= 20) {
		      $passlong = true;
		    } else {
		      $passlong = false;
		    }
		  } else {
		    $passfull = false;
		  }
		} else {
			$passmatch = false;
		}
		
	  $emailend = substr($email,-3);
		if ($emailend == 'edu') {
		  $correctemail = true;
	  } else {
	  	$correctemail = false;
		}
		if ($passmatch == true && $correctemail == true && $passfull == true && $passlong == true && $goodcoll == true) {
		  $nicetry = true;
		  
		  $password = sha1($newpass);
		  $college = $_POST['college'];
		  
		  $dbconn = new mysqli('localhost','austinpalmer','thereisnone1!','firesale');
		  
		  $unique = $dbconn->prepare("SELECT email FROM users where email=?");
		  $unique->bind_param("s",$email);
		  $unique->execute();
		  
		  $uniqueresult = $unique->get_result();
		  $uniquerow = $uniqueresult->fetch_assoc();
		  if ($uniquerow['email']=='') {
		    $next = true;
		    $nicetry = true;
		    $_POST['conf'] = substr(sha1(mt_rand()),0,5);
      } else {
        $nicetry = false;
        $next = false;
      }
      $dbconn->close();
    }
    }
    } else {
      if (empty(trim($_POST['confirm']))) {
        $confmatch = true;
        $next = true;
      } else if (trim($_POST['confirm'])==trim($_POST['conf'])) {
          $next = false;
		      $confmatch = true;
		      $pass = sha1(trim($_POST['newpassword']));
		      $_SESSION['user_email'] = trim($_POST['email']);
		      $dbconn = new mysqli('localhost','austinpalmer','thereisnone1!','firesale');
		      
		      $prep = $dbconn->prepare("INSERT INTO users(email,password,college) VALUES (?,?,?)");
		      $prep->bind_param("sss",trim($_POST['email']),$pass,trim($_POST['college']));
		      $prep->execute();
		      $getcol = $dbconn->query("SELECT colleges.primary_color FROM colleges,users WHERE users.email='" . $_SESSION['user_email'] . "' AND users.college=colleges.abbreviation");
		      $resrow = $getcol->fetch_assoc();
		      $dbconn->query("UPDATE users SET primary_color='" . $resrow['primary_color'] . "' WHERE email='" . $_SESSION['user_email'] . "'");
		      $geti = $dbconn->query("SELECT ID from users where email='" . $_SESSION['user_email'] . "'");
		      $r = $geti->fetch_assoc();
		      $_SESSION['id'] = $r['ID'];
		      $dbconn->close();
		      mkdir('../images/client/' . $r['ID'],0777);
		      chmod('../images/client/' . $r['ID'],0777);
		      header('Location: tryout.php',true,301);
		      exit();
		    } else {
          $confmatch = false;
          $next = true;
		    }
		}

		  } else if (isset($_GET['login'])) {
    $next = false;
	  $loginemail = trim($_GET['username']);
	  $password = trim($_GET['password']);
	  
	  if (!(empty($loginemail) && empty($password))) {
	  $log = true;
	  
	  $dbconn = new mysqli('localhost','austinpalmer','thereisnone1!','firesale');
	  
	  $prep = $dbconn->prepare("SELECT email,password,college,ID FROM users WHERE email=?");
	  $prep->bind_param("s",$loginemail);
	  $prep->execute();
	  
	  $result = $prep->get_result();
	  $row = $result->fetch_assoc();
	  
	  if ( sha1($password)==$row['password'] ) {
	    $_SESSION['user_email'] = $loginemail;
	    $_SESSION['id'] = $row['ID'];
	    $dbconn->close();
	    if ($_GET['where'] == 'myaccount' || $_GET['where'] == 'postitem') {
	      header('Location: ../markup/'.$_GET['where'].'.php',true,301);
	      exit;
	    } else {
	      header("Location: ../markup/tryout.php",true,301);
	      exit;
	    }
	    
	  } else {
	    if ($row['email']=='') {
	      $exist = false;
	      $loginsuccess = true;
	    } else {
	      $exist = true;
	      $loginsuccess = false;
	    }
	    $dbconn->close();
	  }
	  
	}
	} else {
		$continue = false;
		$log = false;
	}
	
	
	if ($next == false) {

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../stylesheets/style.php">
		<title>firesale--Welcome!</title>
	</head>
	<body>
		<header id="welcomehead">
			<table>
				<tr>
					<td id="welcome">
						<h1>firesale--the college market</h1>
					</td>
				</tr>
			</table>
		</header>
		<div id="bodywrapper">
			<table>
				<tr>
					<td rowspan="3" id="welcometext"><p>Welcome to firesale, the only sales website dedicated solely to college students!  College life is already so expensive, why make it even more so?   At firesale, you can buy and sell textbooks, sublet apartments, and more, all for free! Yay?</p>
						<p> We are currently only available in a few universities, but actually we aren't available anywhere, so suck it.</p>
					</td>
					<td class="block">
						<div id="signin">
							<h3>Sign In:</h3>
							<form id="sign" method="get" action="<?php echo($_SERVER['PHP_SELF']); ?>">
								<input type="email" name="username" size="30" placeholder=" Email" value="<?php echo $loginemail; ?>" ><br>
								<input type="password" name="password" size="30" placeholder=" Password"><br>
								<?php
							    if ($log==true) {
							      if ($loginsuccess==false) {
							        echo '<span class="must">&nbsp; &nbsp; &nbsp; &nbsp; *Username/Password don\'t match!</span><br>';
							      } else if ($exist == false) {
							        echo '<span class="must">&nbsp; &nbsp; &nbsp; &nbsp; *Username doesn\'t exist!</span><br>';
							      }
							    } else {
							        echo '';
							      }
							   
							  ?>
							  <input type="text" id="whereto" name="where" value="<?php echo $_GET['where'] ?>">
								<input type="submit" name="login" value="Sign In">
							</form>
						</div>
					</td>
				</tr>
				<tr>
					<td class="block">
						<div id="newuser">
							<h3>New to firesale?</h3>
							<form name="new" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
								<select name="college"><option value="none">--- Select a college ---</option>
								  <?php 
								    $dbconn = new mysqli('localhost','austinpalmer','thereisnone1!','firesale');
								    $colquer = 'SELECT name,abbreviation from colleges ORDER BY name';
								    $colres = $dbconn->query($colquer);
								    while ($row = $colres->fetch_assoc()) {
								      echo '<option ';
								      if ($_POST['college']==$row['abbreviation']) {
								        echo 'selected="true"';
								      }
								      echo ' value="' . $row['abbreviation'] . '"> ' . $row['name'] . ' </option>';
								    }
								  ?>
								</select><br>
								<?php
								  if ($continue==true && $goodcoll==false) {
								    echo '<span class="must">&nbsp; &nbsp; &nbsp; &nbsp; *Please select a college.</span><br>';
								  }
								?>
								<input type="email" name="email" size="30" placeholder=" University E-mail Address" value="<?php echo $email; ?>" ><br>
								<?php
								  if( $continue==true ) {
								    if ( $correctemail==false ) {
								      echo '<span class="must">&nbsp; &nbsp; &nbsp; &nbsp; *Must be a .edu e-mail</span><br>';
								    } else if ( $nicetry==false ) {
								      echo '<span class="must">&nbsp; &nbsp; &nbsp; &nbsp; *E-mail aleady taken.</span><br>';
								    } 
								  } else {
								        echo '';
								    }
								  
								?>
								
								<input type="password" name="newpassword" size="30" placeholder=" Password"><br>
								<?php
								  if ($continue==true ) {
								    if ( $passfull == false ) {
								      echo '<span class="must">&nbsp; &nbsp; &nbsp; &nbsp; *Must enter a password!</span><br>';
								    } else if ( $passlong == false) {
								      echo '<span class="must">&nbsp; &nbsp; &nbsp; &nbsp; *Must be 8-20 characters long!</span><br>';
								    }
								  } else {
								    echo '';
								  }
								?>
								<input type="password" name="confirmpassword" size="30" placeholder=" Confirm Password"><br>
								<?php
									if( $continue==true && $passmatch==false ) {
										echo '<span class="must">&nbsp; &nbsp; &nbsp; &nbsp; *Passwords don\'t match!</span><br>';
									} else {
									  echo '';
									}
								?>
								<input type="submit" name="createuser" value="Sign Up">
							</form>	
						</div>
					</td>
				</tr>
				<tr>
					<td class="block" id="lastblock">
						<p>firesale is only avaiable to college students.</p>
						<p>Want to donate? Please give us money, we're so poor.</p>
					</td>
				</tr>

		</div>
	<script src="../scripts/jquery-1.12.4.js"></script>
	</body>
</html>

<?php
  } else {
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../stylesheets/style.php">
		<title>firesale--The College Market</title>
	</head>
	<body>
		<header>
			<table>
				<tr id="nav">
					<td id="leftnav">
						<h1>firesale</h1>
					</td>

					<th class="unclicknav" id="booknav"></th>
					<th class="unclicknav" id="apartnav"></th>
					<th class="unclicknav" id="servicenav"></th>
					<th class="unclicknav" id="miscnav"></th>

					<td id="rightnav">
					</td>
				</tr>
			</table> 
		</header>
		<div id="confirmwrap">
		  <p>A confirmation has been sent to you; please enter <br> the code you receieve below. <?php echo $_POST['conf']; ?></p>
		  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		    <input type="text" name="confirm" id="confirm">
		    <input type="text" name="college" value="<?php echo trim($_POST['college']); ?>" class="confi">
		    <input type="text" name="email" value="<?php echo trim($_POST['email']); ?>" class="confi">
		    <input type="text" name="newpassword" value="<?php echo trim($_POST['newpassword']); ?>" class="confi">
		    <input type="text" name="conf" value="<?php echo $_POST['conf']; ?>" class="confi">
		    <input type="submit" name="createuser" value="Confirm">
		    <?php if ($confmatch == false) {
		      echo '<br><span class="must">*Doesn\'t match confirmation code.</span>';
		      } else {
		      echo '';
		      }
		    ?>
		  </form>
		</div>
	</body>
</html>

<?php
  }
  }
?>
