<?php

session_start();

include_once('new-connection.php');
$query= "SELECT messages.id, messages.message, messages.created_at, users.first_name, users.last_name
					FROM messages
					LEFT JOIN users
					ON messages.user_id= users.id
					ORDER BY created_at DESC";
$messages=fetch($query);
$_SESSION['messages']= $messages;


$query_comments="SELECT comments.comment, comments.created_at, users.first_name, users.last_name, comments.message_id
				FROM comments
				LEFT JOIN users
				ON comments.user_id= users.id";
				
$comments=fetch($query_comments);


?>


<html>
<head>
	<title>the wall</title>

	<style>
		textarea
		{

			min-width: 80%;
			border-radius: 10px;
			min-height: 150px;
		
		    padding-left: 20px;
		    padding-top: 20px;
		    padding-bottom: 20px;
		    padding-right: 20px;

		}

		.comment textarea
		{
			min-height: 75px;
			min-width: 40%;

		}

		.comment
		{
			margin-left: 300px;
		}



	</style>
</head>
<body>
	<h1>Welcome <?=  $_SESSION['user']['first_name'] ?></h1>

	<h2>Write a message:</h2>
	<form method="post" action="process.php">
		<p><textarea name="textarea"></textarea></p>
		<button>Post a message!</button>
		<input type="hidden" name="message">
	</form>


<?php

foreach ($messages as $message)

{			

?>
	<div class="message">
		<h4><?=   $message['first_name']. '  ' . $message['last_name']. '  ' . $message['created_at']?></h4>
		<p><?=   $message['message'] ?></p>



		 <div class="comment">
<?php
			foreach ($comments as $comment)
			{
				if ($comment['message_id']==$message['id'])
				{
					
?>

				<h4><?=   $comment['first_name']. '  ' . $comment['last_name']. '  ' . $comment['created_at']?></h4>
				<p><?=   $comment['comment'] ?></p>
<?php
				}
			}

?>

			<h4>Write a comment:</h4>
			<form method="post" action="process.php">
				<p><textarea name="text_comment"></textarea></p>
				<button>Post a comment!</button>
				<input type="hidden" name="comment" value ="<?= $message['id']?>">
			</form>

		</div>
	
<?php
}
?>


	</div>

</body>
</html>