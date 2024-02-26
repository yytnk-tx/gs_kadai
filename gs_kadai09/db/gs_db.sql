-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-07-07 04:28:48
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `daily_reports`
--

CREATE TABLE `daily_reports` (
  `tenant_id` char(7) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `report_content` varchar(1200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `daily_reports`
--

INSERT INTO `daily_reports` (`tenant_id`, `user_id`, `date`, `report_content`) VALUES
('0000000', 1, '2023-07-07', 'aaaaaaaaa');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_an_table`
--

CREATE TABLE `gs_an_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_an_table`
--

INSERT INTO `gs_an_table` (`id`, `name`, `email`, `content`, `date`) VALUES
(1, '田中', 'sample@sample.com', '初めてのDBインサート', '2023-06-24 15:14:33'),
(2, '佐藤', 'example@example.com', '2回目のインサート', '2023-06-24 15:17:19'),
(3, '林', 'ppp@pppppp.com', '3回目のインサート', '2023-06-24 15:17:58'),
(4, '高橋', 'zzz@zzzzzz.com', '4回目のインサート', '2023-06-24 15:18:19'),
(5, 'test', 'test@test.com', 'あああああ', '2023-06-24 15:53:17'),
(6, 'test', 'test@test.com', 'あああああ', '2023-06-24 15:55:53'),
(7, 'test', 'test@sample.com', 'aaaaa', '2023-06-24 16:12:36'),
(8, 'aaa', 'ssss', '<script>alert(\"test\");</script>', '2023-06-24 16:57:49');

-- --------------------------------------------------------

--
-- テーブルの構造 `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'システム管理者'),
(2, 'ユーザー管理者'),
(3, '一般ユーザー');

-- --------------------------------------------------------

--
-- テーブルの構造 `role_grant_privileges`
--

CREATE TABLE `role_grant_privileges` (
  `role` int(11) NOT NULL,
  `role_grant_privilege` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `role_grant_privileges`
--

INSERT INTO `role_grant_privileges` (`role`, `role_grant_privilege`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 2),
(2, 3);

-- --------------------------------------------------------

--
-- テーブルの構造 `tenants`
--

CREATE TABLE `tenants` (
  `tenant_id` char(7) NOT NULL,
  `tenant_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `tenants`
--

INSERT INTO `tenants` (`tenant_id`, `tenant_name`) VALUES
('0000000', 'システム運営会社'),
('0000001', 'ユーザ会社１'),
('0000002', 'ユーザ会社２');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` int(11) NOT NULL,
  `user_tenant` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `role`, `user_tenant`) VALUES
(1, 'admin', 'admin', 1, '0000000'),
(3, 'test', 'test', 2, '0000001'),
(4, 'test2', 'test2', 3, '0000001'),
(6, 'test', 'aaa', 2, '0000002');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `daily_reports`
--
ALTER TABLE `daily_reports`
  ADD PRIMARY KEY (`tenant_id`,`user_id`,`date`);

--
-- テーブルのインデックス `gs_an_table`
--
ALTER TABLE `gs_an_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- テーブルのインデックス `role_grant_privileges`
--
ALTER TABLE `role_grant_privileges`
  ADD PRIMARY KEY (`role`,`role_grant_privilege`);

--
-- テーブルのインデックス `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`tenant_id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `gs_an_table`
--
ALTER TABLE `gs_an_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- テーブルの AUTO_INCREMENT `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
