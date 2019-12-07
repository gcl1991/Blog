<?php
//create_cat.php
include 'connect.php';
include 'header.php';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	//someone is calling the file directly, which we don't want
	echo 'This file cannot be called directly.';
}
else
{
	//check for sign in status
	if(!$_SESSION['signed_in'])
	{
		echo 'You must be signed in to post a reply.';
	}
	else
	{
		//a real user posted a real reply
		if ($_FILES["file"]["size"] < 200*1024){
		if ($_FILES["file"]["error"] > 0)
			{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
			}
		else
			{
			$im_save_path = "upload/" . $_FILES["file"]["name"];
			if (!(file_exists($im_save_path)))
			{
			move_uploaded_file($_FILES["file"]["tmp_name"],$im_save_path);
			}
			}
		}
		else
		{
		echo "图片文件必须小于200K";
		}

		$sql = "INSERT INTO 
					posts(post_content,
						  post_image_url,
						  post_date,
						  post_topic,
						  post_by) 
				VALUES ('" . $_POST['reply-content'] . "',"
						. "'" .$_FILES["file"]["name"]. "'," 
						."NOW()," 
						. mysqli_real_escape_string($connect,$_GET['id']) . "," 
						. $_SESSION['user_id'] . ")";
						
		$result = mysqli_query($connect,$sql);
						
		if(!$result)
		{
			echo 'Your reply has not been saved, please try again later.';
		}
		else
		{
			echo 'Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.';
		}
	}
}

include 'footer.php';
?>