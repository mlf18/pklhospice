<?php
session_start();
session_unset('iduser');
session_unset('username');
session_destroy('iduser');
session_destroy('username');
setcookie('iduser', '', time() + (86400 * -1), "/");
setcookie('username', '', time() + (86400 * -1), "/");
setcookie('token', '', time() + (86400 * -1), "/");
header('Location: login');
?>