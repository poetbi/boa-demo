-- 表的结构 `bs_demo_admin`

CREATE TABLE `bs_demo_admin` (
  `id` int UNSIGNED NOT NULL COMMENT '主键',
  `user` varchar(20) COLLATE utf8mb4_bin NOT NULL COMMENT '用户',
  `pass` char(32) COLLATE utf8mb4_bin NOT NULL COMMENT '密码',
  `memo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '说明'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='管理员';

-- 表中的数据 `bs_demo_admin`

INSERT INTO `bs_demo_admin` (`id`, `user`, `pass`, `memo`) VALUES
(1, 'poetbi', '', '超级管理员：拥有全部权限'),
(2, 'admin', '', '内容管理员：可以管理资讯');


-- 表的结构 `bs_demo_category`

CREATE TABLE `bs_demo_category` (
  `id` int UNSIGNED NOT NULL COMMENT '主键',
  `alias` varchar(20) COLLATE utf8mb4_bin NOT NULL COMMENT '目录名',
  `title` varchar(30) COLLATE utf8mb4_bin NOT NULL COMMENT '分类名',
  `sort` int NOT NULL DEFAULT '0' COMMENT '排序：从小到大'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='分类';

-- 表中的数据 `bs_demo_category`

INSERT INTO `bs_demo_category` (`id`, `alias`, `title`, `sort`) VALUES
(1, 'yule', '娱乐', 0),
(3, 'keji', '科技', 0),
(4, 'film', '电影', 0),
(5, 'yinyue', '音乐', -1);


-- 表的结构 `bs_demo_group`

CREATE TABLE `bs_demo_group` (
  `id` int UNSIGNED NOT NULL COMMENT '主键',
  `name` varchar(20) COLLATE utf8mb4_bin NOT NULL COMMENT '组名',
  `memo` varchar(255) COLLATE utf8mb4_bin NOT NULL COMMENT '说明'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='用户组';

-- 表中的数据 `bs_demo_group`

INSERT INTO `bs_demo_group` (`id`, `name`, `memo`) VALUES
(1, '普通用户', '默认注册用户，不能发文章'),
(2, 'VIP用户', 'VIP组，拥有全部权限');


-- 表的结构 `bs_demo_news`

CREATE TABLE `bs_demo_news` (
  `id` int UNSIGNED NOT NULL COMMENT '主键',
  `cid` int UNSIGNED NOT NULL COMMENT '分类ID',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态：0=待审 1=发布',
  `user` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '作者',
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '标题',
  `content` text COLLATE utf8mb4_bin NOT NULL COMMENT '内容',
  `addtime` int UNSIGNED NOT NULL COMMENT '添加时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='文章';

-- 表中的数据 `bs_demo_news`

INSERT INTO `bs_demo_news` (`id`, `cid`, `status`, `user`, `title`, `content`, `addtime`) VALUES
(3, 5, 1, 'abc', '223542353463', '<p>23423423d</p>\r\n<p>23423423d</p>\r\n<p>23423423d</p>\r\n<p>23423423d</p>\r\n<p>23423423d</p>\r\n<p>23423423d</p>\r\n<p>23423423d</p>\r\n<p>23423423d</p>\r\n', 1696749534);


-- 表的结构 `bs_demo_user`

CREATE TABLE `bs_demo_user` (
  `id` int UNSIGNED NOT NULL COMMENT '主键',
  `gid` int UNSIGNED NOT NULL DEFAULT '1' COMMENT '组ID',
  `user` varchar(20) COLLATE utf8mb4_bin NOT NULL COMMENT '用户',
  `pass` char(32) COLLATE utf8mb4_bin NOT NULL COMMENT '密码',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别：0=女，1=男',
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Email',
  `regtime` int UNSIGNED NOT NULL COMMENT '注册时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='用户';

-- 表中的数据 `bs_demo_user`

INSERT INTO `bs_demo_user` (`id`, `gid`, `user`, `pass`, `sex`, `email`, `regtime`) VALUES
(2, 2, 'abc', '', 1, 'poetbi@163.com', 0);

-- 表的索引 `bs_demo_admin`
ALTER TABLE `bs_demo_admin`
  ADD PRIMARY KEY (`id`);

-- 表的索引 `bs_demo_category`
ALTER TABLE `bs_demo_category`
  ADD PRIMARY KEY (`id`);

-- 表的索引 `bs_demo_group`
ALTER TABLE `bs_demo_group`
  ADD PRIMARY KEY (`id`);

-- 表的索引 `bs_demo_news`
ALTER TABLE `bs_demo_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cid` (`cid`);

-- 表的索引 `bs_demo_user`
ALTER TABLE `bs_demo_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

-- 使用表AUTO_INCREMENT `bs_demo_admin`
ALTER TABLE `bs_demo_admin`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=4;

-- 使用表AUTO_INCREMENT `bs_demo_category`
ALTER TABLE `bs_demo_category`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=6;

-- 使用表AUTO_INCREMENT `bs_demo_group`
ALTER TABLE `bs_demo_group`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=3;

-- 使用表AUTO_INCREMENT `bs_demo_news`
ALTER TABLE `bs_demo_news`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=4;

-- 使用表AUTO_INCREMENT `bs_demo_user`
ALTER TABLE `bs_demo_user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=3;
