<?php
include 'config.php';
$query = "DELETE FROM to_do_list.list ";
mysqli_query($conn,$query) or die("you got a problum!".mysqli_error($conn));
echo "data deleted successfully!";