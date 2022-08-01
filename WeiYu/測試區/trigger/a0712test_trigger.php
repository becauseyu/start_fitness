<?php
// 1. 會員新增

DELIMITER $$ 
CREATE TRIGGER tr_log_member_insert
AFTER INSERT ON member FOR EACH ROW
BEGIN
    SET @body = concat('新增會員，帳號 : ', new.account);
    INSERT INTO log(body) VALUES(@body);
END $$
DELIMITER ;

// // 2. 會員修該

// DELIMITER $$
// CREATE TRIGGER tr_log_userinfo_update
// after update ON member FOR EACH ROW
// BEGIN
//     SET @body = concat('會員資料被修改，帳號 : ', old.account);
//     INSERT INTO log(body) VALUES(@body);
// end $$
// DELIMITER ;


// // 3. 會員不能被更動

// DELIMITER $$
// CREATE TRIGGER tr_log_userinfo_no_update_id_account
// before update ON member FOR EACH ROW
// BEGIN
//     if  (old.id <> new.id) or (old.account <> new.account) or (old.permission <> new.permission) then
//     signal sqlstate '45001' set message_text = '會員帳號及id不能被修改';
// end if;
// end $$
// DELIMITER ;


// // 4. 







?>