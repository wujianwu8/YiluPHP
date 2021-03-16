
CREATE TABLE `sub_table_manage` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `main_table` varchar(32) COLLATE utf8mb4_general_ci NOT NULL COMMENT '主表名称',
  `sub_table` varchar(64) COLLATE utf8mb4_general_ci NOT NULL COMMENT '分表名称',
  `connection` varchar(64) COLLATE utf8mb4_general_ci NOT NULL COMMENT '数据库连接的名称',
  `model_name` varchar(64) COLLATE utf8mb4_general_ci NOT NULL COMMENT '模型类的名称',
  `count` int unsigned NOT NULL DEFAULT '0' COMMENT '表中的数据量每天更新一次',
  `start_time` int unsigned NOT NULL COMMENT '启用时间',
  `end_time` int NOT NULL DEFAULT '0' COMMENT '结束时间',
  `create_time` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_unique` (`main_table`,`sub_table`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='主表和分表的管理';
