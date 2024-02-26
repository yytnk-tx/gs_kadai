-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-07-20 18:54:28
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
('0000000', 1, '2023-07-06', 'fjdsal;fuieaw\r\n\r\n\r\nfewafdadfa\r\n\r\n\r\ndfsa'),
('0000000', 1, '2023-07-07', '                                                            '),
('0000000', 1, '2023-07-21', 'fdas'),
('0000000', 1, '2023-08-21', 'fdsafasdfdasfdas'),
('0000001', 4, '2023-07-18', 'test'),
('0000001', 4, '2023-07-27', 'bbbb'),
('0000003', 14, '2023-07-07', 'test'),
('0000003', 15, '2023-07-07', 'test'),
('0000003', 15, '2023-07-08', 'This is Test'),
('0000003', 15, '2023-07-20', 'test'),
('0000007', 22, '2023-07-07', '2023/07/21の日報です。');

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
('0000002', 'ユーザ会社２'),
('0000005', 'test'),
('0000006', 'testtest'),
('0000007', 'TEST COMPANY XYZ');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `user_tenant` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `role`, `user_tenant`) VALUES
(1, 'admin', '$2y$10$MZC.5/431BvlwNN/LY511.1Sx9FdGfGhUpTtnbdfoK7Vuf.CELCc.', 1, '0000000'),
(3, 'user_admin', '$2y$10$lwvu213l.kgrliaal/2nbuJjYDkCgrTZeZ/JbNGjBAyv/pLQew9k6', 2, '0000001'),
(4, 'user_general', '$2y$10$3/VzLvwGX3jeSQ9B2AyrX.pVP4SBiBJJffSL0ThxWxMod1YZfZP4K', 3, '0000001'),
(6, 'test', '$2y$10$1m3irdsyhHkWVR7C8EbPzu7fF6ORebaQFb1YyTUR8e/39sMx0ERF6', 2, '0000002'),
(10, 'aaaa', '$2y$10$Ksnfy2S0ccRLm8CdvIae.uisnIBdYhbhLVELsSoaQn5cDTUOkQToi', 2, '0000000'),
(11, 'cccc', '$2y$10$lZrxc9L4IRBnCxF3aXwuLepkqAarBjEhUdU.uSYkjMP3YTIvE.SGK', 3, '0000000'),
(13, 'xxxx', '$2y$10$CuQWtM3pxab.VDnG1eBiBuuwhN6KO4wAcmunJa0e7EdMav52SGmei', 2, '0000001'),
(14, 'tenant3_admin_user1', '$2y$10$miU.PWk98C1KQ1XEYXr6.egKcd4Tuc4Snz1z/NHJCvuQRrqOU/ThG', 2, '0000003'),
(15, 'tenant3_general_user1', '$2y$10$DrzNBn.Aj.chqWmc/Kzhqu2xO/qTCgVkPj4w6cxGU8cGDhIkzdPq2', 3, '0000003'),
(16, 'tenant3_admin_user2', '$2y$10$joR1bUJAY0APbqfvZANTVOhrpgWePl8GEx.nVxFywGh9Rvk.KB5YS', 2, '0000003'),
(22, 'xxxx', '$2y$10$YEb6fwrpzIcOeqXgJo3KYuoTCwOOgGGSwD/DXN1q39cLeZTHAhq8m', 2, '0000007'),
(23, 'aaaa', '$2y$10$bpTk744xU0CQlEdK.H5NEudYnF7GvIbwHYP9GzbCqmYIKRta.L9du', 3, '0000007'),
(25, 'bbbb', '$2y$10$94ldMRRLr9sIbKTkvdf2cO4hho663mYWO3yAUMK1UQ0cn.rR22t7.', 3, '0000007');

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
