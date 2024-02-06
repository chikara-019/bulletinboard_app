-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: mysql
-- 生成日時: 2024 年 2 月 06 日 02:22
-- サーバのバージョン： 8.0.35
-- PHP のバージョン: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `bbs_yt`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `bbs_table`
--

CREATE TABLE `bbs_table` (
  `id` int NOT NULL COMMENT '投稿者id',
  `username` varchar(100) DEFAULT NULL,
  `title` text COMMENT 'タイトル',
  `comment` text COMMENT '本文',
  `postdate` datetime DEFAULT NULL COMMENT '投稿日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='掲示板投稿管理テーブル';

--
-- テーブルのデータのダンプ `bbs_table`
--

INSERT INTO `bbs_table` (`id`, `username`, `title`, `comment`, `postdate`) VALUES
(14, 'a', 'b', 'c', '2024-02-05 11:29:56'),
(16, 'a', 'b', 'c', '2024-02-05 11:32:13'),
(17, 'user1', 'title1', 'comment1', '2024-02-05 11:34:45'),
(21, 'user1', 'title1', 'comment1', '2024-02-05 11:38:23'),
(22, 'user1', 'title1', 'comment1', '2024-02-05 11:38:23'),
(23, 'user1', 'title1', 'comment1', '2024-02-05 11:38:23'),
(34, 'user1', 'title1', 'comment1', '2024-02-05 11:38:23'),
(35, 'user1', 'title1', 'comment1', '2024-02-05 11:38:23'),
(45, 'user1', 'title1', 'comment1', '2024-02-05 11:38:23'),
(46, 'user1', 'title1', 'comment1', '2024-02-05 11:38:23'),
(47, 'user1', 'title1', 'comment1', '2024-02-05 11:38:23'),
(58, 'user1', 'title1', 'comment1', '2024-02-05 11:38:23'),
(59, 'user1', 'title1', 'comment1', '2024-02-05 11:38:23'),
(90, 'user1', 'title1', 'comment1', '2024-02-05 11:38:23'),
(91, 'user1', 'title1', 'comment1', '2024-02-05 11:38:23'),
(92, 'user1', 'title1', 'comment1', '2024-02-05 11:38:23'),
(93, 'user1', 'title1', 'comment1', '2024-02-05 11:38:23'),
(94, 'user1', 'title1', 'comment1', '2024-02-05 11:38:23'),
(95, 'user1', 'title1', 'comment1', '2024-02-05 11:38:23'),
(96, 'user1', 'title1', 'comment1', '2024-02-05 11:38:23'),
(222, 'user1', 'title1', 'comment1', '2024-02-05 11:38:23'),
(237, '1', '1', '1', '2024-02-05 17:48:48'),
(239, '3', '3', '3', '2024-02-05 17:48:59'),
(240, '4', '4', '4', '2024-02-05 17:49:06'),
(241, '5', '5', '5', '2024-02-05 17:49:14'),
(242, '6', '6', '6', '2024-02-05 17:49:21'),
(243, '7', '7', '7', '2024-02-05 17:50:08'),
(244, '8', '8', '8', '2024-02-05 17:50:12'),
(246, '10', '10', '10', '2024-02-05 17:50:22'),
(247, '11', '11', '11', '2024-02-05 17:50:30'),
(248, '12', '12', '12', '2024-02-05 17:50:34'),
(250, '100', '1001', '199', '2024-02-05 20:39:19'),
(254, 'aa', 'aa', 'aa', '2024-02-06 09:42:43'),
(255, 'aaa', 'aaa', '1q111', '2024-02-06 10:33:19');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `bbs_table`
--
ALTER TABLE `bbs_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `bbs_table`
--
ALTER TABLE `bbs_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT '投稿者id', AUTO_INCREMENT=256;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
