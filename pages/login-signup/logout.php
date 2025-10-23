<?php
session_start();
require_once '../../includes/auth.php';

logout_user();
header('Location: ../../index.html');
exit();
?>