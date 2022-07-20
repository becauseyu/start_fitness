<?php
// login database
include('./mysql.php');

// create table member
$sql = "CREATE TABLE IF NOT EXISTS `member` ( 
       `id` BIGINT NOT NULL AUTO_INCREMENT ,
       `name` VARCHAR(256) NOT NULL ,
       `email` VARCHAR(256) NULL , 
       `tel` VARCHAR(128) NULL , 
       `account` VARCHAR(128) NOT NULL , 
       `password` VARCHAR(256) NOT NULL ,
       `status` BOOLEAN NOT NULL DEFAULT TRUE ,
       `permission` VARCHAR(50) NOT NULL DEFAULT 'member' , 
        PRIMARY KEY (`id`) , UNIQUE (`account`)) ENGINE = InnoDB;";
$result = $mysqli->query($sql);
if ($result) { echo 'table member is created';}else{echo 'Have error when create table member, or it is exist';};
echo "<br / > \n";


// create table log
$sql = "CREATE TABLE IF NOT EXISTS `log` ( 
    `id` BIGINT NOT NULL AUTO_INCREMENT ,
    `body` VARCHAR(256) NULL ,
    `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, 
     PRIMARY KEY (`id`)) ENGINE = InnoDB;";
$result = $mysqli->query($sql);
if ($result) { echo 'table log is created';}else{echo 'Have error when create table member, or it is exist';};
echo "<br / > \n";


// create table product
$sql = "CREATE TABLE IF NOT EXISTS `product` ( 
    `id` BIGINT NOT NULL AUTO_INCREMENT ,
    `name` VARCHAR(256) NOT NULL ,
    `picture` VARCHAR(2048) NULL , 
    `introduction` VARCHAR(128) NULL , 
    `price` INT NULL , 
    `storage` INT NULL ,
    PRIMARY KEY (`id`)) ENGINE = InnoDB;";
$result = $mysqli->query($sql);
if ($result) { echo 'table product is created';}else{echo 'Have error when create table product, or it is exist';};
echo "<br / > \n";



// create table article
$sql = "CREATE TABLE IF NOT EXISTS `article` ( 
    `id` BIGINT NOT NULL AUTO_INCREMENT ,
    `title` VARCHAR(256) NOT NULL ,
    `body` VARCHAR(9000) NULL , 
    `creater` VARCHAR(128) NOT NULL , 
    `finalediter` VARCHAR(128) NULL , 
    `editdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)) ENGINE = InnoDB;";
$result = $mysqli->query($sql);
if ($result) { echo 'table article is created';}else{echo 'Have error when create table article, or it is exist';};
echo "<br / > \n";



$mysqli->close();
?>