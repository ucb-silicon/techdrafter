<?php
session_name('linkedin');
session_start();

$user = $_SESSION['user'];
$subject = json_encode($user);

echo $subject;
?>
