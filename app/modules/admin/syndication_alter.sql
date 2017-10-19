ALTER TABLE `coupons`
ADD `syndicated` TINYINT(1) DEFAULT '0' AFTER `expirationDate` ;

ALTER TABLE `coupons`
ADD `shortened` CHAR(32) collate utf8_unicode_ci AFTER `couponCode` ;