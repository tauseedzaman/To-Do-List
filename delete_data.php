<?php
include 'config.php';
$id = $_POST['id'];
$query = "DELETE FROM to_do_list.list WHERE id = $id";
mysqli_query($conn,$query) or die("you got a problum!".mysqli_error($conn));
echo "data deleted successfully!";