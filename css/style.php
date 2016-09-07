<?php
session_start();
header("Content-type: text/css; charset: UTF-8;");
?>

body {
	margin: 0;
	padding: 0;
	/*background-color: #b22222;
	font-family: Courier, monospace;*/
	background-color: <?php echo $_SESSION['primary_color']; ?>;
	font-family: "Avenir","Verdana","Menlo", sans-serif;
}

a {
  text-decoration: none;
  color: <?php echo $_SESSION['primary_color']; ?>;
}

table {
	width: 100%;
	border-spacing: 0;
}

#welcomehead {
  min-width: 1080px;
}

header h1,header h3 {
	padding: 0;
	margin: 0;
	/*color: #b22222;
	font-family: Courier, monospace;*/
	color: <?php echo $_SESSION['primary_color']; ?>;
	font-family: "Avenir","Verdana","Menlo", sans-serif;
}

 th {
	text-decoration: none;
	/*color: #b22222;
	border-bottom: 1px solid #b22222;*/
	color: <?php echo $_SESSION['primary_color']; ?>;
	border-bottom: 1px solid <?php echo $_SESSION['primary_color']; ?>;
	padding: 0;
}

td {
	padding: 0;
}

.clicknav {
	/*background-color: #b22222;*/
	background-color: <?php echo $_SESSION['primary_color']; ?>;
	color: white;
}

.unclicknav {
	background-color: white;
	/*color: #b22222;*/
	color: <?php echo $_SESSION['primary_color']; ?>;
}

header td {
	padding-left: 0px;
	padding-right: 0px;
	padding-top: 5px;
	padding-bottom: 5px;
	/*border-bottom: 1px solid #b22222;*/
	border-bottom: 1px solid <?php echo $_SESSION['primary_color']; ?>;
}

header th:hover {
	/*background-color: #b22222;*/
	background-color: <?php echo $_SESSION['primary_color']; ?>;
	color: white;
	cursor: pointer;
}

#searchwrapper input, #searchwrapper select {
	font-size: 18px;
	border-radius: 5px;
	/*border: 1px solid #b22222;
	font-family: Courier, monospace;*/
	border: 1px solid <?php echo $_SESSION['primary_color']; ?>;
	font-family: "Avenir","Verdana","Menlo", sans-serif;
	background-color: white;
}

input, select {
	font-size: 18px;
	border-radius: 5px;
	border: 1px solid <?php echo $_SESSION['primary_color']; ?>;
	font-family: "Avenir","Verdana","Menlo",sans-serif;
	background-color: white;
	margin: 2px 0px;
}

input[type="submit"] {
	font-size: 17px;
}

#searchwrapper #homesearch {
	font-size: 17px;
}
#searchwrapper form {
	padding-left: 20px;
}

#nav {
	background-color: white;
}

#leftnav {
	padding-left: 200px;
	min-width: 200px;
}

#leftnav h1{
	width: 165px;
}

#leftnav h1:hover {
	cursor: pointer;
}

#booknav {
	min-width: 74px;
}

#apartnav {
	min-width: 147px;
}

#servicenav {
	min-width: 117px;
}

#miscnav {
	min-width: 192px;
}

#rightnav {
	min-width: 150px;
	padding-right: 200px;
	padding-top: 0px;
	padding-bottom: 0px;
	text-align: right;
	height: 45px;
}

#search {
	background-color: #eeeeee;
	height: 45px;
	width: 100%;
	min-width: 880px;
	border-bottom: 1px solid <?php echo $_SESSION['primary_color']; ?>;
}

#search tr {
	height: 45px;
}

#searchwrapper {
	height: 45px;
	min-width: 880px;
	margin-left: 200px;
	margin-right: 200px;
	/*box-shadow: 0px 4px 5px -2px #b22222;*/
	box-shadow: 0px 4px 5px -2px <?php echo $_SESSION['primary_color']; ?>;
	position: relative;
	z-index: 10;
}

#content {
  min-height: 105vh;
	min-width: 880px;
	background-color: white;
	margin-left: 200px;
	margin-right: 200px;
	position: relative;
	padding-bottom: 50px;
}


#refine {
	border-bottom: none;
	/*color: #b22222;*/
	color: <?php echo $_SESSION['primary_color']; ?>;
	font-size: 10px;
}

#refine:hover {
	cursor: pointer;
}

#test {
	width: 100%;
	min-width: 650px;
	/*height: 250px;*/
	background-color: #eeeeee;
	/*box-shadow: 0px 4px 5px -2px #b22222;*/
	box-shadow: 0px 4px 5px -2px <?php echo $_SESSION['primary_color']; ?>;
	padding-top: 10px;
	display: none;
}

#account {
	min-height: 45px;
	vertical-align: middle;
	padding: 0;
	margin: 0;
}

#account span{
	vertical-align: middle;
}

#account:hover {
	cursor: pointer;
}

#bodywrap {
	min-height: 105vh;
	background-color: white;
	margin-left: 200px;
	margin-right: 200px;
	min-width: 880px;
	padding-bottom: 30px;
}

#bodywrap form{
	padding-top: 10px;
	padding-left: 10px;
}

#bodywrap p {
	margin: 0px 0px 5px 0px;
}

#bodywrap input:last-child {
	margin-top: 5px;
	margin-bottom: 10px;
}

#steptwo {
	display: none;
}

#description {
	resize: none;
}

#testrow {
	float: left;
	position: absolute;
	z-index: 1000;
	top: 48px;
	height: 500px;
	width: 250px;
	background-color: white;
	/*border: 1px solid #b22222;
	border-top: none;*/
	border: 1px solid <?php echo $_SESSION['primary_color']; ?>;
	border-top: none;
	display: none;
}

#testrow th {
	border-bottom: 0px;
}

#testrow tr:hover {
	cursor: pointer;
}

table.accountblock tr {
	height: 30px;
}

.mo th:hover {
  background-color: <?php echo $_SESSION['primary_color']; ?> !important;
  color: #ffffff !important;
}

.welcomeblock {
  height: 65px !important;
  border-bottom: 1px <?php echo $_SESSION['primary_color']; ?> !important;
}

.welcomeblock th {
  padding-top: 6px !important;
  padding-bottom: 4px !important;
  border-bottom: 1px solid <?php echo $_SESSION['primary_color']; ?> !important;
}

.welcomeblock th:hover {
  cursor: default !important;
}

.welcomeblock a {
  font-size: 10px !important;
}

#test #searchrefine {
	padding-left: 10px;
}

#searchrefine input {
	padding: 0;
	border-radius: 5px;
	margin: 2px 0 2px 0;
}

#refinewrapper {
	border-bottom: none;
}

#refinewrapper th,#refinewrapper td {
	/*width: 50%;*/
	vertical-align: top;
}

#searchrefine th,#searchrefine td {
	border-bottom: none;
	/*width: 100%;*/
	padding-left: 15px;
	text-align: left;
}

#searchrefine #deliver {
	text-align: left;
	padding-left: 75px;
	font-size: 14px;
}

#searchrefine .labelwrap {
  width: 120px !important;
  text-align: right;
  vertical-align: middle;
}

#searchrefine .altlabelwrap {
  width: 150px !important;
  text-align: right;
  vertical-align: middle;
}

#searchrefine #deliver p {
	margin-bottom: 2px;
}

header {
	background-color: white;
}

#welcome {
	padding-left: 200px;
	min-width: 880px;
}

#bodywrapper {
	min-width: 880px;
	margin-left: 200px;
	margin-right: 200px;
	background-color: white;
}	

.block {
	height: 200px;
	width: 350px;
	border-left: solid 1px <?php echo $_SESSION['primary_color']; ?>;
	border-bottom: solid 1px <?php echo $_SESSION['primary_color']; ?>;
	border-collapse: collapse;
	vertical-align: top;
}

.block div {
	padding-left: 10px;
}

.block h3 {
	margin: 10px 0px;
}

#welcometext {
	vertical-align: top;
}

#bodywrapper p {
	padding-left: 15px;
	padding-right: 15px;
}

input[type="number"] {
	width: 35px;
	border-radius: 0px;
}

#optionalrefine input[type="number"] {
	border-radius: 0px;
}

.picture {
	font-size: 12px;
	padding: 2px;
}

#newuser {
	min-height: 250px;
}

.must {
	color: red;
}

#lastblock {
  border-bottom: none;
}

#whereto {
  display: none !important;
}

#college {
  margin-top: 5px;
}

#confirmwrap {
  min-height: 105vh;
  background-color: white;
  min-width: 880px;
  margin-left: 200px;
	margin-right: 200px;
  padding-top: 15px;
  padding-left: 15px;
}

#confirmwrap p {
  margin-top: 0;
}

.confi {
  display: none !important;
}

#req {
  padding-top: 10px !important;
  padding-left: 10px !important;
  margin-bottom: 0 !important;
  color: red;
}

.lookie {
  color: red;
}

.sres {
  padding: 0;
  background-color: white;
  min-height: 140px;
  width: 579px;
  margin:0;
  border-bottom: 1px solid #eeeeee;
}

.ares {
  border-bottom: none;
}

.blank {
  width: 15px;
  border-bottom: none;
}

.picslot {
  min-width: 100px;
  border-right: 1px solid #eeeeee;
  border-bottom: 1px solid #eeeeee !important;
}

.titleslot td {
  font-size: 16px;
  color: <?php echo $_SESSION['primary_color']; ?>;
  vertical-align: middle;
}

.miscslot td {
  padding-top: 0;
  vertical-align: top;
}

.titleslot {
  height: 40px;
}

.descripslot {
  height: 40px;
  vertical-align: bottom;
}

.miscslot {
  height: 30px;
}

.wcard {
  font-size: 14px;
  min-width: 75px;

}

.dslot {
  font-size: 12px;
  padding-bottom: 3px;
}

.nameslot {
  text-align: left;
}

.sres span,.sres p {
  margin-left: 5px !important;
  margin-top: 0 !important;
  margin-bottom: 0 !important;
}

.priceslot {
  text-align: right;
  padding-right: 5px;
}

.contslot {
  min-width: 150px;
  font-size: 14px;
  text-align: right;
  padding-right: 5px;
}

#googmap {
  display: inline-block;
  position: relative;
  min-height: 300px;
  min-width: 300px;
  vertical-align: top;
  /*border-top: 1px solid #eeeeee;*/
  border-bottom: 1px solid #eeeeee;
  border-left: 1px solid #eeeeee;
}

#searchcontent {
  display: inline-block;
  max-width: 580px;
}

.hid {
  display: none;
}

.sres:hover {
  cursor: pointer;
}

#details {
  float: right;
  border-left: 1px solid #eeeeee;
}

#picframe {
  display: inline-block;
  position: relative;
  z-index: 1;
  min-height: 300px;
  max-height: 300px;
  min-width: 300px;
  vertical-align: top;
  border-bottom: 1px solid #eeeeee;
  border-left: 1px solid #eeeeee;
}

#deetframe {
  width: 300px;
  table-layout: auto;
}

.deetrow {
  height: 30px;
  width: 300px;
}

.deetrow td {
  vertical-align: middle;
  font-size: 14px;
  padding-left: 5px;
}

#titcol {
  color: <?php echo $_SESSION['primary_color']; ?>;
  font-size: 16px;
}

.lastslot {
  height: 140px;
  vertical-align: top;
  text-align: justify;
}

.lslot {
  font-size: 13px;
  padding-right: 5px;
}

.prof {
  font-size: 32px;
  font-family: monospace;
  padding: 0;
}

.actitle {
  height: 50px;
  vertical-align: middle;
  text-align: center;
}

#acpic {
  height: 220px;
}

#acpic2 {
  /*border-right: 1px solid #eeeeee;*/
  border-bottom: 1px solid #eeeeee;
  text-align: center;
  vertical-align: middle;
  /*border-top: 1px solid #eeeeee;*/
}

.acslot {
  min-width: 220px;
}

#acdets {
  min-width: 660px;
  height: 220px;
  border-bottom: 1px solid #eeeeee;
  /*border-top: 1px solid #eeeeee;*/
}


.fdet {
  height: 30px;
}

.fdet span {
  padding-left: 20px;
}

.emdet,.coldet,.datdet,.numdet,.passdet,.nopedet {
  width: 175px;
  text-align: right;
}

.nope {
  padding-left: 10px;
  text-align: left;
}

#ldet {
  height: 50px;
}

.mycol {
  color: <?php echo $_SESSION['primary_color']; ?>;
}

img {
  padding: 0;
  margin: 0;
}

#filler {
  min-height: 0px;
  min-width: 300px;
  padding: 0;
  margin: 0;
  float: right;
}

#fill {
  width: 300px;
  float: right;
}

#alterpr {
  height: 30px;
  font-size: 12px;
}

#chpr,#delpr,#savpr {
  text-align: right;
  font-family: monospace;
  padding-right: 10px;
}

#canpr {
  text-align: center;
  font-family: monospace;
}

#chpr {
  min-width: 360px;
}

#delpr {
  min-width: 105px;
}

.alter:hover {
  cursor: pointer;
}

#savpr span {
  margin-right: 10px;
}

#savpr span:hover {
  cursor: pointer;
}

#acdet {
  padding-top: 20px;
  width: 660px;
  display: initial;
}

#chdet {
  padding-top: 20px;
  width: 660px;
  display: none;
}

#newcolor {
  background-color: <?php echo $_SESSION['primary_color']; ?>;
  border-radius: 5px;
}

.fdet2 {
  height: 30px;
}

.fdet7 {
  height: 10px;
}

.ldet3 {
  height: 20px;
}

.fdet2 select,.fdet2 input {
  margin: 0 !important;
}

.fdet3 {
  height: 31px;
}

.fdet3 input {
  margin: 0 !important;
}

#ldet2 {
  height: 40px;
}

#acc {
  border-bottom: 1px solid #eeeeee;
}

.piccell {
  width: 100px;
}

#pictures tr,#pictures td {
  max-height: 30px !important;
}

.deletepost,.editpost {
  font-size: 14px;
  font-family: monospace;
  vertical-align: middle;
}

.editpost {
  text-align: center;
  min-width: 100px;
}

.editpost span {
  margin-left: 0 !important;
}

.deletepost span {
  margin-left: 10px !important;
}

.deletepost {
  width: 379px;
}

.editrow {
  height: 20px;
}

.edit {
  width: 100px;
  text-align: center;
}

.editpics {
  width: 100px;
}

.edit,.deletepost,.editpics {
  height: 25px;
  font-size: 14px;
  font-family: monospace;
  display: inline-block;
  border-bottom: 1px solid #eeeeee;
  vertical-align: middle;
  
}

.edit span:hover,.deletepost span:hover {
  cursor: pointer;
}

.editinp {
  border: none;
  border-bottom: 1px solid #eeeeee;
}

#modal {
  height: 100%;
  width: 100%;
  background: rgba(0,0,0,.3);
  position: fixed;
  z-index: 10000;
}

#modal-content {
  min-height: 250px;
  width: 500px;
  background-color: #ffffff;
  position: absolute;
  top: 50%;
  left: 50%;
  margin: -125px 0 0 -250px;
}

#modal-content2 {
  min-height: 400px;
  width: 600px;
  background-color: #ffffff;
  position: absolute;
  top: 50%;
  left: 50%;
  margin: -200px 0 0 -300px;
}

#mod-con {
  min-height: 230px;
  width: 480px;
  border: 1px solid <?php echo $_SESSION['primary_color']; ?>;
  margin: 10px;
}

#mod-con2 {
  min-height: 380px;
  width: 580px;
  border: 1px solid <?php echo $_SESSION['primary_color']; ?>;
  margin: 10px;
}

#mod-con span,#mod-con2 span {
  margin-left: 5px;
  margin-top: 5px;
  font-family: monospace;
  font-size: 18px;
}

#modtop {
  height: 25px;
}

#modmid {
  min-height: 175px;
  vertical-align: middle;
  text-align: center;
}

#modmid2 {
  min-height: 325px;
  vertical-align: middle;
  text-align: center;
  border-top: 1px solid #eeeeee;
  border-bottom: 1px solid #eeeeee;
}

#modbot {
  min-height: 30px;
  text-align: right;
  vertical-align: middle;
}

#modbot button {
  height: 25px;
  background-color: #ffffff;
  border: 1px solid <?php echo $_SESSION['primary_color']; ?>;
  margin-right: 5px;
}

#modmid div {
  height: 25px;
  width: 100%;
  position: absolute;
  top: 50%;
  margin: -12.5px 0 0 0;
}

#modmid p {
  margin: 0;
}

.checkit {
  text-align: right;
}

.checkin {
  padding-left: 10px;
  text-align: left;
}

.blankpr {
  min-width: 50px;
}

#checkpassrow label {
  font-family: monospace;
  font-size: 18px;
}

#picframe img {
  display: block;
  position: relative;
  background-color: #ffffff;
  height: 290px;
  width: 290px;
  margin: 0;
  padding: 5px;
}

#pict1 {
  z-index: 100;
}

#pict2 {  
  top: -300px;
}

#pict3 {
  top: -600px;
}

#pict4 {
  top: -900px;
}

#pict5 {
  top: -1200px;
}

#testitout {
  min-height: 300px;
  min-width: 300px;
  position: relative;
  top: -1500px;
  z-index: 1000;
  display: none;
}

.picmove {
  min-height: 300px;
  float: left;
}

#moveleft,#moveright {
  width: 50px;
  /*background: rgba(0,0,0,.8);*/
  background-color: <?php echo $_SESSION['primary_color']; ?>;
  opacity: .8;
  vertical-align: middle;
  text-align: center;
}

#moveleft:hover,#moveright:hover {
  cursor: pointer;
}

#moveleft p,#moveright p {
  line-height: 300px;
  font-size: 50px;
  margin: 0;
  color: #ffffff;
}

#nomove {
  width: 200px;
}

#mapswap {
  position: relative;
  top: -302px;
  height: 25px;
  z-index: 10;
}

#mapswap th {
  min-width: 150px;
  border-bottom: none;
}

#mapswap th:hover {
  cursor: pointer;
  color: #ffffff;
  background-color: <?php echo $_SESSION['primary_color']; ?>;
  border-top: 1px solid <?php echo $_SESSION['primary_color']; ?>;
  /*border-bottom: 1px solid <?php echo $_SESSION['primary_color']; ?>;*/
}

.mapswapclick {
  background-color: <?php echo $_SESSION['primary_color']; ?>;
  border-top: 1px solid <?php echo $_SESSION['primary_color']; ?>;
 /* border-bottom: 1px solid <?php echo $_SESSION['primary_color']; ?>;*/
  color: #ffffff;
}

.minipic {
  height: 96px;
  width: 96px;
  margin: 0;
  padding: 2px;
  float: left;
}

#testform form {
  padding: 0;
}
#testform table {
  border-collapse: collapse;
}

#testform td {
  border-radius: 0px;
  border: 1px solid #eeeeee;
  vertical-align: middle;
  padding: 0;
  margin: 0;
  border-collapse: collapse;
}

#testform .wcard {
  border: none;
}

#testform input,#testform textarea,#testform select {
  border-radius: 0;
  border: none;
  padding: 0;
  margin: 0 !important;
  width: 100%;
  height: 100%;
}

textarea {
  resize: none;
}

.tedit {
  width: 479px;
}

.pedit {
  width: 100px;
}

.peditl {
  width: 85px;
  border-left: none !important;
}

.lil {
  width: 15px;
  text-align: center;
  border-right: none !important;
}

.wedit {
  width: 329px;
}

.ledit {
  width: 250px;
}

.cedit,.blankspace {
  width: 179px;
}

.edit span,.deletepost span {
  display: inline-block;
  margin-top: 4px;
}

.tres {
  padding: 0;
  background-color: white;
  min-height: 140px;
  width: 579px;
  margin:0;

}

.tres .titleslot td {
  border-top: none !important;
}

.tres tr td:last-child {
  border-right: none !important;
}

.tres .lslot {
  border-bottom: none !important;
}

#postid,#testlat,#testlng {
  display: none;
}

#colinput {
  margin-right: 10px;
}