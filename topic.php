<?php
//create_cat.php
include 'connect.php';
include 'header.php';

$sql = "SELECT
			topic_id,
			topic_subject
		FROM
			topics
		WHERE
			topics.topic_id = " . mysqli_real_escape_string($connect,$_GET['id']);
			
$result = mysqli_query($connect,$sql);

if(!$result)
{
	echo 'The topic could not be displayed, please try again later.';
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		echo 'This topic doesn&prime;t exist.';
	}
	else
	{
		while($row = mysqli_fetch_assoc($result))
		{
			//display post data
			echo '<table class="topic" border="1">
					<tr>
						<th colspan="2">' . $row['topic_subject'] . '</th>
					</tr>';
		
			//fetch the posts from the database
			$posts_sql = "SELECT
						posts.post_id,
						posts.post_topic,
						posts.post_content,
						posts.post_date,
						posts.post_by,
						users.user_id,
						users.user_name
					FROM
						posts
					LEFT JOIN
						users
					ON
						posts.post_by = users.user_id
					WHERE
						posts.post_topic = " . mysqli_real_escape_string($connect,$_GET['id']);
						
			$posts_result = mysqli_query($connect,$posts_sql);
			
			if(!$posts_result)
			{
				echo '<tr><td>The posts could not be displayed, please try again later.</tr></td></table>';
			}
			else
			{
			
				while($posts_row = mysqli_fetch_assoc($posts_result))
				{
					echo "<style type='text/css'>a.delete-post{position:relative;bottom:-20px;right:-300px;}</style>";
					echo '<tr class="topic-post"' .'id=' . $posts_row["post_id"] . '>' .
							'<td class="user-post">' . $posts_row['user_name'] . '<br/>' . date('d-m-Y H:i', strtotime($posts_row['post_date'])) . '</td>
							<td class="post-content">' . htmlentities(stripslashes($posts_row['post_content']));
							echo "id是:" . $posts_row["post_id"] . "主题id是:" . $posts_row['post_topic'];
							if (isset($_SESSION['user_id']) and ($_SESSION['user_id'] == $posts_row['user_id'])){
								echo "<a class='delete-post' href='delete_post.php?post_id=" .$posts_row['post_id'].'&topic_id='.$posts_row['post_topic']. "'>删除</a>";
								echo "<a class='update-post' href='update_post.php?post_id=" .$posts_row['post_id'].'&topic_id='.$posts_row['post_topic']. "'>修改</a>";
							echo '</td>';
					echo '</tr>';
					}
				}
			}
			
			if(!isset($_SESSION['signed_in']))
			{
				echo '<tr><td colspan=2>You must be <a href="signin.php">signed in</a> to reply. You can also <a href="signup.php">sign up</a> for an account.';
			}
			else
			{
				//show reply box
				echo '<tr><td colspan="2"><h2>Reply:</h2><br />
					<form method="post" action="reply.php?id=' . $row['topic_id'] . '">
						<textarea name="reply-content"></textarea><br /><br />
						<input type="submit" value="Submit reply" />
					</form></td></tr>';
			}
			
			//finish the table
			echo '</table>';
		}
	}
}

include 'footer.php';
?>