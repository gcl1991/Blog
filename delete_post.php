<?php
include 'connect.php';
include 'header.php';
 $sql = "DELETE FROM posts WHERE posts.post_id = " . mysqli_real_escape_string($connect,$_GET['post_id']);
$result = mysqli_query($connect,$sql);
if(!$result)
{
	echo '删除失败，请重试';
}
else{
    echo "<a href='topic.php?id=". $_GET['topic_id'] . "'>删除成功请刷新</a>";
}
include 'footer.php';
?>