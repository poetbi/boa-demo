
--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `nickname` varchar(15) DEFAULT NULL,
  `avatar` varchar(150) DEFAULT NULL,
  `regtime` int(10) UNSIGNED DEFAULT NULL,
  `logtime` int(10) UNSIGNED DEFAULT NULL,
  `regip` varchar(50) DEFAULT NULL,
  `logip` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user_code`
--

CREATE TABLE `user_code` (
  `id` int(10) UNSIGNED NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `vcode` char(4) NOT NULL,
  `atime` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user_reset`
--

CREATE TABLE `user_reset` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `vcode` char(6) NOT NULL,
  `atime` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转储表的索引
--

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD KEY `email` (`email`);

--
-- 表的索引 `user_code`
--
ALTER TABLE `user_code`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mobile` (`mobile`);

--
-- 表的索引 `user_reset`
--
ALTER TABLE `user_reset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `user_code`
--
ALTER TABLE `user_code`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `user_reset`
--
ALTER TABLE `user_reset`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;
