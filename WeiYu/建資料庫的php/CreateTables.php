<?php
// this data is from Maria
// 如果還沒建database 需要先建一下
include_once('./CreateDatabase.php');


// login database
include_once('./mysqli_root.php');

// how to use this ?
// 1. require or include , then type function name below
// 2. just open this file by apache, then cacel the comment below




// 目前合計有 12 張table
create_inbody_table($mysqli);
create_taichung_gym_table($mysqli);
create_tmember_table($mysqli);
create_statusdetail_table($mysqli);
create_goodsdetail_table($mysqli);
create_branddetail_table($mysqli);
create_memberorder_table($mysqli);
create_payment_table($mysqli);
create_deliver_table($mysqli);
create_orderdetail_table($mysqli);
create_orderstatusdetail_table($mysqli);
create_log_table($mysqli);

// 內容物待確認
// create_article_table($mysqli);

// 其中 5 個有預設值 
insert_statusdetail_default($mysqli);
insert_branddetail_default($mysqli);
insert_payment_default($mysqli);
insert_deliver_default($mysqli);
insert_orderstatusdetail_default($mysqli);





//--------------------------------以下 function 維護區-------------------------------//




// create inbody table
function create_inbody_table($mysqli) {
    $sql = "CREATE TABLE IF NOT EXISTS `inbody` (
    `id` INT NOT NULL AUTO_INCREMENT ,
    `name` VARCHAR(100) NOT NULL , 
    `tel` VARCHAR(100) NOT NULL , 
    `email` VARCHAR(256) NOT NULL , 
    `gym` VARCHAR(100) NOT NULL , 
    `date` DATE NOT NULL , 
    `time` TIME NOT NULL , 
    PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $result = $mysqli->query($sql);
    if ($result) { echo 'table inbody is created';}else{echo 'Have error when create table inbody, or it is exist';};
    echo "<br / > \n";
}


// taichung_gym_table
function create_taichung_gym_table($mysqli) {
    $sql = "CREATE TABLE IF NOT EXISTS `taichung_gym` (
    `id` INT NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(100) NOT NULL , 
    `town` VARCHAR(100) NOT NULL , 
    `addr` VARCHAR(100) NOT NULL , 
    `open` VARCHAR(100) NOT NULL , 
    `tel` VARCHAR(100) NOT NULL , 
    `lon` VARCHAR(100) NOT NULL , 
    `lat` VARCHAR(100) NOT NULL , 
    `pic` VARCHAR(256) NOT NULL , 
    `intr` VARCHAR(256) NOT NULL , 
    `res` INT NOT NULL , 
    PRIMARY KEY (`id`)) ENGINE = InnoDB;";
$result = $mysqli->query($sql);
if ($result) { echo 'table taichung_gym is created';}else{echo 'Have error when create table taichung_gym, or it is exist';};
echo "<br / > \n";
}


// create table member
function create_tmember_table($mysqli) {
    $sql = "CREATE TABLE IF NOT EXISTS `member` (
    `mid` INT NOT NULL AUTO_INCREMENT,
    `account` VARCHAR(100) NOT NULL , 
    `psw` VARCHAR(100) NOT NULL , 
    `name` VARCHAR(100) NOT NULL , 
    `email` VARCHAR(100) NOT NULL , 
    `tel` VARCHAR(100) NOT NULL DEFAULT '' , 
    `point` INT NOT NULL DEFAULT '0' , 
    `staId` TINYINT NOT NULL DEFAULT '1' , 
    PRIMARY KEY (`mid`), UNIQUE (`account`)) ENGINE = InnoDB;";
$result = $mysqli->query($sql);
if ($result) { echo 'table member is created';}else{echo 'Have error when create table member, or it is exist';};
echo "<br / > \n";
}


// create statusdetail table
function create_statusdetail_table($mysqli){
    $sql = "CREATE TABLE IF NOT EXISTS `statusdetail` (
    `staId` INT NOT NULL AUTO_INCREMENT , 
    `staName` VARCHAR(100) NOT NULL , 
    PRIMARY KEY (`staId`)) ENGINE = InnoDB;";
    $result = $mysqli->query($sql);
    if ($result) { echo 'table statusdetail is created';}else{echo 'Have error when create table statusdetail, or it is exist';};
    echo "<br / > \n";
}

// insert statusdetail default
function insert_statusdetail_default($mysqli) {
    $sql = "TRUNCATE  `statusdetail`;";
    $result = $mysqli->query($sql);
    if ($result) { echo 'table statusdetail now empty';}else{echo 'Have error when truncate statusdetail, maybe it is not exist.'; return;};
    echo "<br / > \n";
    $sql = "INSERT INTO statusdetail(staName)VALUES ('會員未開通'),('會員已開通'),('管理員'),('停權');";
    $result = $mysqli->query($sql);
    if ($result) { echo 'table statusdetail is inserted default value';}else{echo 'Have error when insert statusdetail.';};
    echo "<br / > \n";
}


// create goodsdetail table
function create_goodsdetail_table($mysqli) {
    $sql = "CREATE TABLE IF NOT EXISTS `goodsdetail` (
    `pid` INT NOT NULL AUTO_INCREMENT , 
    `ptype` VARCHAR(100) NOT NULL , 
    `bid` INT NOT NULL , 
    `pstyle` VARCHAR(100) NOT NULL , 
    `pname` VARCHAR(128) NOT NULL , 
    `pcount` INT NOT NULL,
    `ppic` VARCHAR(128) NOT NULL,
    `pprice` INT NOT NULL ,
    `staid` SMALLINT NOT NULL DEFAULT 1,
    PRIMARY KEY (`pid`)) ENGINE = InnoDB;";
    $result = $mysqli->query($sql);
    if ($result) { echo 'table goodsdetail is created';}else{echo 'Have error when create table goodsdetail, or it is exist';};
    echo "<br / > \n";
}


// create branddetail table
function create_branddetail_table($mysqli) {
    $sql = "CREATE TABLE IF NOT EXISTS `branddetail` (
    `bid` INT NOT NULL AUTO_INCREMENT , 
    `bname` VARCHAR(100) NOT NULL , 
    PRIMARY KEY (`bid`)) ENGINE = InnoDB;";
    $result = $mysqli->query($sql);
    if ($result) { echo 'table branddetail is created';}else{echo 'Have error when create table branddetail, or it is exist';};
    echo "<br / > \n";
}


// insert branddetail default
function insert_branddetail_default($mysqli) {
    $sql = "TRUNCATE  `branddetail`;";
    $result = $mysqli->query($sql);
    if ($result) { echo 'table branddetail now empty';}else{echo 'Have error when truncate branddetail, maybe it is not exist.'; return;};
    echo "<br / > \n";
    $sql = "INSERT INTO branddetail(bname)VALUES ('@好味營養師品瑄'),('@Peeta Protein'),
    ('@全能專科'),('@lotusfitness'),
    ('@Myprotein'),('@Blender Bottle®'),
    ('@ArmorLite®'),('@BYZOOM'),('@早安健康嚴選'),('@TACTEL®');";
    $result = $mysqli->query($sql);
    if ($result) { echo 'table branddetail is inserted default value';}else{echo 'Have error when insert branddetail.';};
    echo "<br / > \n";
}



// create memberorder table
function create_memberorder_table($mysqli) {
    $sql = "CREATE TABLE IF NOT EXISTS `memberorder` (
    `oid` INT NOT NULL AUTO_INCREMENT , 
    `mid` VARCHAR(100) NOT NULL , 
    `orderdate` DATETIME NOT NULL, 
    `delAddr` VARCHAR(256) NOT NULL , 
    `delTel` VARCHAR(100) NOT NULL , 
    `delName` VARCHAR(100) NOT NULL , 
    `point` INT NOT NULL DEFAULT '0' , 
    `did` INT NOT NULL , 
    `paid` INT NULL , 
    `memo` VARCHAR(256) NOT NULL , 
    `staid` INT NOT NULL DEFAULT '1',
    `total` VARCHAR(50) NOT NULL ,PRIMARY KEY (`oid`)) ENGINE = InnoDB;";
    $result = $mysqli->query($sql);
    if ($result) { echo 'table memberorder is created';}else{echo 'Have error when create table memberorder, or it is exist';};
    echo "<br / > \n";
}



// create payment table
function create_payment_table($mysqli) {
$sql = "CREATE TABLE IF NOT EXISTS `payment` (
    `paid` INT NOT NULL AUTO_INCREMENT , 
    `payment` VARCHAR(100) NOT NULL , 
    PRIMARY KEY (`paid`)) ENGINE = InnoDB;";
$result = $mysqli->query($sql);
if ($result) { echo 'table payment is created';}else{echo 'Have error when create table payment, or it is exist';};
echo "<br / > \n";
}


// insert payment default
function insert_payment_default($mysqli) {
    $sql = "TRUNCATE  `payment`;";
    $result = $mysqli->query($sql);
    if ($result) { echo 'table payment now empty';}else{echo 'Have error when truncate payment, maybe it is not exist.'; return;};
    echo "<br / > \n";
    $sql = "INSERT INTO payment(payment) VALUES ('貨到付款'), ('信用卡'),('超商代碼'),('虛擬ATM');";
    $result = $mysqli->query($sql);
    if ($result) { echo 'table payment is inserted default value';}else{echo 'Have error when insert payment.';};
    echo "<br / > \n";
}



// create deliver table
function create_deliver_table($mysqli) {
    $sql = "CREATE TABLE IF NOT EXISTS `deliver` (
    `did` INT NOT NULL AUTO_INCREMENT , 
    `deliver` VARCHAR(100) NOT NULL , 
    PRIMARY KEY (`did`)) ENGINE = InnoDB;";
    $result = $mysqli->query($sql);
    if ($result) { echo 'table deliver is created';}else{echo 'Have error when create table deliver, or it is exist';};
    echo "<br / > \n";
}

// insert deliver default
function insert_deliver_default($mysqli) {
    $sql = "TRUNCATE  `deliver`;";
    $result = $mysqli->query($sql);
    if ($result) { echo 'table deliver now empty';}else{echo 'Have error when truncate deliver, maybe it is not exist.'; return;};
    echo "<br / > \n";
    $sql = "INSERT INTO deliver(deliver) VALUES ('新竹物流宅配'),('黑貓宅配'),('711取貨不付款'),('711取貨付款');";
    $result = $mysqli->query($sql);
    if ($result) { echo 'table deliver is inserted default value';}else{echo 'Have error when insert deliver.';};
    echo "<br / > \n";
}



// create orderdetail table
function create_orderdetail_table($mysqli) {
    $sql = "CREATE TABLE IF NOT EXISTS `orderdetail` (
        `opid` INT NOT NULL AUTO_INCREMENT,
        `pid` INT NOT NULL  , 
        `oid` INT NOT NULL , 
        `amount` INT NOT NULL , 
        PRIMARY KEY (`opid`)) ENGINE = InnoDB;";
        $result = $mysqli->query($sql);
    if ($result) { echo 'table orderdetail is created';}else{echo 'Have error when create table orderdetail, or it is exist';};
    echo "<br / > \n";
}



// create orderstatusdetail table
function create_orderstatusdetail_table($mysqli) {
    $sql = "CREATE TABLE IF NOT EXISTS `orderstatusdetail` (
        `ostaid` INT NOT NULL AUTO_INCREMENT , 
        `ostatus` VARCHAR(50) NOT NULL , 
        PRIMARY KEY (`ostaid`)) ENGINE = InnoDB;";
        $result = $mysqli->query($sql);
    if ($result) { echo 'table orderstatusdetail is created';}else{echo 'Have error when create table orderstatusdetail, or it is exist';};
    echo "<br / > \n";
}


// insert orderstatusdetail default
function insert_orderstatusdetail_default($mysqli) {
    $sql = "TRUNCATE  `orderstatusdetail`;";
    $result = $mysqli->query($sql);
    if ($result) { echo 'table orderstatusdetail now empty';}else{echo 'Have error when truncate orderstatusdetail, maybe it is not exist.'; return;};
    echo "<br / > \n";
    $sql = "INSERT INTO orderstatusdetail(ostatus) VALUES ('待確認'),('已確認'),('已完成'),('訂單取消');";
    $result = $mysqli->query($sql);
    if ($result) { echo 'table orderstatusdetail is inserted default value';}else{echo 'Have error when insert orderstatusdetail.';};
    echo "<br / > \n";
}



// create log table
function create_log_table($mysqli) {
$sql = "CREATE TABLE IF NOT EXISTS `log` ( 
    `id` BIGINT NOT NULL AUTO_INCREMENT ,
    `body` VARCHAR(256) NULL ,
    `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, 
     PRIMARY KEY (`id`)) ENGINE = InnoDB;";
$result = $mysqli->query($sql);
if ($result) { echo 'table log is created';}else{echo 'Have error when create table member, or it is exist';};
echo "<br / > \n";
}



// create article table
// 內容物待確認
function create_article_table($mysqli) {
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
}

