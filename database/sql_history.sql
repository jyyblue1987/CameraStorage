# get camera list
SELECT * FROM (`camera`) WHERE `user_id` = '78' AND `is_expire` = 0 AND `payment_id` != 0 ORDER BY `order` ASC