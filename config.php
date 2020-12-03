<?php
/*
  * configration file here is the database and table configration
  */
$host= "localhost";
$username= "root";
$password= "";
$database= "CREATE DATABASE IF NOT EXISTS to_do_list";
$conn = mysqli_connect($host,$username,$password);
mysqli_query($conn,$database) or die ('go a problum in creating database');

/*
 * create list table if not exists .
 */
$query = "CREATE TABLE IF NOT EXISTS `to_do_list`.`list` ( `id` INT NOT NULL AUTO_INCREMENT , `message` VARCHAR(500) NOT NULL ,`created_at` varchar(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
mysqli_query($conn,$query) or die('got a problum'.mysqli_error($conn));