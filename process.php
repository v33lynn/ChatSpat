<?php
session_start();

include_once('new-connection.php');
// ------------------------------------------------------------------------------------
// LOGIN SESSION INITIATE

if(isset($_POST['login']))
{
	// 1. Login query in SQL = USERS table : id, first, last, email
	//  						    where email field =  
	$query= "SELECT id , first_name, last_name, email FROM users WHERE email= '{$_POST['email']}' AND password= '{$_POST['password']}' LIMIT 1";
	$user= fetch($query);
	if (count($user)>0)
	{
		// 1. initiate each new session of user at $user[0]
		// 2. redirect to thewall.php and exit 
		$_SESSION['user']= $user[0];       
		header('location: thewall.php');
		exit();
	}

	else 
	{
		// else = 'invalid' session with msg rec'd 'invalid credentials'
					// -relocated back to index.php homepage.
		$_SESSION['invalid']="INVALID CREDENTIALS";
		header('location:index.php');
		exit();
	}
}


// REGISTRATION SESSION INITIATE

if (isset($_POST['registration']))
{
	$query= "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at)
	VALUES ('{$_POST['first_name']}', '{$_POST['last_name']}', '{$_POST['email']}', '{$_POST['password']}', NOW(), NOW())";
	run_mysql_query($query);
	$_SESSION['user_registered']= "You are now registered!";
	header('location: index.php');
	exit();
}


// 1. POST NEW MESSAGE = $_POST['message']
// 2. INSERT new message into mySQL ("the_wall.schema) = 'run_mysql_query($insert_messages)'
// 3. send to thewall.php page

if (isset($_POST['message']))
{
	$insert_messages= "INSERT INTO messages (message, user_id, created_at)
	VALUES ('{$_POST['textarea']}', '{$_SESSION['user']['id']}', NOW())";
	run_mysql_query($insert_messages);
	
	header('Location: thewall.php');
	die();
}

// 1. POST new COMMENT = $POST['comment']
// 2. insert comments into mySQL ("the_wall.schema") = run_mysql_query($insert_comments);

if (isset($_POST['comment'])) {
	$insert_comments="INSERT INTO comments (comment, user_id, message_id, created_at, updated_at)
		VALUES ('{$_POST['text_comment']} ', '{$_SESSION['user']['id']}', '{$_POST['comment']}'  ,  NOW(), NOW() )";
	run_mysql_query($insert_comments);

	header('Location: thewall.php');
	die();
}
//___________________________________________________________________

?>