<?php
function clear_session(){
// 重置会话中的所有变量
$_SESSION = array();
// 如果要清理的更彻底，那么同时删除会话 cookie
// 注意：这样不但销毁了会话中的数据，还同时销毁了会话本身
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
}
clear_session();
include 'header.php';
echo '<h2>Sign out</h2>';
echo 'Succesfully signed out, thank you for visiting.';
include 'footer.php';
?>