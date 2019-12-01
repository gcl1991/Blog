<?php
//create_cat.php
include 'connect.php';
include 'header.php';

echo '<h2>Create a category</h2>';
if(!isset($_SESSION['signed_in']) or $_SESSION['signed_in'] == false)
{
	//the user is not an admin
	echo 'Sorry, you have to be <a href="signin.php">signed in</a> to create a category.';

}
elseif($_SESSION['user_level'] != 1){
	echo 'Sorry, you do not have sufficient rights to access this page.';
}
else
{
	//the user has admin rights
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		//the form hasn't been posted yet, display it
		echo '<form method="post" action="">
			Category name: <input type="text" name="cat_name" /><br />
			Category description:<br /> <textarea name="cat_description" /></textarea><br /><br />
			<input type="submit" value="Add category" />
		 </form>';
	}
	else
	{
		//the form has been posted, so save it
		$sql = "INSERT INTO categories(cat_name, cat_description)
		   VALUES('" . mysqli_real_escape_string($connect, $_POST['cat_name']) . "',
				 '" . mysqli_real_escape_string($connect, $_POST['cat_description']) . "')";
		$result = mysqli_query($connect, $sql);
		if(!$result)
		{
			//something went wrong, display the error
			echo 'Error' . mysql_error();
		}
		else
		{
			echo 'New category succesfully added.';
		}
	}
}

include 'footer.php';
?>
