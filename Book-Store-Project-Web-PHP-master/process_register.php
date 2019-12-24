<?php
	require('includes/config.php');
	
	if(!empty($_POST))
	{
		$msg="";
		
		if(empty($_POST['fnm']) || empty($_POST['unm']) || empty($_POST['gender']) || empty($_POST['pwd']) || empty($_POST['cpwd']) || empty($_POST['mail'])||empty($_POST['city']))
		{
			$msg.="<li>Please enter all Requirement";
		}
		
		if($_POST['pwd'].lenght < 4 || $_POST['pwd'].lenght > 16){
		    $msg.="<li> Please enter an password with lenght 4 to 16 word";
		}
		
		if($_POST['pwd']!=$_POST['cpwd'])
		{
			$msg.="<li>Please Enter your Password Again.....";
		}
		
		
		
		if(is_numeric($_POST['fnm']))
		{
			$msg.="<li>Name must be in String Format...";
		}
		
		if($msg!="")
		{
			header("location:register.php?error=".$msg);
		}
		else
		{
			$fnm=$_POST['fnm'];
			$unm=$_POST['unm'];
			$pwd=$_POST['pwd'];
			$gender=$_POST['gender'];
			$email=$_POST['mail'];
			$contact=$_POST['contact'];
			$city=$_POST['city'];
			
			
		
			$q="select count(*) from user where u_unm='$unm'";
			
			$res=mysqli_query($conn,$q) or die("wrong query");
			
			$row=mysqli_fetch_assoc($res);
			
			if($row !=0){
			    $msg = "User is already exis! Please choose anothe username";
			    header("location:register.php?error=$msg");
			}
			else{
    			$query="insert into user(u_fnm,u_unm,u_pwd,u_gender,u_email,u_contact,u_city)
    			values('$fnm','$unm','$pwd','$gender','$email','$contact','$city')";
    			
    			mysqli_query($conn,$query) or die("Can't Execute Query...");
    			header("location:register.php?ok=1");
			}
		}
	}
	else
	{
		header("location:index.php");
	}
?>