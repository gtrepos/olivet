<?
require ("../tools/config.php");
ouverture ();
if (isset($_POST['pseudo'])){$pseudo=$_POST['pseudo'];}
if (isset($_POST['pass'])){$pass=$_POST['pass'];}

	if ($pseudo=='' || $pass=='')
	{
   	header("Location: index.php?identification=non");
	}
	else
	{
        $query = "SELECT mot_de_passe FROM phpl_membres WHERE pseudo='$pseudo' and admin='1'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
        $password_crypt = md5($pass);
  
	if($row['mot_de_passe'] != $password_crypt or mysql_num_rows($result)=="0")
	{
         header("Location: index.php?identification=non2");
	}
	else
	{
        $ip = $REMOTE_ADDR;
	$time = time();
	$query = "SELECT * FROM phpl_membres WHERE pseudo='$pseudo' and admin='1'";
	$result = mysql_query($query) or die ('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	$row = mysql_fetch_array($result);
	$mot_de_passe = $row['mot_de_passe'];

	mysql_query("UPDATE phpl_membres SET ip='$ip', last_connect='$time' WHERE pseudo='$pseudo'");
        if ($autoidentification) {$expire=365*24*3600;}
        else {$expire=3600;}
	setcookie("user","$pseudo",time()+$expire,"/","");
	setcookie("mot_de_passe","$mot_de_passe",time()+$expire,"/","");
/*	session_start();
	session_register('user');
	session_register('mot_de_passe');*/
	$_SESSION['user'] = $user;
	$_SESSION['mot_de_passe'] = $mot_de_passe;
	header("Location: index.php?page=championnat");
}}

