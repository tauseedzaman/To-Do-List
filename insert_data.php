<?php
require 'config.php';
$message = $_POST['message'];
$now = $_POST['now'];
$query = "INSERT INTO to_do_list.list (message, created_at) VALUES ('$message','$now')";
mysqli_query($conn,$query) or die('got an error!!'.mysqli_error($conn));
echo 'data inserted successfully!';