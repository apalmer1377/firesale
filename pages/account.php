<?php
  session_start();
    
  if (isset($_SESSION['user_email'])) {
    if (isset($_GET['logout'])) {
      $_SESSION = array();
      if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(),'',time() - 3600);
      }
      session_destroy();
      header('Location: tryout.php',true,301);
      exit();
    } else {
      $passmatch=true;
      $dbconn = new mysqli('localhost','austinpalmer','thereisnone1!','firesale');
      if (!(empty(trim(($_POST['newpass']))))) {
        if (trim($_POST['newpass']==trim($_POST['confpass']))) {
          
          $upd = 'UPDATE users set password=? where email=?';
          $stat = $dbconn->prepare($upd);
          $stat->bind_param('ss',sha1(trim($_POST['newpass'])),$_SESSION['user_email']);
          $stat->execute();
          $dbconn->close();
          header('Location: myaccount.php');
        } else {
          $passmatch=false;
        }
      }
      if (!(empty($_POST['newcollege']))) {
        $getcolu = $dbconn->query('SELECT primary_color,abbreviation FROM colleges WHERE abbreviation="' . $_POST['newcollege'] . '"');
        $ccc = $getcolu->fetch_assoc();
        
        $colupd = 'UPDATE users set college=?,primary_color=? where email=?';
        $colls = $dbconn->prepare($colupd);
        $colls->bind_param('sss',$ccc['abbreviation'],$ccc['primary_color'],$_SESSION['user_email']);
        $colls->execute();
        $dbconn->close();
        header('Location: myaccount.php');
      }
        $dbconn->close();

      require('../php/getcolors.php');
      $numpost = 0;
      $dbconn = new mysqli('localhost','austinpalmer','thereisnone1!','firesale');
      $quer = 'SELECT colleges.name,colleges.image,DATE_FORMAT(users.date_created,"%M %e, %Y") as date_created FROM users,colleges WHERE colleges.abbreviation=users.college AND users.email="' . $_SESSION['user_email'] . '"';
      $accdata = $dbconn->query($quer);
      $adata = $accdata->fetch_assoc();
      $colnam = $adata['name'];
      $uscre = $adata['date_created'];
      $pic = '../images/' . $adata['image'];
      $picwid = getimagesize($pic)[0];
      $picheit = getimagesize($pic)[1];
      
      foreach (array('textbooks','sublets','services','misc') as $cat) {
        $quer = 'SELECT COUNT(' . $cat . '.id) as count FROM ' . $cat . ' where posted_by="' . $_SESSION['user_email'] . '"';
        $acount = $dbconn->query($quer);
        $countdata = $acount->fetch_assoc();
        $numpost += $countdata['count'];
      }
      
      $dbconn->close();
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
						<span id="account">MY ACCOUNT</span>
					</td>
				</tr>
			</table> 
		</header>
		
		<?php
		  require('../php/accountbar.php');
		?>
		<div id="bodywrap">
		  <table id="acc">
		    <tr class="actitle">
		      <td class="acslot"><p class="prof">MY PROFILE</td>
		      <td></td>
		    </tr>
		    <tr id="acpic">
		      <td class="acslot" id="acpic2"><img src="<?php echo $pic; echo '" '; if($picwid>$picheit) { echo 'width="215" ';} else { echo 'height="215" ';} ?> ></td>
		      <td id="acdets">
		      
		        <table class="accpage" id="acdet">
		          <tr class="fdet">
		            <td class="emdet"><span class="mycol">Email Address: </span></td><td colspan="2" class="nope"><span id="meemail"><?php echo $_SESSION['user_email']; ?></span></td>
		          </tr>
		          <tr class="fdet">
		            <td class="coldet"><span class="mycol">College: </span></td><td colspan="2" class="nope"><span><?php echo $colnam; ?></span></td>
		          </tr>
		          <tr class="fdet">
		            <td class="datdet"><span class="mycol">Member Since: </span></td><td colspan="2" class="nope"><span><?php echo $uscre; ?></span></td>
		          </tr>
		          <tr class="fdet">
		            <td class="numdet"><span class="mycol">Number of Posts: </span></td><td colspan="2" class="nope"><span><?php echo $numpost; ?></span></td>
		          </tr>
		          <tr id="ldet"></tr>
		          <tr id="alterpr">
		            <td class="nopedet"></td><td class="alter" id="chpr">EDIT PROFILE</td><td class="alter" id="delpr">DELETE PROFILE</td>
		          </tr>
		        </table>
		        
		        <table class="accpage" id="chdet"><form method="POST" id="changeaccount" action="<?php echo($_SERVER['PHP_SELF']); ?>">
		          <tr class="fdet3">
		            <td class="coldet"><span class="mycol">College: </span></td><td colspan="2" class="nope"><select name="newcollege" id="newcollege">
		              <?php 
		                $dbconn = new mysqli('localhost','austinpalmer','thereisnone1!','firesale');
		                $getcols = $dbconn->query('SELECT name,abbreviation from colleges ORDER BY name');
		                while ($row=$getcols->fetch_assoc()) {
		                  echo '<option value="' . $row['abbreviation'] . '" ';
		                  if ($row['name']==$colnam) {
		                    echo 'selected="true" ';
		                  }
		                  echo '>' . $row['name'] . '</option>' ;
		                }
		              ?> </select></td>
		          </tr>
		          <tr class="fdet3">
		            <td class="datdet"><?php if ($passmatch==false) {echo "<span class='must'>Passwords don't match!</span>";} else {echo '';} ?>
		            </td><td class="blankpr"></td><td id="newcolor"></td>
		          </tr>
		          <tr class="fdet2" id="fdetf">
		            <td class="numdet"><span class="mycol">New Password: </span></td><td class="nope"><input type="password" name="newpass" id="newpass"></td>
		          </tr>
		          <tr class="fdet2" id="fdetl">
		            <td class="passdet"><span class="mycol">Confirm Password: </span></td><td class="nope"><input type="password" name="confpass" id="confpass"></td>
		          </tr>
		          <tr id="ldet2"></tr>
		          <tr id="alterpr">
		            <td class="nopedet"></td><td colspan="2" id="savpr"><span>SAVE CHANGES</span></td><td class="alter" id="canpr">CANCEL</td>
		          </tr></form>
		        </table>
		        
		      </td>
		    </tr>
		    <tr class="actitle" id="hist">
		      <td class="acslot"><p class="prof">MY HISTORY</td>
		      <td></td>
		    </tr>
		  </table>
		  <div id="searchcontent">
		  
		  </div>
		  <table id="fill">
		<tr id="filler"></tr>
		<tr><td id="fillcont"><div id="googmap"></div></td></tr>
		</table>
		</div>
		
		<script src="../scripts/jquery-1.12.4.js"></script>
		<script src="../scripts/hidenav.js"></script>
		<script src="../scripts/account.js"></script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTCgnawrKrN2G1zJSAVZ7Nj2OigW1-CrI&libraries=places&callback=initMarkers"></script>
		<script src="../scripts/accapartcomplete.js"></script>
		<script src="../scripts/accountpage.js"></script>
		
	</body>
</html>

<?php
    } 
  } else {
    header('Location: tryout.php?where=myaccount',true,301);
    exit;
  }
?>
