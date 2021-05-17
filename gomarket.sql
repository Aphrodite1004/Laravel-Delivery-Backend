/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : gomarket

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2021-05-12 17:19:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) NOT NULL,
  `admin_image` varchar(255) NOT NULL,
  `admin_phone` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'Buruna', 'images/admin/profile/12-05-21/120521125647pm-avatar1_1.png', '0000000000', 'admin@gmail.com', '$2y$10$.sOI9/OUKDrJOyNvFnecCO16nw89ekZ6TIC7.P2NHinRmrkTRpVIS');

-- ----------------------------
-- Table structure for admin_banner
-- ----------------------------
DROP TABLE IF EXISTS `admin_banner`;
CREATE TABLE `admin_banner` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_banner
-- ----------------------------

-- ----------------------------
-- Table structure for area
-- ----------------------------
DROP TABLE IF EXISTS `area`;
CREATE TABLE `area` (
  `area_id` int(11) NOT NULL AUTO_INCREMENT,
  `cityadmin_id` int(255) DEFAULT NULL,
  `area_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `delivery_charge` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of area
-- ----------------------------

-- ----------------------------
-- Table structure for assign_homecat
-- ----------------------------
DROP TABLE IF EXISTS `assign_homecat`;
CREATE TABLE `assign_homecat` (
  `assign_id` int(200) NOT NULL AUTO_INCREMENT,
  `homecat_id` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_id` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`assign_id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of assign_homecat
-- ----------------------------

-- ----------------------------
-- Table structure for banner
-- ----------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `cityadmin_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bannerloc_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `vendor_id` int(11) NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of banner
-- ----------------------------

-- ----------------------------
-- Table structure for banner_resturant
-- ----------------------------
DROP TABLE IF EXISTS `banner_resturant`;
CREATE TABLE `banner_resturant` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of banner_resturant
-- ----------------------------

-- ----------------------------
-- Table structure for cancel_for
-- ----------------------------
DROP TABLE IF EXISTS `cancel_for`;
CREATE TABLE `cancel_for` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`res_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cancel_for
-- ----------------------------

-- ----------------------------
-- Table structure for cancel_reason
-- ----------------------------
DROP TABLE IF EXISTS `cancel_reason`;
CREATE TABLE `cancel_reason` (
  `reason_id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`reason_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cancel_reason
-- ----------------------------

-- ----------------------------
-- Table structure for cart
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `cart_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cartref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `varient_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cart
-- ----------------------------

-- ----------------------------
-- Table structure for cash_collect
-- ----------------------------
DROP TABLE IF EXISTS `cash_collect`;
CREATE TABLE `cash_collect` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_collection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_boy_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n/a',
  `no_of_orders` int(11) NOT NULL DEFAULT 0,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cart_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=365 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cash_collect
-- ----------------------------

-- ----------------------------
-- Table structure for city
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(255) NOT NULL,
  `city_name_arabic` varchar(255) CHARACTER SET utf8 NOT NULL,
  `city_image` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL DEFAULT 'N/A',
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of city
-- ----------------------------
INSERT INTO `city` VALUES ('26', 'my town', 'أدخل العنوان', 'city/images/12-05-2021/120521013921pm-black_car_running_1920x1080-2.jpg', '37.4117936', '-94.7032033', '12-05-2021 01:39 pm', 'N/A');
INSERT INTO `city` VALUES ('28', 'Tempe Town Lake, Tempe, AZ, USA', 'أدخل العنوان أدخل أدخل', 'city/images/12-05-2021/120521025552pm-black_car_running_1920x1080-2.jpg', '33.4316776', '-111.9276565', '12-05-2021 02:55 pm', 'N/A');

-- ----------------------------
-- Table structure for cityadmin
-- ----------------------------
DROP TABLE IF EXISTS `cityadmin`;
CREATE TABLE `cityadmin` (
  `cityadmin_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cityadmin_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cityadmin_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cityadmin_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cityadmin_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cityadmin_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cityadmin_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n/a',
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  PRIMARY KEY (`cityadmin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cityadmin
-- ----------------------------

-- ----------------------------
-- Table structure for cityadmin_cat
-- ----------------------------
DROP TABLE IF EXISTS `cityadmin_cat`;
CREATE TABLE `cityadmin_cat` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cityadmin_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n/a',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cityadmin_cat
-- ----------------------------

-- ----------------------------
-- Table structure for comission
-- ----------------------------
DROP TABLE IF EXISTS `comission`;
CREATE TABLE `comission` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` date NOT NULL,
  `total_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comission_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cart_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`com_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of comission
-- ----------------------------

-- ----------------------------
-- Table structure for complains
-- ----------------------------
DROP TABLE IF EXISTS `complains`;
CREATE TABLE `complains` (
  `complain_id` int(11) NOT NULL AUTO_INCREMENT,
  `complain_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`complain_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of complains
-- ----------------------------

-- ----------------------------
-- Table structure for completed_orders
-- ----------------------------
DROP TABLE IF EXISTS `completed_orders`;
CREATE TABLE `completed_orders` (
  `completed_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cart_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_boy_incentive` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_boy_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`completed_id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of completed_orders
-- ----------------------------

-- ----------------------------
-- Table structure for country_code
-- ----------------------------
DROP TABLE IF EXISTS `country_code`;
CREATE TABLE `country_code` (
  `code_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_limit` int(11) NOT NULL,
  PRIMARY KEY (`code_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of country_code
-- ----------------------------
INSERT INTO `country_code` VALUES ('1', '+91', '10');

-- ----------------------------
-- Table structure for coupon
-- ----------------------------
DROP TABLE IF EXISTS `coupon`;
CREATE TABLE `coupon` (
  `coupon_id` int(100) NOT NULL AUTO_INCREMENT,
  `coupon_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `cart_value` int(100) NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uses_restriction` int(11) NOT NULL DEFAULT 1,
  `vendor_id` int(11) NOT NULL,
  PRIMARY KEY (`coupon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of coupon
-- ----------------------------

-- ----------------------------
-- Table structure for currency
-- ----------------------------
DROP TABLE IF EXISTS `currency`;
CREATE TABLE `currency` (
  `currency_id` int(11) NOT NULL AUTO_INCREMENT,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_sign` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`currency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of currency
-- ----------------------------
INSERT INTO `currency` VALUES ('1', 'Euro', '€');

-- ----------------------------
-- Table structure for deal_product
-- ----------------------------
DROP TABLE IF EXISTS `deal_product`;
CREATE TABLE `deal_product` (
  `deal_id` int(11) NOT NULL AUTO_INCREMENT,
  `varient_id` int(11) NOT NULL,
  `deal_price` float NOT NULL,
  `valid_from` date NOT NULL,
  `valid_to` date NOT NULL,
  `status` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  PRIMARY KEY (`deal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of deal_product
-- ----------------------------

-- ----------------------------
-- Table structure for delivery_boy
-- ----------------------------
DROP TABLE IF EXISTS `delivery_boy`;
CREATE TABLE `delivery_boy` (
  `delivery_boy_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_boy_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_boy_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_boy_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_boy_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `lng` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `device_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `delivery_boy_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'online',
  `is_confirmed` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_verify` int(100) NOT NULL DEFAULT 0,
  `cityadmin_id` int(11) DEFAULT NULL,
  `dboy_comission` int(11) DEFAULT NULL,
  PRIMARY KEY (`delivery_boy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of delivery_boy
-- ----------------------------

-- ----------------------------
-- Table structure for delivery_boy_area
-- ----------------------------
DROP TABLE IF EXISTS `delivery_boy_area`;
CREATE TABLE `delivery_boy_area` (
  `delivery_boy_area_id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_boy_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`delivery_boy_area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=226 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of delivery_boy_area
-- ----------------------------

-- ----------------------------
-- Table structure for delivery_boy_comission
-- ----------------------------
DROP TABLE IF EXISTS `delivery_boy_comission`;
CREATE TABLE `delivery_boy_comission` (
  `dboy_comission_id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_boy_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `order_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comission_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cart_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`dboy_comission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of delivery_boy_comission
-- ----------------------------

-- ----------------------------
-- Table structure for delivery_boy_vendor
-- ----------------------------
DROP TABLE IF EXISTS `delivery_boy_vendor`;
CREATE TABLE `delivery_boy_vendor` (
  `delivery_boy_vendor_id` int(10) NOT NULL AUTO_INCREMENT,
  `delivery_boy_id` int(10) NOT NULL,
  `vendor_id` int(10) NOT NULL,
  PRIMARY KEY (`delivery_boy_vendor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of delivery_boy_vendor
-- ----------------------------

-- ----------------------------
-- Table structure for delivery_timing
-- ----------------------------
DROP TABLE IF EXISTS `delivery_timing`;
CREATE TABLE `delivery_timing` (
  `delivery_timing_id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_timing_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_time_slot` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`delivery_timing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of delivery_timing
-- ----------------------------

-- ----------------------------
-- Table structure for destination_address
-- ----------------------------
DROP TABLE IF EXISTS `destination_address`;
CREATE TABLE `destination_address` (
  `destination_address_id` int(11) NOT NULL AUTO_INCREMENT,
  `destination_pincode` int(11) NOT NULL,
  `destination_houseno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_landmark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_add` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination_lng` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination_phone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`destination_address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of destination_address
-- ----------------------------

-- ----------------------------
-- Table structure for faq
-- ----------------------------
DROP TABLE IF EXISTS `faq`;
CREATE TABLE `faq` (
  `faq_id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`faq_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of faq
-- ----------------------------
INSERT INTO `faq` VALUES ('2', 'How to subscribe a product ?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less.');

-- ----------------------------
-- Table structure for fcm_key
-- ----------------------------
DROP TABLE IF EXISTS `fcm_key`;
CREATE TABLE `fcm_key` (
  `unique_id` int(200) NOT NULL AUTO_INCREMENT,
  `user_app_key` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_app_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dboy_app_key` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`unique_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of fcm_key
-- ----------------------------
INSERT INTO `fcm_key` VALUES ('1', 'AAAAA7cZdjY:APA91bEbjOcDMkaWK8LKZgE-cLQ1r59ScMj2z_9Ltm7hX1am1BtUeMcXisvvuBPNsrrPLe2vT8xi_xsM1tXi1QJxeOigV8668X5DCd-jpu6B7xzxMnygQFeLNATcwrgc-E4hJTkXiL86', 'AAAAsMc8tIA:APA91bGRMglAYrAkoLIkt4ZfENWcnKPkrxD7ODxxCaW0taPN6GYjcOA04RSSPPNIYdc0OdQp1yDpDU5-O88N-ARy2h8pJPfBu91DSx-nru5xO-qQwsmF1cE8gkxw7cb8mLFMqYF7Y-y7', 'AAAAmgTjGYw:APA91bFf-_iPWQ5_jMQHBX6ysjPZ1UFQsLFMF1ztuMcZGPdGxJ77Ki46_vCsJu-dM38LU3UqY_AGQMykttsIw3NNsSouQfGTDCz-QV2Fww6k6ovUUSYjhMbNZ9GwIFHWaNzrdzQJHmqT');

-- ----------------------------
-- Table structure for firebase
-- ----------------------------
DROP TABLE IF EXISTS `firebase`;
CREATE TABLE `firebase` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of firebase
-- ----------------------------
INSERT INTO `firebase` VALUES ('1', '0');

-- ----------------------------
-- Table structure for first_wallet_recharge
-- ----------------------------
DROP TABLE IF EXISTS `first_wallet_recharge`;
CREATE TABLE `first_wallet_recharge` (
  `deal_id` int(11) NOT NULL AUTO_INCREMENT,
  `min_wallet_recharge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `free_for` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`deal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of first_wallet_recharge
-- ----------------------------

-- ----------------------------
-- Table structure for holiday
-- ----------------------------
DROP TABLE IF EXISTS `holiday`;
CREATE TABLE `holiday` (
  `holiday_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `holiday` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`holiday_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of holiday
-- ----------------------------

-- ----------------------------
-- Table structure for homecat
-- ----------------------------
DROP TABLE IF EXISTS `homecat`;
CREATE TABLE `homecat` (
  `homecat_id` int(200) NOT NULL AUTO_INCREMENT,
  `homecat_name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `homecat_status` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cityadmin_id` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`homecat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of homecat
-- ----------------------------

-- ----------------------------
-- Table structure for incentive
-- ----------------------------
DROP TABLE IF EXISTS `incentive`;
CREATE TABLE `incentive` (
  `incentive_id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_boy_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_incentive` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_incentive` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remaining_incentive` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`incentive_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of incentive
-- ----------------------------
INSERT INTO `incentive` VALUES ('1', '22', '95', '120', '-25');
INSERT INTO `incentive` VALUES ('2', '26', '62', '50', '12');
INSERT INTO `incentive` VALUES ('3', '27', '75', '50', '25');
INSERT INTO `incentive` VALUES ('4', '41', '0', '0', '0');

-- ----------------------------
-- Table structure for incentive_amount
-- ----------------------------
DROP TABLE IF EXISTS `incentive_amount`;
CREATE TABLE `incentive_amount` (
  `incentive_amount_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_boy_incentive` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `cityadmin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`incentive_amount_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of incentive_amount
-- ----------------------------
INSERT INTO `incentive_amount` VALUES ('1', '1', '20', '0');
INSERT INTO `incentive_amount` VALUES ('2', '8', '0', '0');
INSERT INTO `incentive_amount` VALUES ('3', '9', '0', '0');
INSERT INTO `incentive_amount` VALUES ('4', '5', '0', '0');
INSERT INTO `incentive_amount` VALUES ('6', '6', '10', null);
INSERT INTO `incentive_amount` VALUES ('8', '7', '10', null);
INSERT INTO `incentive_amount` VALUES ('9', null, '0', '11');
INSERT INTO `incentive_amount` VALUES ('10', null, '0', '11');
INSERT INTO `incentive_amount` VALUES ('11', null, '0', '12');
INSERT INTO `incentive_amount` VALUES ('12', null, '0', '12');
INSERT INTO `incentive_amount` VALUES ('13', null, '0', '13');
INSERT INTO `incentive_amount` VALUES ('14', null, '0', '14');
INSERT INTO `incentive_amount` VALUES ('15', null, '0', '15');
INSERT INTO `incentive_amount` VALUES ('16', null, '0', '16');
INSERT INTO `incentive_amount` VALUES ('17', null, '0', '17');

-- ----------------------------
-- Table structure for list_cart
-- ----------------------------
DROP TABLE IF EXISTS `list_cart`;
CREATE TABLE `list_cart` (
  `l_cid` int(11) NOT NULL AUTO_INCREMENT,
  `l_vid` int(11) NOT NULL,
  `l_qty` int(11) NOT NULL,
  `l_uid` int(11) NOT NULL,
  `ord_by_photo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`l_cid`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of list_cart
-- ----------------------------

-- ----------------------------
-- Table structure for logo
-- ----------------------------
DROP TABLE IF EXISTS `logo`;
CREATE TABLE `logo` (
  `logo_id` int(11) NOT NULL AUTO_INCREMENT,
  `logo_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`logo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of logo
-- ----------------------------
INSERT INTO `logo` VALUES ('1', 'GoMarket', 'logo/image/23-08-19/230819124541pm-milk-subscription.png');

-- ----------------------------
-- Table structure for mapbox
-- ----------------------------
DROP TABLE IF EXISTS `mapbox`;
CREATE TABLE `mapbox` (
  `map_id` int(11) NOT NULL AUTO_INCREMENT,
  `mapbox_api` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`map_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of mapbox
-- ----------------------------
INSERT INTO `mapbox` VALUES ('1', 'pk.eyJ1IjoidGVjbWasdfasdfFuaWMiLCJhIjoiY2tlbDN4MjIxMGl0bTJxbndybWI5NDI1dfghjbgvfchjbgvhjbgvhj');

-- ----------------------------
-- Table structure for map_api
-- ----------------------------
DROP TABLE IF EXISTS `map_api`;
CREATE TABLE `map_api` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `map_api_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of map_api
-- ----------------------------
INSERT INTO `map_api` VALUES ('1', 'AIzaSyDP0N5SbZSO4BMr2alarZTtVi1rcZAcw5E');

-- ----------------------------
-- Table structure for map_settings
-- ----------------------------
DROP TABLE IF EXISTS `map_settings`;
CREATE TABLE `map_settings` (
  `map_id` int(11) NOT NULL AUTO_INCREMENT,
  `mapbox` int(11) NOT NULL,
  `google_map` int(11) NOT NULL,
  PRIMARY KEY (`map_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of map_settings
-- ----------------------------
INSERT INTO `map_settings` VALUES ('1', '0', '1');

-- ----------------------------
-- Table structure for msg91
-- ----------------------------
DROP TABLE IF EXISTS `msg91`;
CREATE TABLE `msg91` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of msg91
-- ----------------------------
INSERT INTO `msg91` VALUES ('1', 'GoMarket', 'Place your Key', '1');

-- ----------------------------
-- Table structure for notificationby
-- ----------------------------
DROP TABLE IF EXISTS `notificationby`;
CREATE TABLE `notificationby` (
  `n_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sms` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=466 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of notificationby
-- ----------------------------

-- ----------------------------
-- Table structure for not_accepted
-- ----------------------------
DROP TABLE IF EXISTS `not_accepted`;
CREATE TABLE `not_accepted` (
  `not_accepted_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cart_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_boy_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`not_accepted_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of not_accepted
-- ----------------------------
INSERT INTO `not_accepted` VALUES ('24', '220', 'c8415', '41', '15-03-2020', '2020-02-26 13:52:43');
INSERT INTO `not_accepted` VALUES ('25', '220', 'c8415', '41', '18-03-2020', '2020-02-26 14:03:26');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `cart_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` float NOT NULL,
  `price_without_delivery` float NOT NULL,
  `total_products_mrp` float NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_by_wallet` float NOT NULL DEFAULT 0,
  `rem_price` float NOT NULL DEFAULT 0,
  `order_date` date NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `delivery_charge` float NOT NULL DEFAULT 0,
  `time_slot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dboy_id` int(11) NOT NULL DEFAULT 0,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `user_signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelling_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_id` int(11) NOT NULL DEFAULT 0,
  `coupon_discount` float NOT NULL DEFAULT 0,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_by_store` int(11) NOT NULL DEFAULT 0,
  `canceled_at` datetime DEFAULT NULL,
  `dboy_incentive` float NOT NULL,
  `ui_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=785 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of orders
-- ----------------------------

-- ----------------------------
-- Table structure for order_by_photo
-- ----------------------------
DROP TABLE IF EXISTS `order_by_photo`;
CREATE TABLE `order_by_photo` (
  `ord_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `list_photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `store_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `delivery_date` date NOT NULL,
  `processed` int(11) NOT NULL DEFAULT 0,
  `reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_slot` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ord_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of order_by_photo
-- ----------------------------

-- ----------------------------
-- Table structure for order_complains
-- ----------------------------
DROP TABLE IF EXISTS `order_complains`;
CREATE TABLE `order_complains` (
  `order_complain_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complain_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_boy_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `settled_amt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_complain_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of order_complains
-- ----------------------------

-- ----------------------------
-- Table structure for order_details
-- ----------------------------
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details` (
  `store_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `varient_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float DEFAULT NULL,
  `total_mrp` float NOT NULL,
  `order_cart_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` datetime NOT NULL,
  `varient_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addon_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addon_id` int(11) NOT NULL DEFAULT 0,
  `addon_price` float NOT NULL,
  PRIMARY KEY (`store_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1599 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of order_details
-- ----------------------------

-- ----------------------------
-- Table structure for parcel_banner
-- ----------------------------
DROP TABLE IF EXISTS `parcel_banner`;
CREATE TABLE `parcel_banner` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `cityadmin_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bannerloc_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `vendor_id` int(11) NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of parcel_banner
-- ----------------------------

-- ----------------------------
-- Table structure for parcel_category
-- ----------------------------
DROP TABLE IF EXISTS `parcel_category`;
CREATE TABLE `parcel_category` (
  `parcel_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` int(11) NOT NULL,
  PRIMARY KEY (`parcel_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of parcel_category
-- ----------------------------

-- ----------------------------
-- Table structure for parcel_charges
-- ----------------------------
DROP TABLE IF EXISTS `parcel_charges`;
CREATE TABLE `parcel_charges` (
  `charge_id` int(100) NOT NULL AUTO_INCREMENT,
  `city_from` int(11) NOT NULL,
  `city_to` int(11) DEFAULT NULL,
  `parcel_charge` int(11) NOT NULL,
  `charge_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`charge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of parcel_charges
-- ----------------------------

-- ----------------------------
-- Table structure for parcel_city
-- ----------------------------
DROP TABLE IF EXISTS `parcel_city`;
CREATE TABLE `parcel_city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(255) NOT NULL,
  `city_image` varchar(255) NOT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `vendor_id` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL DEFAULT 'N/A',
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of parcel_city
-- ----------------------------

-- ----------------------------
-- Table structure for parcel_delivery_boy
-- ----------------------------
DROP TABLE IF EXISTS `parcel_delivery_boy`;
CREATE TABLE `parcel_delivery_boy` (
  `delivery_boy_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_boy_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_boy_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_boy_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_boy_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `lng` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `device_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `delivery_boy_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'online',
  `is_confirmed` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `otp` int(100) DEFAULT NULL,
  `phone_verify` int(100) NOT NULL DEFAULT 0,
  `cityadmin_id` int(11) DEFAULT NULL,
  `dboy_comission` int(11) DEFAULT NULL,
  PRIMARY KEY (`delivery_boy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of parcel_delivery_boy
-- ----------------------------

-- ----------------------------
-- Table structure for parcel_delivery_boy_area
-- ----------------------------
DROP TABLE IF EXISTS `parcel_delivery_boy_area`;
CREATE TABLE `parcel_delivery_boy_area` (
  `delivery_boy_area_id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_boy_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`delivery_boy_area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of parcel_delivery_boy_area
-- ----------------------------

-- ----------------------------
-- Table structure for parcel_details
-- ----------------------------
DROP TABLE IF EXISTS `parcel_details`;
CREATE TABLE `parcel_details` (
  `parcel_id` int(11) NOT NULL AUTO_INCREMENT,
  `source_address_id` int(11) NOT NULL,
  `destination_address_id` int(11) NOT NULL,
  `cart_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) NOT NULL,
  `vendor_id` int(10) NOT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `length` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `height` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `width` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pickup_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pickup_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(10) NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `charges` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dboy_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rem_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`parcel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of parcel_details
-- ----------------------------

-- ----------------------------
-- Table structure for paymentvia
-- ----------------------------
DROP TABLE IF EXISTS `paymentvia`;
CREATE TABLE `paymentvia` (
  `paymentvia_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `payment_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`paymentvia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of paymentvia
-- ----------------------------
INSERT INTO `paymentvia` VALUES ('4', 'Razor Pay', '1', 'rzp_test_7fnnn7WTaard4h');

-- ----------------------------
-- Table structure for payment_currency
-- ----------------------------
DROP TABLE IF EXISTS `payment_currency`;
CREATE TABLE `payment_currency` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of payment_currency
-- ----------------------------
INSERT INTO `payment_currency` VALUES ('CAD', 'CAD');
INSERT INTO `payment_currency` VALUES ('HKD', 'HKD');
INSERT INTO `payment_currency` VALUES ('ISK', 'ISK');
INSERT INTO `payment_currency` VALUES ('PHP', 'PHP');
INSERT INTO `payment_currency` VALUES ('DKK', 'DKK');
INSERT INTO `payment_currency` VALUES ('HUF', 'HUF');
INSERT INTO `payment_currency` VALUES ('CZK', 'CZK');
INSERT INTO `payment_currency` VALUES ('GBP', 'GBP');
INSERT INTO `payment_currency` VALUES ('RON', 'RON');
INSERT INTO `payment_currency` VALUES ('SEK', 'SEK');
INSERT INTO `payment_currency` VALUES ('IDR', 'IDR');
INSERT INTO `payment_currency` VALUES ('INR', 'INR');
INSERT INTO `payment_currency` VALUES ('BRL', 'BRL');
INSERT INTO `payment_currency` VALUES ('RUB', 'RUB');
INSERT INTO `payment_currency` VALUES ('HRK', 'HRK');
INSERT INTO `payment_currency` VALUES ('JPY', 'JPY');
INSERT INTO `payment_currency` VALUES ('THB', 'THB');
INSERT INTO `payment_currency` VALUES ('CHF', 'CHF');
INSERT INTO `payment_currency` VALUES ('EUR', 'EUR');
INSERT INTO `payment_currency` VALUES ('MYR', 'MYR');
INSERT INTO `payment_currency` VALUES ('BGN', 'BGN');
INSERT INTO `payment_currency` VALUES ('TRY', 'TRY');
INSERT INTO `payment_currency` VALUES ('CNY', 'CNY');
INSERT INTO `payment_currency` VALUES ('NOK', 'NOK');
INSERT INTO `payment_currency` VALUES ('NZD', 'NZD');
INSERT INTO `payment_currency` VALUES ('ZAR', 'ZAR');
INSERT INTO `payment_currency` VALUES ('USD', 'USD');
INSERT INTO `payment_currency` VALUES ('MXN', 'MXN');
INSERT INTO `payment_currency` VALUES ('SGD', 'SGD');
INSERT INTO `payment_currency` VALUES ('AUD', 'AUD');
INSERT INTO `payment_currency` VALUES ('ILS', 'ILS');
INSERT INTO `payment_currency` VALUES ('KRW', 'KRW');
INSERT INTO `payment_currency` VALUES ('PLN', 'PLN');
INSERT INTO `payment_currency` VALUES ('CAD', 'CAD');
INSERT INTO `payment_currency` VALUES ('HKD', 'HKD');
INSERT INTO `payment_currency` VALUES ('ISK', 'ISK');
INSERT INTO `payment_currency` VALUES ('PHP', 'PHP');
INSERT INTO `payment_currency` VALUES ('DKK', 'DKK');
INSERT INTO `payment_currency` VALUES ('HUF', 'HUF');
INSERT INTO `payment_currency` VALUES ('CZK', 'CZK');
INSERT INTO `payment_currency` VALUES ('GBP', 'GBP');
INSERT INTO `payment_currency` VALUES ('RON', 'RON');
INSERT INTO `payment_currency` VALUES ('SEK', 'SEK');
INSERT INTO `payment_currency` VALUES ('IDR', 'IDR');
INSERT INTO `payment_currency` VALUES ('INR', 'INR');
INSERT INTO `payment_currency` VALUES ('BRL', 'BRL');
INSERT INTO `payment_currency` VALUES ('RUB', 'RUB');
INSERT INTO `payment_currency` VALUES ('HRK', 'HRK');
INSERT INTO `payment_currency` VALUES ('JPY', 'JPY');
INSERT INTO `payment_currency` VALUES ('THB', 'THB');
INSERT INTO `payment_currency` VALUES ('CHF', 'CHF');
INSERT INTO `payment_currency` VALUES ('EUR', 'EUR');
INSERT INTO `payment_currency` VALUES ('MYR', 'MYR');
INSERT INTO `payment_currency` VALUES ('BGN', 'BGN');
INSERT INTO `payment_currency` VALUES ('TRY', 'TRY');
INSERT INTO `payment_currency` VALUES ('CNY', 'CNY');
INSERT INTO `payment_currency` VALUES ('NOK', 'NOK');
INSERT INTO `payment_currency` VALUES ('NZD', 'NZD');
INSERT INTO `payment_currency` VALUES ('ZAR', 'ZAR');
INSERT INTO `payment_currency` VALUES ('USD', 'USD');
INSERT INTO `payment_currency` VALUES ('MXN', 'MXN');
INSERT INTO `payment_currency` VALUES ('SGD', 'SGD');
INSERT INTO `payment_currency` VALUES ('AUD', 'AUD');
INSERT INTO `payment_currency` VALUES ('ILS', 'ILS');
INSERT INTO `payment_currency` VALUES ('KRW', 'KRW');
INSERT INTO `payment_currency` VALUES ('PLN', 'PLN');

-- ----------------------------
-- Table structure for payout_notification
-- ----------------------------
DROP TABLE IF EXISTS `payout_notification`;
CREATE TABLE `payout_notification` (
  `payout_notification_id` int(10) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(10) NOT NULL,
  `vendor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_by_admin` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`payout_notification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of payout_notification
-- ----------------------------

-- ----------------------------
-- Table structure for pharmacy_banner
-- ----------------------------
DROP TABLE IF EXISTS `pharmacy_banner`;
CREATE TABLE `pharmacy_banner` (
  `banner_id` int(10) NOT NULL AUTO_INCREMENT,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pharmacy_banner
-- ----------------------------

-- ----------------------------
-- Table structure for pharmacy_cart
-- ----------------------------
DROP TABLE IF EXISTS `pharmacy_cart`;
CREATE TABLE `pharmacy_cart` (
  `cart_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cartref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `varient_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pharmacy_cart
-- ----------------------------

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `subcat_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) NOT NULL DEFAULT 'N/A',
  `vendor_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product
-- ----------------------------

-- ----------------------------
-- Table structure for product_varient
-- ----------------------------
DROP TABLE IF EXISTS `product_varient`;
CREATE TABLE `product_varient` (
  `varient_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `strick_price` float DEFAULT NULL,
  `price` float NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `varient_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`varient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of product_varient
-- ----------------------------

-- ----------------------------
-- Table structure for reedem_values
-- ----------------------------
DROP TABLE IF EXISTS `reedem_values`;
CREATE TABLE `reedem_values` (
  `reedem_id` int(100) NOT NULL AUTO_INCREMENT,
  `reward_point` int(100) NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`reedem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of reedem_values
-- ----------------------------
INSERT INTO `reedem_values` VALUES ('1', '10', '1');

-- ----------------------------
-- Table structure for restaurant_addons
-- ----------------------------
DROP TABLE IF EXISTS `restaurant_addons`;
CREATE TABLE `restaurant_addons` (
  `addon_id` int(11) NOT NULL AUTO_INCREMENT,
  `addon_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addon_price` float NOT NULL,
  `product_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  PRIMARY KEY (`addon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of restaurant_addons
-- ----------------------------

-- ----------------------------
-- Table structure for resturant_category
-- ----------------------------
DROP TABLE IF EXISTS `resturant_category`;
CREATE TABLE `resturant_category` (
  `resturant_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` int(11) NOT NULL,
  PRIMARY KEY (`resturant_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of resturant_category
-- ----------------------------

-- ----------------------------
-- Table structure for resturant_deal_product
-- ----------------------------
DROP TABLE IF EXISTS `resturant_deal_product`;
CREATE TABLE `resturant_deal_product` (
  `deal_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_price` float NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`deal_product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of resturant_deal_product
-- ----------------------------

-- ----------------------------
-- Table structure for resturant_product
-- ----------------------------
DROP TABLE IF EXISTS `resturant_product`;
CREATE TABLE `resturant_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `subcat_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` int(11) NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of resturant_product
-- ----------------------------

-- ----------------------------
-- Table structure for resturant_variant
-- ----------------------------
DROP TABLE IF EXISTS `resturant_variant`;
CREATE TABLE `resturant_variant` (
  `variant_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `strick_price` float NOT NULL,
  `price` float NOT NULL,
  `vendor_id` int(11) NOT NULL,
  PRIMARY KEY (`variant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of resturant_variant
-- ----------------------------

-- ----------------------------
-- Table structure for reward_history
-- ----------------------------
DROP TABLE IF EXISTS `reward_history`;
CREATE TABLE `reward_history` (
  `reward_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` float NOT NULL,
  `reward_points` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`reward_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of reward_history
-- ----------------------------

-- ----------------------------
-- Table structure for reward_points
-- ----------------------------
DROP TABLE IF EXISTS `reward_points`;
CREATE TABLE `reward_points` (
  `reward_id` int(100) NOT NULL AUTO_INCREMENT,
  `min_cart_value` int(100) NOT NULL,
  `reward_point` int(100) NOT NULL,
  PRIMARY KEY (`reward_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of reward_points
-- ----------------------------
INSERT INTO `reward_points` VALUES ('2', '20', '30');
INSERT INTO `reward_points` VALUES ('3', '1000', '200');
INSERT INTO `reward_points` VALUES ('4', '30', '50');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('31', 'paypal_active', 'Yes', '2020-11-18 14:56:42', '2021-02-15 17:32:58', 'EUR');
INSERT INTO `settings` VALUES ('32', 'paypal_email', 'deekhati63@gmail.com', '2020-11-18 14:56:42', '2021-02-08 16:59:27', null);
INSERT INTO `settings` VALUES ('34', 'stripe_active', 'No', '2020-11-18 14:56:42', '2021-02-15 17:32:58', 'EUR');
INSERT INTO `settings` VALUES ('35', 'stripe_secret_key', 'sk_test_51HzzheJi3WFPjQpEK6E8IPvB0qKXCpnebiMSu1JmKeioveuTbKHfONn5VT1eIfQfJdCr4C1rg1VOoLp3b6DkeqdC006aUfoPYF', '2020-11-18 14:56:42', '2021-04-05 17:46:57', null);
INSERT INTO `settings` VALUES ('36', 'stripe_publishable_key', 'pk_test_51HzzheJi3WFPjQpEVSPqOTgVcICnxl9BnVPj9o2xp0ZJxNeHTz0hVNYrG5NPFvx44H6B6ihZcKd76hkT2KEHmnsG00N6i68gQz', '2020-11-18 14:56:42', '2021-04-05 17:46:57', null);
INSERT INTO `settings` VALUES ('38', 'razorpay_active', 'No', '2020-11-18 14:56:42', '2021-02-15 17:32:58', 'EUR');
INSERT INTO `settings` VALUES ('39', 'razorpay_key_id', 'paymongo_secret_key', '2020-11-18 14:56:42', '2021-04-05 17:46:57', null);
INSERT INTO `settings` VALUES ('40', 'razorpay_secret_key', 'secret_key', '2020-11-18 14:56:42', '2021-04-05 17:46:57', null);
INSERT INTO `settings` VALUES ('42', 'paystack_active', 'No', '2020-11-18 14:56:42', '2021-02-15 17:32:58', 'EUR');
INSERT INTO `settings` VALUES ('43', 'paystack_public_key', 'dgsdgsdg', '2020-11-18 14:56:42', '2021-04-05 17:46:57', null);
INSERT INTO `settings` VALUES ('44', 'paystack_secret_key', 'sdgdgdsg', '2020-11-18 14:56:42', '2021-04-05 17:46:57', null);
INSERT INTO `settings` VALUES ('61', 'paypal_client_id', 'efsdgfdhdfhf', '2021-02-15 17:32:58', '2021-04-05 17:46:57', null);
INSERT INTO `settings` VALUES ('62', 'paypal_secret_key', 'sdgdhfdhsfhhsf', '2021-02-15 17:32:58', '2021-04-05 17:46:57', null);
INSERT INTO `settings` VALUES ('63', 'stripe_merchant_id', 'acct_1HzzheJi3WFPjQpE', '2021-03-11 16:44:01', '2021-04-05 17:46:57', null);
INSERT INTO `settings` VALUES ('64', 'paymongo_active', 'No', null, null, 'EUR');
INSERT INTO `settings` VALUES ('65', 'paymongo_secret_key', 'secret_key', null, '2021-04-05 17:46:57', null);
INSERT INTO `settings` VALUES ('66', 'paymongo_key_id', 'paymongo_secret_key', null, '2021-04-05 17:46:57', 'INR');

-- ----------------------------
-- Table structure for smsby
-- ----------------------------
DROP TABLE IF EXISTS `smsby`;
CREATE TABLE `smsby` (
  `by_id` int(11) NOT NULL AUTO_INCREMENT,
  `msg91` int(11) NOT NULL DEFAULT 1,
  `twilio` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`by_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of smsby
-- ----------------------------
INSERT INTO `smsby` VALUES ('1', '1', '0', '1');

-- ----------------------------
-- Table structure for sms_api
-- ----------------------------
DROP TABLE IF EXISTS `sms_api`;
CREATE TABLE `sms_api` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sms_api_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of sms_api
-- ----------------------------
INSERT INTO `sms_api` VALUES ('1', 'GBSCRB', 'place your Key');

-- ----------------------------
-- Table structure for source_address
-- ----------------------------
DROP TABLE IF EXISTS `source_address`;
CREATE TABLE `source_address` (
  `source_address_id` int(11) NOT NULL AUTO_INCREMENT,
  `source_pincode` int(11) NOT NULL,
  `source_houseno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_landmark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_add` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_lng` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_phone` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`source_address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of source_address
-- ----------------------------

-- ----------------------------
-- Table structure for spldaynotification
-- ----------------------------
DROP TABLE IF EXISTS `spldaynotification`;
CREATE TABLE `spldaynotification` (
  `splnotification_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spldays_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `celeb_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`splnotification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of spldaynotification
-- ----------------------------
INSERT INTO `spldaynotification` VALUES ('1', '219', '10', '12/10/2012');
INSERT INTO `spldaynotification` VALUES ('2', '219', '10', '12/11/2019');
INSERT INTO `spldaynotification` VALUES ('3', '219', '10', '12/10/2012');

-- ----------------------------
-- Table structure for spldays
-- ----------------------------
DROP TABLE IF EXISTS `spldays`;
CREATE TABLE `spldays` (
  `spldays_id` int(11) NOT NULL AUTO_INCREMENT,
  `spldays` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wishmsg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`spldays_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of spldays
-- ----------------------------
INSERT INTO `spldays` VALUES ('9', 'Mom Birthday', 'Happy birthday to your mom. warm wishes for your mom from Go Subscribe team.');
INSERT INTO `spldays` VALUES ('10', 'child birthday', 'Happy birthday to your child. warm wishes from Go Subscribe team.');
INSERT INTO `spldays` VALUES ('11', 'Dad birthday', 'Happy birthday to your dad. warm wishes for your dad from Go Subscribe team.');
INSERT INTO `spldays` VALUES ('12', 'anniversary', 'happy aniversary dear.');

-- ----------------------------
-- Table structure for stock_update
-- ----------------------------
DROP TABLE IF EXISTS `stock_update`;
CREATE TABLE `stock_update` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_stock_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of stock_update
-- ----------------------------

-- ----------------------------
-- Table structure for subcat
-- ----------------------------
DROP TABLE IF EXISTS `subcat`;
CREATE TABLE `subcat` (
  `subcat_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` varchar(255) NOT NULL,
  `subcat_name` varchar(255) NOT NULL,
  `subcat_image` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL DEFAULT 'N/A',
  PRIMARY KEY (`subcat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of subcat
-- ----------------------------

-- ----------------------------
-- Table structure for support_queries
-- ----------------------------
DROP TABLE IF EXISTS `support_queries`;
CREATE TABLE `support_queries` (
  `support_id` int(11) NOT NULL AUTO_INCREMENT,
  `phone_number` bigint(255) NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `query_date` date NOT NULL,
  PRIMARY KEY (`support_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of support_queries
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_category
-- ----------------------------
DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `cityadmin_id` varchar(255) DEFAULT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `home` varchar(255) NOT NULL DEFAULT '0',
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `vendor_id` int(10) NOT NULL DEFAULT 1,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_category
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_email
-- ----------------------------
DROP TABLE IF EXISTS `tbl_email`;
CREATE TABLE `tbl_email` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_body` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `head` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tbl_email
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_orders
-- ----------------------------
DROP TABLE IF EXISTS `tbl_orders`;
CREATE TABLE `tbl_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_cart_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `products_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_charge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n/a',
  `cancel_reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n/a',
  `delivery_boy_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `delivery_boy_incentive` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n/a',
  `delivery_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n/a',
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n/a',
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n/a',
  `pause_start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n/a',
  `pause_end` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n/a',
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n/a',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n/a',
  `rem_price` int(100) NOT NULL DEFAULT 0,
  `coupon_discount` int(100) NOT NULL DEFAULT 0,
  `coupon_id` int(100) NOT NULL DEFAULT 0,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tbl_orders
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_referral
-- ----------------------------
DROP TABLE IF EXISTS `tbl_referral`;
CREATE TABLE `tbl_referral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `referral_by` int(11) NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tbl_referral
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_scratch_card
-- ----------------------------
DROP TABLE IF EXISTS `tbl_scratch_card`;
CREATE TABLE `tbl_scratch_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reffer_message` varchar(255) NOT NULL,
  `min` varchar(255) NOT NULL,
  `max` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `limit` int(11) NOT NULL,
  `app_link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_scratch_card
-- ----------------------------
INSERT INTO `tbl_scratch_card` VALUES ('9', 'Invite Your Friends & get Rs. 50 or more', '1', '20', '2019-04-22 05:25:57', '2019-04-27 12:21:09', '10', 'www.aplink.com');

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wallet_credits` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `rewards` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_verified` int(100) DEFAULT 0,
  `referral_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=685 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_user_scratch_card
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_scratch_card`;
CREATE TABLE `tbl_user_scratch_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `scratch_id` int(11) NOT NULL,
  `app_group_id` int(11) DEFAULT NULL,
  `scratch_type` varchar(255) NOT NULL,
  `scratch_for` varchar(255) DEFAULT NULL,
  `earning` varchar(255) CHARACTER SET utf8 NOT NULL,
  `is_scratch` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4096 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user_scratch_card
-- ----------------------------

-- ----------------------------
-- Table structure for termcondition
-- ----------------------------
DROP TABLE IF EXISTS `termcondition`;
CREATE TABLE `termcondition` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `termcondition` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of termcondition
-- ----------------------------
INSERT INTO `termcondition` VALUES ('4', '<ol style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; color: #1e1e1e; font-family: sans-serif;\">\r\n<li style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent;\">\r\n<p style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; margin: 0px 0px 1em; padding: 0px; font-size: 1rem; line-height: 24px; font-family: HelveticaNowMTTextW04-Rg, Helvetica, Arial, sans-serif;\"><span style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; font-family: HelveticaNowMTTextW05-Bold, Helvetica-Bold, Helvetica, Arial, sans-serif;\">Scope.</span>&nbsp;The following Terms and Conditions will apply exclusively to the current and future business relationships between Monotype Imaging Inc. (collectively with its subsidiaries and affiliated companies, &ldquo;Monotype&rdquo;) and you (&ldquo;you&rdquo; or the &ldquo;customer&rdquo;). Any additional or inconsistent terms issued by you, including any such terms and conditions set forth on a purchase order provided by you shall not be binding upon Monotype, unless Monotype gives its express agreement in writing.</p>\r\n</li>\r\n<li style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent;\">\r\n<p style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; margin: 0px 0px 1em; padding: 0px; font-size: 1rem; line-height: 24px; font-family: HelveticaNowMTTextW04-Rg, Helvetica, Arial, sans-serif;\"><span style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; font-family: HelveticaNowMTTextW05-Bold, Helvetica-Bold, Helvetica, Arial, sans-serif;\">Entire Agreement.</span>&nbsp;Any quotation or price information made available by Monotype is without obligation and subject to change without notice unless an offer has been designated as binding. Oral understandings between you and Monotype will require written confirmation by Monotype and a contract between you and Monotype will only become valid when it has been accepted in writing by Monotype (e.g., confirmation of order, which will be final) or when the order is performed (e.g., delivery, download or connection by you of or to the software). As permitted by law, Monotype reserves the right to correct errors in its offers, invoices and communications such as spelling or arithmetical errors. You and Monotype each owe a duty to each other co-operate in order to give full effect to your agreement.</p>\r\n</li>\r\n<li style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent;\">\r\n<p style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; margin: 0px 0px 1em; padding: 0px; font-size: 1rem; line-height: 24px; font-family: HelveticaNowMTTextW04-Rg, Helvetica, Arial, sans-serif;\"><span style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; font-family: HelveticaNowMTTextW05-Bold, Helvetica-Bold, Helvetica, Arial, sans-serif;\">Assignment.</span>&nbsp;Unless specifically set forth in a written agreement between you and Monotype, your obligations to Monotype may not be sublicensed or assigned to any third party (with a change in control of you constituting an assignment). These Terms and Conditions shall be binding on each party&rsquo;s successors and assigns.</p>\r\n</li>\r\n<li style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent;\">\r\n<p style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; margin: 0px 0px 1em; padding: 0px; font-size: 1rem; line-height: 24px; font-family: HelveticaNowMTTextW04-Rg, Helvetica, Arial, sans-serif;\"><span style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; font-family: HelveticaNowMTTextW05-Bold, Helvetica-Bold, Helvetica, Arial, sans-serif;\">Delivery.</span>&nbsp;As permitted by law, Monotype&rsquo;s standard delivery terms are FOB origin.</p>\r\n</li>\r\n<li style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent;\">\r\n<p style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; margin: 0px 0px 1em; padding: 0px; font-size: 1rem; line-height: 24px; font-family: HelveticaNowMTTextW04-Rg, Helvetica, Arial, sans-serif;\"><span style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; font-family: HelveticaNowMTTextW05-Bold, Helvetica-Bold, Helvetica, Arial, sans-serif;\">Prices.</span>&nbsp;Unless otherwise indicated in writing by Monotype, all prices are quoted in US dollars and are exclusive of all taxes and duties imposed by any governmental authority and freight and shipping charges, all of which shall be paid by you.</p>\r\n</li>\r\n<li style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent;\">\r\n<p style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; margin: 0px 0px 1em; padding: 0px; font-size: 1rem; line-height: 24px; font-family: HelveticaNowMTTextW04-Rg, Helvetica, Arial, sans-serif;\"><span style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; font-family: HelveticaNowMTTextW05-Bold, Helvetica-Bold, Helvetica, Arial, sans-serif;\">Payment.</span>&nbsp;Unless specifically set forth in a written agreement between you and Monotype, payment for goods or services from Monotype is net thirty (30) days from the date of invoice. Overdue payments shall bear interest from the due date at the rate of the lower of one and half percent per month (1.5%) or the maximum rate permissible under applicable law.</p>\r\n</li>\r\n<li style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent;\">\r\n<p style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; margin: 0px 0px 1em; padding: 0px; font-size: 1rem; line-height: 24px; font-family: HelveticaNowMTTextW04-Rg, Helvetica, Arial, sans-serif;\"><span style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; font-family: HelveticaNowMTTextW05-Bold, Helvetica-Bold, Helvetica, Arial, sans-serif;\">Warranty.</span>&nbsp;Unless specifically set forth in a written agreement between you and Monotype or as required by law, the goods and services purchased by you are provided &ldquo;as is&rdquo; without any representation or warranty of any kind, including without limitation, any warranty of non-infringement or fitness for a particular purpose.</p>\r\n</li>\r\n<li style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent;\">\r\n<p style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; margin: 0px 0px 1em; padding: 0px; font-size: 1rem; line-height: 24px; font-family: HelveticaNowMTTextW04-Rg, Helvetica, Arial, sans-serif;\"><span style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; font-family: HelveticaNowMTTextW05-Bold, Helvetica-Bold, Helvetica, Arial, sans-serif;\">Partial Nullity.</span>&nbsp;In the event that any provision of these Terms and Conditions is unenforceable or invalid, such unenforceability or invalidity shall not render these Terms and Conditions unenforceable or invalid as a whole, and, in such event, such provision shall be changed and interpreted so as to best accomplish the objectives of such unenforceable or invalid provision within the limits of applicable law or court decisions.</p>\r\n</li>\r\n<li style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent;\">\r\n<p style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; margin: 0px 0px 1em; padding: 0px; font-size: 1rem; line-height: 24px; font-family: HelveticaNowMTTextW04-Rg, Helvetica, Arial, sans-serif;\"><span style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; font-family: HelveticaNowMTTextW05-Bold, Helvetica-Bold, Helvetica, Arial, sans-serif;\">Export.&nbsp;</span>You agree that the software licensed to you by Monotype will not be shipped, transferred or exported into any country or used in any manner prohibited by the United States Export Administration or any applicable export laws, restrictions or regulations.</p>\r\n</li>\r\n<li style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent;\">\r\n<p style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; margin: 0px 0px 1em; padding: 0px; font-size: 1rem; line-height: 24px; font-family: HelveticaNowMTTextW04-Rg, Helvetica, Arial, sans-serif;\"><span style=\"box-sizing: border-box; -webkit-tap-highlight-color: transparent; font-family: HelveticaNowMTTextW05-Bold, Helvetica-Bold, Helvetica, Arial, sans-serif;\">U.S. Government Contracts.</span> If the software licensed to you by Monotype is acquired under the terms of a (i) GSA contract - use, reproduction or disclosure is subject to the restrictions set forth in the applicable ADP Schedule contract, (ii) DOD contract - use, duplication or disclosure by the Government is subject to the applicable restrictions set forth in DFARS 252.277-7013; (iii) Civilian agency contract - use, reproduction, or disclosure is subject to FAR 52.277-19(a) through (d) and restrictions set forth in your agreement with Monotype.</p>\r\n</li>\r\n</ol>');
INSERT INTO `termcondition` VALUES ('6', '<p>&nbsp;</p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">Last updated: February 1, 2021</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">Daily Needz (\"us\", \"we\", or \"our\") operates the http://dailyneedzonline.com website and the Daily Needz mobile application (the \"Service\").</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">This page informs you of our policies regarding the collection, use and disclosure of Personal Information when you use our Service.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">We will not use or share your information with anyone except as described in this Privacy Policy.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">We use your Personal Information for providing and improving the Service. By using the Service, you agree to the collection and use of information in accordance with this policy. Unless otherwise defined in this Privacy Policy, terms used in this Privacy Policy have the same meanings as in our Terms and Conditions.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">Information Collection And Use</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">While using our Service, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you. Personally-identifiable information may include, but is not limited to, your email address, name, phone number, postal address (\"Personal Information\").</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">Log Data</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">We collect information that your browser sends whenever you visit our Service (\"Log Data\"). This Log Data may include information such as your computer\'s Internet Protocol (\"IP\") address, browser type, browser version, the pages of our Service that you visit, the time and date of your visit, the time spent on those pages and other statistics.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">In addition, we may use third party services such as Google Analytics that collect, monitor and analyze this type of information in order to increase our Service\'s functionality. These third-party service providers have their own privacy policies addressing how they use such information.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">When you access the Service by or through a mobile device, we may collect certain information automatically, including, but not limited to, the type of mobile device you use, your mobile devices unique device ID, the IP address of your mobile device, your mobile operating system, the type of mobile Internet browser you use and other statistics.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">Location information</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">We may use and store information about your location, if you give us permission to do so. We use this information to provide features of our Service, to improve and customize our Service. You can enable or disable location services when you use our Service at any time, through your mobile device settings.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">Cookies</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">Cookies are files with small amount of data, which may include an anonymous unique identifier. Cookies are sent to your browser from a web site and stored on your computer\'s hard drive.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">We use \"cookies\" to collect information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Service.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">Service Providers</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">We may employ third party companies and individuals to facilitate our Service, to provide the Service on our behalf, to perform Service-related services or to assist us in analyzing how our Service is used.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">These third parties have access to your Personal Information only to perform these tasks on our behalf and are obligated not to disclose or use it for any other purpose.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">Compliance With Laws</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">We will disclose your Personal Information where required to do so by law or subpoena or if we believe that such action is necessary to comply with the law and the reasonable requests of law enforcement or to protect the security or integrity of our Service.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">Business Transaction</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">If DailyNeedz is involved in a merger, acquisition or asset sale, your Personal Information may be transferred. We will provide notice before your Personal Information is transferred and becomes subject to a different Privacy Policy.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">Security</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">The security of your Personal Information is important to us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your Personal Information, we cannot guarantee its absolute security.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">Links To Other Sites</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">Our Service may contain links to other sites that are not operated by us. If you click on a third-party link, you will be directed to that third party\'s site. We strongly advise you to review the Privacy Policy of every site you visit.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">We have no control over, and assume no responsibility for the content, privacy policies or practices of any third-party sites or services.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">Children\'s Privacy</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">Our Service does not address anyone under the age of 13 (\"Children\").</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">We do not knowingly collect personally identifiable information from children under 13. If you are a parent or guardian and you are aware that your Children has provided us with Personal Information, please contact us. If we become aware that we have collected Personal Information from a children under-age 13 without verification of parental consent, we take steps to remove that information from our servers.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">Changes To This Privacy Policy</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">Contact Us</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">If you have any questions about this Privacy Policy, please contact us at customercare@dailyneedzonline.com</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-US\">&nbsp;</span></p>\r\n<p><!-- [if gte mso 9]><xml>\r\n <o:OfficeDocumentSettings>\r\n  <o:AllowPNG/>\r\n </o:OfficeDocumentSettings>\r\n</xml><![endif]--><!-- [if gte mso 9]><xml>\r\n <w:WordDocument>\r\n  <w:View>Normal</w:View>\r\n  <w:Zoom>0</w:Zoom>\r\n  <w:TrackMoves/>\r\n  <w:TrackFormatting/>\r\n  <w:PunctuationKerning/>\r\n  <w:ValidateAgainstSchemas/>\r\n  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>\r\n  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>\r\n  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>\r\n  <w:DoNotPromoteQF/>\r\n  <w:LidThemeOther>EN-US</w:LidThemeOther>\r\n  <w:LidThemeAsian>X-NONE</w:LidThemeAsian>\r\n  <w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>\r\n  <w:Compatibility>\r\n   <w:BreakWrappedTables/>\r\n   <w:SnapToGridInCell/>\r\n   <w:WrapTextWithPunct/>\r\n   <w:UseAsianBreakRules/>\r\n   <w:DontGrowAutofit/>\r\n   <w:SplitPgBreakAndParaMark/>\r\n   <w:EnableOpenTypeKerning/>\r\n   <w:DontFlipMirrorIndents/>\r\n   <w:OverrideTableStyleHps/>\r\n  </w:Compatibility>\r\n  <m:mathPr>\r\n   <m:mathFont m:val=\"Cambria Math\"/>\r\n   <m:brkBin m:val=\"before\"/>\r\n   <m:brkBinSub m:val=\"&#45;-\"/>\r\n   <m:smallFrac m:val=\"off\"/>\r\n   <m:dispDef/>\r\n   <m:lMargin m:val=\"0\"/>\r\n   <m:rMargin m:val=\"0\"/>\r\n   <m:defJc m:val=\"centerGroup\"/>\r\n   <m:wrapIndent m:val=\"1440\"/>\r\n   <m:intLim m:val=\"subSup\"/>\r\n   <m:naryLim m:val=\"undOvr\"/>\r\n  </m:mathPr></w:WordDocument>\r\n</xml><![endif]--><!-- [if gte mso 9]><xml>\r\n <w:LatentStyles DefLockedState=\"false\" DefUnhideWhenUsed=\"false\"\r\n  DefSemiHidden=\"false\" DefQFormat=\"false\" DefPriority=\"99\"\r\n  LatentStyleCount=\"371\">\r\n  <w:LsdException Locked=\"false\" Priority=\"0\" QFormat=\"true\" Name=\"Normal\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" QFormat=\"true\" Name=\"heading 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 7\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 8\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 9\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 4\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 5\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 6\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 7\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 8\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 9\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 7\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 8\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 9\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Normal Indent\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"footnote text\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"annotation text\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"header\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"footer\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index heading\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"35\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"caption\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"table of figures\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"envelope address\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"envelope return\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"footnote reference\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"annotation reference\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"line number\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"page number\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"endnote reference\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"endnote text\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"table of authorities\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"macro\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"toa heading\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List 4\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List 5\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet 4\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet 5\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number 4\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"10\" QFormat=\"true\" Name=\"Title\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Closing\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Signature\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"1\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"Default Paragraph Font\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text Indent\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue 4\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue 5\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Message Header\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"11\" QFormat=\"true\" Name=\"Subtitle\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Salutation\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Date\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text First Indent\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text First Indent 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Note Heading\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text Indent 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text Indent 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Block Text\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Hyperlink\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"FollowedHyperlink\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"22\" QFormat=\"true\" Name=\"Strong\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"20\" QFormat=\"true\" Name=\"Emphasis\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Document Map\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Plain Text\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"E-mail Signature\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Top of Form\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Bottom of Form\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Normal (Web)\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Acronym\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Address\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Cite\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Code\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Definition\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Keyboard\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Preformatted\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Sample\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Typewriter\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Variable\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Normal Table\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"annotation subject\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"No List\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Outline List 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Outline List 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Outline List 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Simple 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Simple 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Simple 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Classic 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Classic 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Classic 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Classic 4\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Colorful 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Colorful 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Colorful 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Columns 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Columns 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Columns 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Columns 4\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Columns 5\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 4\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 5\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 6\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 7\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 8\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 4\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 5\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 6\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 7\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 8\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table 3D effects 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table 3D effects 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table 3D effects 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Contemporary\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Elegant\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Professional\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Subtle 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Subtle 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Web 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Web 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Web 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Balloon Text\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" Name=\"Table Grid\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Theme\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" Name=\"Placeholder Text\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"1\" QFormat=\"true\" Name=\"No Spacing\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" Name=\"Revision\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"34\" QFormat=\"true\"\r\n   Name=\"List Paragraph\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"29\" QFormat=\"true\" Name=\"Quote\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"30\" QFormat=\"true\"\r\n   Name=\"Intense Quote\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"19\" QFormat=\"true\"\r\n   Name=\"Subtle Emphasis\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"21\" QFormat=\"true\"\r\n   Name=\"Intense Emphasis\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"31\" QFormat=\"true\"\r\n   Name=\"Subtle Reference\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"32\" QFormat=\"true\"\r\n   Name=\"Intense Reference\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"33\" QFormat=\"true\" Name=\"Book Title\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"37\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"Bibliography\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"TOC Heading\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"41\" Name=\"Plain Table 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"42\" Name=\"Plain Table 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"43\" Name=\"Plain Table 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"44\" Name=\"Plain Table 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"45\" Name=\"Plain Table 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"40\" Name=\"Grid Table Light\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\" Name=\"Grid Table 1 Light\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\" Name=\"Grid Table 6 Colorful\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\" Name=\"Grid Table 7 Colorful\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\" Name=\"List Table 1 Light\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\" Name=\"List Table 6 Colorful\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\" Name=\"List Table 7 Colorful\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 6\"/>\r\n </w:LatentStyles>\r\n</xml><![endif]--><!-- [if gte mso 10]>\r\n<style>\r\n /* Style Definitions */\r\n table.MsoNormalTable\r\n	{mso-style-name:\"Table Normal\";\r\n	mso-tstyle-rowband-size:0;\r\n	mso-tstyle-colband-size:0;\r\n	mso-style-noshow:yes;\r\n	mso-style-priority:99;\r\n	mso-style-parent:\"\";\r\n	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;\r\n	mso-para-margin-top:0cm;\r\n	mso-para-margin-right:0cm;\r\n	mso-para-margin-bottom:10.0pt;\r\n	mso-para-margin-left:0cm;\r\n	line-height:12.0pt;\r\n	mso-line-height-rule:exactly;\r\n	mso-pagination:widow-orphan;\r\n	font-size:11.0pt;\r\n	font-family:\"Calibri\",\"sans-serif\";\r\n	mso-ascii-font-family:Calibri;\r\n	mso-ascii-theme-font:minor-latin;\r\n	mso-hansi-font-family:Calibri;\r\n	mso-hansi-theme-font:minor-latin;\r\n	mso-bidi-font-family:\"Times New Roman\";\r\n	mso-bidi-theme-font:minor-bidi;\r\n	mso-ansi-language:EN-US;\r\n	mso-fareast-language:EN-US;}\r\n</style>\r\n<![endif]--></p>');

-- ----------------------------
-- Table structure for time_slot
-- ----------------------------
DROP TABLE IF EXISTS `time_slot`;
CREATE TABLE `time_slot` (
  `time_slot_id` int(100) NOT NULL AUTO_INCREMENT,
  `open_hour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `close_hour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_slot` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  PRIMARY KEY (`time_slot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of time_slot
-- ----------------------------

-- ----------------------------
-- Table structure for twilio
-- ----------------------------
DROP TABLE IF EXISTS `twilio`;
CREATE TABLE `twilio` (
  `twilio_id` int(11) NOT NULL AUTO_INCREMENT,
  `twilio_sid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twilio_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twilio_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`twilio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of twilio
-- ----------------------------
INSERT INTO `twilio` VALUES ('1', 'Place your Key', 'GoMarket', '+19169995023', '0');

-- ----------------------------
-- Table structure for ui_vendor
-- ----------------------------
DROP TABLE IF EXISTS `ui_vendor`;
CREATE TABLE `ui_vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ui_design` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of ui_vendor
-- ----------------------------
INSERT INTO `ui_vendor` VALUES ('1', 'Grocery');
INSERT INTO `ui_vendor` VALUES ('2', 'Resturant');
INSERT INTO `ui_vendor` VALUES ('3', 'Pharmacy');
INSERT INTO `ui_vendor` VALUES ('4', 'Parcal');

-- ----------------------------
-- Table structure for user_address
-- ----------------------------
DROP TABLE IF EXISTS `user_address`;
CREATE TABLE `user_address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `city_id` varchar(255) NOT NULL,
  `area_id` int(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL DEFAULT 'N/A',
  `updated_at` varchar(255) NOT NULL DEFAULT 'N/A',
  `user_name` varchar(255) DEFAULT NULL,
  `user_number` bigint(200) NOT NULL,
  `select_status` int(11) NOT NULL DEFAULT 0,
  `houseno` varchar(255) DEFAULT NULL,
  `pincode` int(11) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_address
-- ----------------------------

-- ----------------------------
-- Table structure for user_notification
-- ----------------------------
DROP TABLE IF EXISTS `user_notification`;
CREATE TABLE `user_notification` (
  `noti_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `noti_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noti_message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_by_user` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`noti_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1480 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of user_notification
-- ----------------------------

-- ----------------------------
-- Table structure for vendor
-- ----------------------------
DROP TABLE IF EXISTS `vendor`;
CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cityadmin_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_loc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `closing_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n/a',
  `vendor_category_id` int(11) NOT NULL,
  `comission` int(11) DEFAULT NULL,
  `delivery_range` int(11) NOT NULL,
  `device_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_verified` int(10) NOT NULL DEFAULT 0,
  `ui_type` int(11) NOT NULL,
  `online_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of vendor
-- ----------------------------

-- ----------------------------
-- Table structure for vendor_area
-- ----------------------------
DROP TABLE IF EXISTS `vendor_area`;
CREATE TABLE `vendor_area` (
  `vendor_area_id` int(11) NOT NULL AUTO_INCREMENT,
  `area_id` int(11) NOT NULL,
  `delivery_charge` int(11) NOT NULL,
  `cod` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(11) NOT NULL,
  PRIMARY KEY (`vendor_area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of vendor_area
-- ----------------------------

-- ----------------------------
-- Table structure for vendor_category
-- ----------------------------
DROP TABLE IF EXISTS `vendor_category`;
CREATE TABLE `vendor_category` (
  `vendor_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ui_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`vendor_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of vendor_category
-- ----------------------------

-- ----------------------------
-- Table structure for vendor_notification
-- ----------------------------
DROP TABLE IF EXISTS `vendor_notification`;
CREATE TABLE `vendor_notification` (
  `not_id` int(11) NOT NULL AUTO_INCREMENT,
  `not_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `not_message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `read_by_vendor` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`not_id`)
) ENGINE=InnoDB AUTO_INCREMENT=423 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of vendor_notification
-- ----------------------------

-- ----------------------------
-- Table structure for vendor_payment
-- ----------------------------
DROP TABLE IF EXISTS `vendor_payment`;
CREATE TABLE `vendor_payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `payment_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of vendor_payment
-- ----------------------------

-- ----------------------------
-- Table structure for wallets_plans
-- ----------------------------
DROP TABLE IF EXISTS `wallets_plans`;
CREATE TABLE `wallets_plans` (
  `plan_id` int(11) NOT NULL AUTO_INCREMENT,
  `plans` varchar(255) NOT NULL,
  PRIMARY KEY (`plan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wallets_plans
-- ----------------------------

-- ----------------------------
-- Table structure for wallet_history
-- ----------------------------
DROP TABLE IF EXISTS `wallet_history`;
CREATE TABLE `wallet_history` (
  `wallet_id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`wallet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of wallet_history
-- ----------------------------

-- ----------------------------
-- Table structure for wallet_offers
-- ----------------------------
DROP TABLE IF EXISTS `wallet_offers`;
CREATE TABLE `wallet_offers` (
  `wallet_id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_amount` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maximum_offer` int(11) DEFAULT NULL,
  `offer_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`wallet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of wallet_offers
-- ----------------------------
INSERT INTO `wallet_offers` VALUES ('1', '800', 'price', null, 'images/admin/admin_banner/07-01-2021/070121014056pm-ace2three-welcome-bonus-offer.jpg', '20');
INSERT INTO `wallet_offers` VALUES ('2', '1000', 'percentage', '50', 'images/admin/admin_banner/07-01-2021/070121053503pm-ace2three-welcome-bonus-offer.jpg', '10');

-- ----------------------------
-- Table structure for wallet_recharge_history
-- ----------------------------
DROP TABLE IF EXISTS `wallet_recharge_history`;
CREATE TABLE `wallet_recharge_history` (
  `wallet_recharge_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recharge_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_recharge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`wallet_recharge_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of wallet_recharge_history
-- ----------------------------
INSERT INTO `wallet_recharge_history` VALUES ('1', '219', '50', 'success', '2019-08-02 13:35:37');
INSERT INTO `wallet_recharge_history` VALUES ('2', '219', '50', 'failed', '2019-08-02 13:42:19');
INSERT INTO `wallet_recharge_history` VALUES ('3', '219', '500', 'success', '2019-08-02 13:44:29');
INSERT INTO `wallet_recharge_history` VALUES ('4', '219', '1000', 'success', '2019-08-07 07:40:38');
INSERT INTO `wallet_recharge_history` VALUES ('5', '219', '1000', 'failed', '2019-08-07 07:41:35');
INSERT INTO `wallet_recharge_history` VALUES ('6', '219', '2000', 'success', '2019-08-10 10:55:07');
INSERT INTO `wallet_recharge_history` VALUES ('7', '219', '2000', 'success', '2019-08-10 10:55:42');
INSERT INTO `wallet_recharge_history` VALUES ('8', '219', '2000', 'success', '2019-08-10 10:57:51');
INSERT INTO `wallet_recharge_history` VALUES ('9', '219', '2000', 'success', '2019-08-10 17:34:56');
INSERT INTO `wallet_recharge_history` VALUES ('10', '219', '2000', 'success', '2019-08-10 17:37:50');
INSERT INTO `wallet_recharge_history` VALUES ('11', '219', '2000', 'success', '2019-08-10 17:38:45');
INSERT INTO `wallet_recharge_history` VALUES ('12', '219', '2000', 'success', '2019-08-10 17:42:14');
INSERT INTO `wallet_recharge_history` VALUES ('13', '219', '1000', 'success', '2019-08-10 17:52:53');
INSERT INTO `wallet_recharge_history` VALUES ('14', '219', '2000', 'success', '2019-08-10 17:53:02');
INSERT INTO `wallet_recharge_history` VALUES ('15', '219', '2000', 'success', '2019-08-10 17:55:22');
INSERT INTO `wallet_recharge_history` VALUES ('16', '219', '2000', 'success', '2019-08-10 18:02:14');
INSERT INTO `wallet_recharge_history` VALUES ('17', '219', '2000', 'success', '2019-08-10 18:06:39');
INSERT INTO `wallet_recharge_history` VALUES ('18', '219', '2000', 'success', '2019-08-10 18:11:14');
INSERT INTO `wallet_recharge_history` VALUES ('19', '219', '2000', 'success', '2019-08-10 18:12:21');
INSERT INTO `wallet_recharge_history` VALUES ('20', '219', '2000', 'success', '2019-08-10 18:24:53');
INSERT INTO `wallet_recharge_history` VALUES ('21', '219', '3000', 'success', '2019-08-12 10:38:13');
INSERT INTO `wallet_recharge_history` VALUES ('22', '219', '3100', 'success', '2019-08-12 10:40:09');
INSERT INTO `wallet_recharge_history` VALUES ('23', '220', '2900', 'success', '2019-08-13 06:06:25');
INSERT INTO `wallet_recharge_history` VALUES ('24', '220', '3100', 'success', '2019-08-13 06:12:10');
INSERT INTO `wallet_recharge_history` VALUES ('25', '220', '3100', 'success', '2019-08-14 13:17:21');
INSERT INTO `wallet_recharge_history` VALUES ('26', '220', '2900', 'success', '2019-08-14 13:19:00');
INSERT INTO `wallet_recharge_history` VALUES ('27', '220', '3100', 'success', '2019-08-14 13:20:14');
INSERT INTO `wallet_recharge_history` VALUES ('28', '220', '52', 'success', '2019-08-23 11:51:25');
INSERT INTO `wallet_recharge_history` VALUES ('29', '220', '22', 'success', '2019-08-28 07:39:45');
INSERT INTO `wallet_recharge_history` VALUES ('30', '220', '22', 'success', '2019-08-28 07:40:22');
INSERT INTO `wallet_recharge_history` VALUES ('31', '220', '11', 'success', '2019-08-29 07:18:43');
INSERT INTO `wallet_recharge_history` VALUES ('32', '220', '11', 'success', '2019-08-29 07:24:51');
INSERT INTO `wallet_recharge_history` VALUES ('33', '220', '11', 'success', '2019-08-29 07:32:40');
INSERT INTO `wallet_recharge_history` VALUES ('34', '220', '11', 'success', '2019-08-29 07:33:07');
INSERT INTO `wallet_recharge_history` VALUES ('35', '220', '500', 'success', '2019-08-29 07:55:55');
INSERT INTO `wallet_recharge_history` VALUES ('36', '220', '11', 'success', '2019-08-29 07:57:11');
INSERT INTO `wallet_recharge_history` VALUES ('37', '220', '500', 'success', '2019-08-29 08:00:01');
INSERT INTO `wallet_recharge_history` VALUES ('38', '220', '4500', 'success', '2019-08-29 11:13:47');
INSERT INTO `wallet_recharge_history` VALUES ('39', '220', '500', 'success', '2019-08-29 11:14:59');
INSERT INTO `wallet_recharge_history` VALUES ('40', '264', '5000', 'success', '2019-09-04 07:51:56');
INSERT INTO `wallet_recharge_history` VALUES ('41', '264', '500', 'success', '2019-09-04 10:28:40');
INSERT INTO `wallet_recharge_history` VALUES ('42', '220', '7000', 'success', '2019-09-06 05:02:49');
INSERT INTO `wallet_recharge_history` VALUES ('43', '251', '500', 'success', '2019-09-08 15:58:35');
INSERT INTO `wallet_recharge_history` VALUES ('44', '220', '1000', 'success', '2019-09-09 10:51:16');
INSERT INTO `wallet_recharge_history` VALUES ('45', '220', '500', 'success', '2019-09-10 07:28:12');
INSERT INTO `wallet_recharge_history` VALUES ('46', '220', '25', 'success', '2019-09-10 07:30:13');
INSERT INTO `wallet_recharge_history` VALUES ('47', '220', '9500', 'success', '2019-09-10 11:05:12');
INSERT INTO `wallet_recharge_history` VALUES ('48', '288', '5000', 'success', '2019-09-13 06:06:10');
INSERT INTO `wallet_recharge_history` VALUES ('49', '289', '5000', 'success', '2019-09-13 06:14:00');
INSERT INTO `wallet_recharge_history` VALUES ('50', '251', '7000', 'success', '2019-09-13 18:00:49');
INSERT INTO `wallet_recharge_history` VALUES ('51', '251', '9000', 'success', '2019-09-13 18:01:41');
INSERT INTO `wallet_recharge_history` VALUES ('52', '251', '9000', 'success', '2019-09-13 18:01:58');
INSERT INTO `wallet_recharge_history` VALUES ('53', '251', '9000', 'success', '2019-09-13 18:02:22');
INSERT INTO `wallet_recharge_history` VALUES ('54', '251', '9000', 'success', '2019-09-13 18:02:43');
INSERT INTO `wallet_recharge_history` VALUES ('55', '251', '9000', 'success', '2019-09-13 18:03:06');
INSERT INTO `wallet_recharge_history` VALUES ('56', '251', '7928', 'success', '2019-09-13 18:03:41');
INSERT INTO `wallet_recharge_history` VALUES ('57', '251', '1000', 'success', '2019-09-14 05:52:38');
INSERT INTO `wallet_recharge_history` VALUES ('58', '251', '4000', 'success', '2019-09-14 05:53:05');
INSERT INTO `wallet_recharge_history` VALUES ('59', '220', '1000', 'success', '2019-09-16 05:54:48');
INSERT INTO `wallet_recharge_history` VALUES ('60', '220', '1000', 'success', '2019-09-16 05:54:51');
INSERT INTO `wallet_recharge_history` VALUES ('61', '291', '9000', 'success', '2019-09-16 06:38:29');
INSERT INTO `wallet_recharge_history` VALUES ('62', '292', '3000', 'success', '2019-09-16 10:44:53');
INSERT INTO `wallet_recharge_history` VALUES ('63', '308', '9000', 'success', '2019-09-24 13:00:20');
INSERT INTO `wallet_recharge_history` VALUES ('64', '326', '2000', 'success', '2019-09-26 19:38:10');
INSERT INTO `wallet_recharge_history` VALUES ('65', '326', '2000', 'success', '2019-09-26 19:38:11');
INSERT INTO `wallet_recharge_history` VALUES ('66', '326', '5000', 'success', '2019-09-26 19:40:50');
INSERT INTO `wallet_recharge_history` VALUES ('67', '316', '50', 'success', '2019-09-27 12:33:15');
INSERT INTO `wallet_recharge_history` VALUES ('68', '316', '50', 'success', '2019-09-27 12:37:01');
INSERT INTO `wallet_recharge_history` VALUES ('69', '219', '105', '1', '2019-12-23 06:00:13');
INSERT INTO `wallet_recharge_history` VALUES ('70', '219', '105', '1', '2019-12-23 06:28:26');
