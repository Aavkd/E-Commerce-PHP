<?php
// public/admin/logout.php
require_once '../../src/Utils/Auth.php';
Auth::logout();
header('Location: login.php');
exit;
?>
