<?php

require 'config.php';
$message = $_POST['message'];
$id = $_POST['id'];
$now = $_POST['now'];
$query = "UPDATE to_do_list.list set message = '$message' , created_at = '$now' WHERE id =$id";
mysqli_query($conn, $query) or die('got an error!!' . mysqli_error($conn));
echo 'data updated successfully!';