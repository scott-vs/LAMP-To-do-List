<?php
// expire cookie
setcookie('userId','',1);
header("location: index.php");
?>