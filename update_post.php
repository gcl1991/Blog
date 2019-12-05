<?php
include 'connect.php';
include 'header.php';
if($_SERVER['REQUEST_METHOD'] != 'POST'){
echo '<tr><td colspan="2"><h2>修改:</h2><br />
<form method="post" action="">
    <textarea name="update-content"></textarea><br /><br />
    <input type="submit" value="Submit reply" />
</form></td></tr>';
}
else{
$sql = "UPDATE posts SET post_content = '" . $_POST['update-content'] ."' WHERE post_id = " . mysqli_real_escape_string($connect,$_GET['post_id']);
$result = mysqli_query($connect,$sql);
if(!$result)
{
	echo '修改失败，请重试';
}
else{
    echo "<a href='topic.php?id=". $_GET['topic_id'] . "'>修改成功请刷新</a>";
}
}
include 'footer.php';
?>