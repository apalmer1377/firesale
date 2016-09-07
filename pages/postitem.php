<?php
  session_start();
  $picarray= array();
  
  switch($_POST['college']) {
    case 'textbook':
      $typ = 'textbooks';
      break;
    case 'apartment':
      $typ = 'sublets';
      break;
    case 'service':
      $typ = 'services';
      break;
    case 'misc':
      $typ = 'misc';
      break;
    default:
      break;
  }
    
  if (isset($_SESSION['user_email'])) {
    if (isset($_GET['logout'])) {
      $_SESSION = array();
      if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(),'',time() - 3600);
      }
      session_destroy();
      header('Location: ../pages/home.php',true,301);
      exit();
    } else {
    
        require('../phpscripts/getcolors.php');
        
        if (isset($_POST['postit'])) {
        switch($_POST['college']) {
          case 'textbook':
            if (!empty(trim($_POST['booktitle'])) && !empty(trim($_POST['author'])) && !empty(trim($_POST['bookprice']))) {
              $valid = true;
            } else {
              $valid = false;
            }
            break;
          case 'apartment':
            if (!empty(trim($_POST['address'])) && !empty(trim($_POST['city'])) && !empty(trim($_POST['state'])) && !empty(trim($_POST['zip'])) && !empty(trim($_POST['rent'])) && !empty(trim($_POST['available'])) && !empty(trim($_POST['endavailable'])) && !empty(trim($_POST['bedroom'])) && !empty(trim($_POST['bathroom']))) {
              $valid = true;
            } else {
              $valid = false;
            }
            break;
          case 'service':
            if (!empty(trim($_POST['servicename'])) && !empty(trim($_POST['serviceprice']))) {
              $valid = true;
            } else {
              $valid = false;
            }
            break;
          case 'misc':
            if (!empty(trim($_POST['miscname'])) && !empty(trim($_POST['miscprice']))) {
              $valid = true;
            } else {
              $valid = false;
            }
            break;
          default:
            break;
        }
        
        if ($valid==true) {
          if (!empty(trim($_POST['description'])) && (!empty(trim($_POST['phone'])) || !empty(trim($_POST['mail'])))) {
            
            $dbconn = new mysqli('localhost','austinpalmer','thereisnone1!','firesale');
            $pic = 0;
            for ($i=0;$i<5;$i++) {
              $ip = $i + 1;
              $picname = 'picture' . $ip;
              if (!(empty($_FILES[$picname]['name']))) {
                $pic = 1;
                break;
              }
            }
            switch($_POST['college']) {
              case 'textbook':
                $posting = $dbconn->prepare("INSERT INTO textbooks(name,edition,author,publisher,price,description,pictures,phone,email,college,posted_by) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                $posting->bind_param("ssssisissss",trim($_POST['booktitle']),trim($_POST['edition']),trim($_POST['author']),trim($_POST['publisher']),trim($_POST['bookprice']),trim($_POST['description']),$pic,trim($_POST['phone']),trim($_POST['mail']),$_SESSION['college'],$_SESSION['user_email']);
                $posting->execute();
                break;
              case 'apartment':
                $posting = $dbconn->prepare("INSERT INTO sublets(address,apt,city,state,zip,rent,start_date,end_date,beds,baths,description,pictures,phone,email,college,lat,lng,posted_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $posting->bind_param("sssssissiisissssss",trim($_POST['address']),trim($_POST['apt']),trim($_POST['city']),trim($_POST['state']),trim($_POST['zip']),trim($_POST['rent']),trim($_POST['available']),trim($_POST['endavailable']),trim($_POST['bedroom']),trim($_POST['bathroom']),trim($_POST['description']),$pic,trim($_POST['phone']),trim($_POST['mail']),$_SESSION['college'],$_POST['lat'],$_POST['lng'],$_SESSION['user_email']);
                $posting->execute();
                break;
              case 'service':
                $posting = $dbconn->prepare("INSERT INTO services(name,price,description,pictures,phone,email,college,posted_by) VALUES (?,?,?,?,?,?,?,?)");
                $posting->bind_param("sssissss",trim($_POST['servicename']),trim($_POST['serviceprice']),trim($_POST['description']),$pic,trim($_POST['phone']),trim($_POST['mail']),$_SESSION['college'],$_SESSION['user_email']);
                $posting->execute();
                break;
              case 'misc':
                $posting = $dbconn->prepare("INSERT INTO misc(name,type,price,description,pictures,phone,email,college,posted_by) VALUES (?,?,?,?,?,?,?,?,?)");
                $posting->bind_param("ssisissss",trim($_POST['miscname']),trim($_POST['category']),trim($_POST['miscprice']),trim($_POST['description']),$pic,trim($_POST['phone']),trim($_POST['mail']),$_SESSION['college'],$_SESSION['user_email']);
                $posting->execute();
                break;
              default:
                break;
            
              
            }
            
            if ($pic == 1) {
              while (true) {
                $picsplit = explode(".",$_FILES['picture' . (count($picarray)+1)]['name']);
                $picid = substr(sha1(mt_rand()),0,10) . '.' . end($picsplit);
                if (!(file_exists('/images/client/' . $_SESSION['ID'] . '/' . $picid))) {
                  if (!(empty($_FILES['picture' . (count($picarray) + 1)]['name']))) {
                    array_push($picarray,$picid);
                  } else {
                    array_push($picarray,'');
                  }
                }
                if (count($picarray) == 5) {
                  break;
                }
              }
            
              $getid = $dbconn->query('SELECT ID FROM ' . $typ . ' ORDER BY ID DESC LIMIT 1');
              $r = $getid->fetch_assoc();
              $id = $r['ID'];
              $setid = $dbconn->prepare("INSERT INTO " . $typ . "_pictures(ID,posted_by,picture1,picture2,picture3,picture4,picture5) VALUES (?,?,?,?,?,?,?)");
              $setid->bind_param('iisssss',$id,$_SESSION['ID'],$picarray[0],$picarray[1],$picarray[2],$picarray[3],$picarray[4]);
              $setid->execute();
              
              for ($ti=0;$ti<5;$ti++) {
                $path = '../images/client/' . $_SESSION['ID'] . '/' . $picarray[$ti];
                if (!(empty($_FILES['picture' . ($ti+1)]['name']))) {
                  move_uploaded_file($_FILES['picture'.($ti+1)]['tmp_name'],$path);
                }
              } 
            }
            
            $dbconn->close();
            
          } else {
            $valid = false;
          }
        }
        if ($valid==true) {
          header('Location: tryout.php',true,301);
          exit();
        }

    } else { 
      $valid = true;
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/style.php">
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
		  require('../phpscripts/accountbar.php');
		?>
		<div id="bodywrap" class="wrapper">
		  <?php if ($valid==false) {
		    echo '<p id="req">* fields are required.</p>' ;
		    } else {
		    echo '';
		    }
		  ?>
			<form enctype="multipart/form-data" id="itemtype" name="itemtype" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
				<p>What type of good are you selling?</p>
					<select name="college" id="college">
						<option value="textbook">Textbook</option>
						<option value="apartment">Sublet/Apartment</option>
						<option value="service">Service</option>
						<option value="misc">Miscellaneous</option>
					</select>
				<input type="submit" value="Continue" class="postsubmit">
		</div>	
		<script src="../scripts/jquery-1.12.4.js"></script>
		<script src="../scripts/postform.js"></script>
		<script src="../scripts/hidenav.js"></script>
		<script src="../scripts/account.js"></script>
		<script src="../scripts/apartcomplete.js"></script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTCgnawrKrN2G1zJSAVZ7Nj2OigW1-CrI&libraries=places"></script>
	</body>
</html>

<?php
    }
  } else {
    header('Location: tryout.php?where=postitem',true,301);
    exit();
  }
?>
