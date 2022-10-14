/*
 Navicat Premium Data Transfer

 Source Server         : myCon
 Source Server Type    : MySQL
 Source Server Version : 100315
 Source Host           : localhost:3306
 Source Schema         : comic

 Target Server Type    : MySQL
 Target Server Version : 100315
 File Encoding         : 65001

 Date: 15/04/2020 13:05:31
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `adminid` int(11) NOT NULL AUTO_INCREMENT,
  `adminname` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`adminid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (4, 'admin', '202cb962ac59075b964b07152d234b70');
INSERT INTO `admins` VALUES (5, 'zhouhaibo', 'e10adc3949ba59abbe56e057f20f883e');

-- ----------------------------
-- Table structure for area
-- ----------------------------
DROP TABLE IF EXISTS `area`;
CREATE TABLE `area`  (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `areaname` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`aid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of area
-- ----------------------------
INSERT INTO `area` VALUES (4, '中国大陆');
INSERT INTO `area` VALUES (5, '韩国');
INSERT INTO `area` VALUES (8, '英国');
INSERT INTO `area` VALUES (9, '日本');
INSERT INTO `area` VALUES (10, '美国');

-- ----------------------------
-- Table structure for collect
-- ----------------------------
DROP TABLE IF EXISTS `collect`;
CREATE TABLE `collect`  (
  `clid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  PRIMARY KEY (`clid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of collect
-- ----------------------------
INSERT INTO `collect` VALUES (1, 4, 18);
INSERT INTO `collect` VALUES (2, 4, 19);
INSERT INTO `collect` VALUES (3, 31, 2);
INSERT INTO `collect` VALUES (4, 4, 31);
INSERT INTO `collect` VALUES (5, 4, 22);
INSERT INTO `collect` VALUES (6, 29, 2);
INSERT INTO `collect` VALUES (7, 32, 3);
INSERT INTO `collect` VALUES (8, 4, 28);

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`  (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cdate` datetime(0) NOT NULL,
  `uid` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  PRIMARY KEY (`cid`) USING BTREE,
  INDEX `FK_comments_uid`(`uid`) USING BTREE,
  INDEX `FK_comments_vid`(`vid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES (1, '很好!推荐!!', '2020-02-07 11:39:54', 4, 2);
INSERT INTO `comments` VALUES (3, '适合小朋友!', '2020-02-07 11:46:20', 4, 23);
INSERT INTO `comments` VALUES (4, '推荐', '2020-02-07 12:20:12', 32, 18);
INSERT INTO `comments` VALUES (5, '很美！！', '2020-02-07 12:21:25', 32, 21);
INSERT INTO `comments` VALUES (7, '小朋友很喜欢！', '2020-02-07 13:08:22', 7, 2);
INSERT INTO `comments` VALUES (8, '很好看', '2020-02-08 18:03:09', 29, 2);

-- ----------------------------
-- Table structure for levels
-- ----------------------------
DROP TABLE IF EXISTS `levels`;
CREATE TABLE `levels`  (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `vid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`lid`) USING BTREE,
  INDEX `FK_levels_vid`(`vid`) USING BTREE,
  INDEX `FK_levels_uid`(`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of levels
-- ----------------------------
INSERT INTO `levels` VALUES (1, 2, 4, 5);
INSERT INTO `levels` VALUES (2, 1, 4, 4);
INSERT INTO `levels` VALUES (3, 21, 4, 4);
INSERT INTO `levels` VALUES (4, 2, 7, 4);
INSERT INTO `levels` VALUES (5, 2, 6, 5);
INSERT INTO `levels` VALUES (6, 2, 5, 5);
INSERT INTO `levels` VALUES (7, 2, 32, 4);
INSERT INTO `levels` VALUES (8, 2, 31, 3);
INSERT INTO `levels` VALUES (9, 32, 4, 4);
INSERT INTO `levels` VALUES (10, 20, 4, 3);
INSERT INTO `levels` VALUES (11, 23, 4, 5);

-- ----------------------------
-- Table structure for praise
-- ----------------------------
DROP TABLE IF EXISTS `praise`;
CREATE TABLE `praise`  (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `vid` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0-已取消赞；1-有效赞；',
  PRIMARY KEY (`pid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of praise
-- ----------------------------
INSERT INTO `praise` VALUES (1, 4, 18, 1);
INSERT INTO `praise` VALUES (2, 4, 19, 1);
INSERT INTO `praise` VALUES (3, 4, 19, 1);
INSERT INTO `praise` VALUES (4, 4, 19, 1);
INSERT INTO `praise` VALUES (5, 4, 19, 0);
INSERT INTO `praise` VALUES (6, 4, 19, 0);
INSERT INTO `praise` VALUES (7, 4, 19, 0);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `tel` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `photo` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `createtime` datetime(0) NOT NULL,
  `updatetime` timestamp(0) NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 34 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (4, '王思琪', 'e10adc3949ba59abbe56e057f20f883e', 1, '13500797654', '20200415070305215.jpg', 'wang@163.com', '2020-01-22 20:48:46', '2020-04-15 13:03:05');
INSERT INTO `users` VALUES (5, '周杰伦', 'e10adc3949ba59abbe56e057f20f883e', 0, '18600989765', '20200122135016375.jpg', 'zhoujielun@163.com', '2020-01-22 20:50:16', '2020-01-22 20:50:16');
INSERT INTO `users` VALUES (6, '王菲', '202cb962ac59075b964b07152d234b70', 1, '13500987653', '20200415070316389.jpg', 'wangfei@163.com', '2020-01-22 20:52:08', '2020-04-15 13:03:16');
INSERT INTO `users` VALUES (7, '张晓明', '202cb962ac59075b964b07152d234b70', 0, '18687654322', '20200122135941310.jpg', 'wangfei@163.com', '2020-01-22 20:59:41', '2020-01-22 20:59:41');
INSERT INTO `users` VALUES (33, 'test', '202cb962ac59075b964b07152d234b70', 0, '13500123459', '20200415070323664.jpg', 'test7@163.com', '2020-04-08 21:11:16', '2020-04-15 13:03:23');

-- ----------------------------
-- Table structure for videos
-- ----------------------------
DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos`  (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `videoname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '电影名称',
  `aid` int(11) NOT NULL COMMENT '区域',
  `pic` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '海报',
  `intro` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '简介',
  `createtime` datetime(0) NOT NULL,
  `updatetime` timestamp(0) NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP(0),
  `clicks` int(11) NOT NULL DEFAULT 0 COMMENT '点击次数',
  `downloads` int(11) NOT NULL DEFAULT 0 COMMENT '下载次数',
  `link` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '下载地址',
  PRIMARY KEY (`vid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of videos
-- ----------------------------
INSERT INTO `videos` VALUES (1, '哪吒', 4, '20200131104118487.jpg', '天地灵气孕育出一颗能量巨大的混元珠，元始天尊将混元珠提炼成灵珠和魔丸，灵珠投胎为人，助周伐纣时可堪大用；而魔丸则会诞出魔王，为祸人间。元始天尊启动了天劫咒语，3年后天雷将会降临，摧毁魔丸。太乙受命将灵珠托生于陈塘关李靖家的儿子哪吒身上。然而阴差阳错，灵珠和魔丸竟然被掉包。本应是灵珠英雄的哪吒却成了混世大魔王，这调皮捣蛋顽劣不堪的哪吒却徒有一颗做英雄的心。然而面对众人对哪吒的误解和即将来临的天雷的降临，哪吒是否命中注定会立地成魔，他将何去何从 [6]  。', '2020-01-31 15:50:36', '2020-04-10 09:50:32', 23, 0, 'video/哪吒.mp4');
INSERT INTO `videos` VALUES (2, '海洋奇缘', 10, '20200131085522607.jpg', '在2000年前的南太平洋小岛上，那里居住着一个爱好航海的波利尼西亚人部落，部落酋长有一个独生女叫莫阿娜，在祖母的鼓励下她一心想去探索临近的岛屿，但她的父亲不许。于是莫阿娜就在祖母死后，偷偷划船溜出岛，去寻找传说中的岛屿。她有两位同行的伙伴，一个是公鸡憨憨，一个是猪。莫阿娜一行在一座小岛上搁浅了，这时一座图腾雕像毛伊活了，他是南太平洋岛国神话里的超级英雄，可以变成鸟儿，身上刻着很多可以活过来的纹身，还有一个法宝是魔法鱼钩。接下来莫阿娜就和他一起前往开放的海洋、克服各种凶险，以完成祖先在一千年前未尽的航程', '2020-01-31 15:55:22', '2020-04-10 15:38:10', 71, 5, 'video/海洋奇缘.mp4');
INSERT INTO `videos` VALUES (3, '小黄人', 10, '20200131092345278.jpg', '时值上世纪60年代，小黄人三人组无意间看到了“坏蛋大会”广告，该大会声称世界第一女坏蛋斯嘉丽·杀人狂会出席大会并发表演讲。于是，三个小黄人搭上了银行抢劫犯的顺风车。在经历了一系列的坎坷之后，小黄人终于成为斯嘉丽的助手。它们为斯嘉丽执行的第一个任务就是盗取英国伊丽莎白女王的皇冠，任务进展的十分顺利，顺利到呆萌的鲍勃竟然莫名其妙的成为新任国王，于是一系列的麻烦接踵而至', '2020-01-31 15:59:33', '2020-04-10 09:51:15', 3, 0, 'video/小黄人.mp4');
INSERT INTO `videos` VALUES (8, '千与千寻', 9, '20200131094046847.jpg', '千寻和爸爸妈妈不慎进入了一个神秘隧道，进入了一个诡异的世界。爸爸妈妈因贪吃被变成了猪，千寻仓皇逃跑被小白所救，为了不被魔法变成别的东西，千寻找了一份工作，也为了就爸爸妈妈回来，千寻逐渐踏上了一段神奇的冒险之旅。', '2020-01-31 16:40:46', '2020-04-14 18:32:30', 1, 98, 'video/1.mp4');
INSERT INTO `videos` VALUES (9, '你的名字', 9, '20200131094131568.jpg', '一个是住在山村巫女世家却向往大城市生活的女孩宫水三叶，一个是生活在大都市为学业而忙碌的男孩立花泷，一个偶然的时机，两人交换了身体，开始体验上了对方的生活，本以为这样的生活会一直下去，然而两人并不知道在这一切的背后有着怎样的秘密，而这个秘密也让他们彼此的联系更加紧密。', '2020-01-31 16:41:31', '2020-04-14 20:14:34', 1, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (10, '哈尔的移动城堡', 9, '20200131094213578.jpg', '因为继母的原因，苏菲和两个妹妹被送到制帽店去当学徒，随著时间的推移只有苏菲一人坚持留了下来，而一个恶毒的巫婆因嫉妒把苏菲变成了一个80岁的老婆婆，并且让苏菲不能把这个秘密告诉他人，苏菲无奈之下只能离开小镇去往那个无人敢去的移动城堡，正是因为这一举动彻底改变了苏菲的命运。', '2020-01-31 16:42:13', '2020-01-31 16:42:13', 0, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (11, '幽灵公主', 9, '20200131094250827.jpg', '为了拯救村民，阿斯达卡的右手中了诅咒，为了解除诅咒他只得离开部落，在途中他遇到了幻姬和幽灵公主桑，而幽灵公主对幻姬在麒麟兽森林中开采矿石的行为恨之入骨，而此时一群人来猎杀麒麟兽并夺走了麒麟兽的头，被杀的麒麟兽的灵魂为夺回自己的头颅而大肆破坏森林，阿斯达卡和桑决定夺回麒麟兽的头颅。', '2020-01-31 16:42:50', '2020-01-31 16:42:50', 0, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (12, '悬崖上的金鱼姬', 9, '20200131094330614.jpg', '一次意外，金鱼姬被海潮冲进了一个瓶子中无法脱身。一个路过的男孩宗介救了金鱼姬，并把她带回了家中，在不断地相处中金鱼姬改变了宗介对生活的态度，一次海啸意外，宗介撞伤了身体，使金鱼姬染上了人类的血液，飘回了大海之中。然而大海中还有另一个不知名的世界存在着。。。', '2020-01-31 16:43:30', '2020-01-31 16:43:30', 0, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (13, '起风了', 9, '20200131094413124.jpg', '少年掘越二郎从小迷恋飞机，长大后由于对飞机的痴迷，他成为了一名飞机设计师，在大地震中他邂逅了一生的挚爱里见，分分合合后终于在一起，可惜那是一个被战争所笼罩的时代，二郎的梦想却成了杀人的机器，这也让他倍感矛盾。', '2020-01-31 16:44:13', '2020-04-10 09:49:22', 2, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (14, '借东西的小人阿莉埃蒂', 9, '20200131094450461.jpg', '患有心脏疾病的翔，为了手术做准备去了乡下静养，在乡间别墅里他无意中发现了借东西的小人阿莉埃蒂，而“小人一族”一旦被发现就要马上搬走，但是阿莉埃蒂告诉父母她相信这个世界上也有好人，在不断的相识中两人建立了深厚的友谊，但是也有别有用心的坏人在等着他们。', '2020-01-31 16:44:50', '2020-01-31 16:44:50', 0, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (15, '名侦探柯南：零的执行人', 9, '20200131094531941.jpg', '一场被定性为恐怖袭击的大规模爆炸，其嫌疑人竟是毛利小五郎，柯南为了帮毛利洗脱罪名而调查这个事件，不料却发现陷害毛利的人竟是安室透，到底安室透是敌是友，柯南不断调查却发现在这背后隐藏着更大的秘密，而这一切源于多年以前的一场事件。', '2020-01-31 16:45:31', '2020-01-31 16:45:31', 0, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (16, '哆啦A梦：伴我同行', 9, '20200131094556808.jpg', '这一次的故事讲述了大雄是如何和哆啦A梦相识的。这是哆啦A梦最初的故事，它讲述了在哆啦A梦的帮助下大雄是如何不再受欺负，并通过时光机实现了与静香结婚的理想，而这一切的经历也让大雄和哆啦A梦的友谊变得更加深刻。', '2020-01-31 16:45:56', '2020-04-14 18:32:25', 0, 9, 'video/1.mp4');
INSERT INTO `videos` VALUES (17, '.妖怪手表：诞生的秘密喵', 9, '20200131094650905.jpg', '由于妖怪手表的消失和巨型猫型妖怪的出现并声称世界即将沦陷，景太前往毛马本村，遇到了掌握手表消失真相的“浮游喵”，由此回到了六十年前的世界进行冒险，当然那里也有着强大的敌人在等着他们的到来。', '2020-01-31 16:46:50', '2020-01-31 16:46:50', 0, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (18, '大圣归来', 4, '20200131103234383.jpg', '这部电影讲述了已于五行山下寂寞沉潜五百年的孙悟空被儿时的唐僧——俗名江流儿的小和尚误打误撞地解除了封印，在相互陪伴的冒险之旅中找回初心，完成自我救赎的故事。话说江流儿也实在是太可爱了，直接让人有冲上去捏捏脸的冲动。并在2018国产电影票房排行榜前100中排在第27的位置。', '2020-01-31 16:57:46', '2020-04-10 09:50:12', 24, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (19, '白蛇缘起', 4, '20200131095825889.jpeg', '这部电影小编最近也有观看哦，画面和剧情简直不要太美，直击老夫的少女心呀。影片在中国民间传说“白蛇传”基础上有所创新，讲述白素贞与许仙的前身阿宣在五百年前之间一段刻骨铭心的爱情故事。观影结束后我便明白了原来动画中的白素贞也是美的没话说，好看的人从始至终都是好看。', '2020-01-31 16:58:25', '2020-02-06 13:45:28', 11, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (20, '大护法', 4, '20200131095844716.jpeg', '该片讲述了奕卫国大护法为了寻找本国太子误闯花生镇，并陷入了一场被欲望支配的阴谋中。这部电影可以说得上是“全新”的原创动画，影片中构建的人物、故事和世界观，共同组成一个“前所未见”的独特电影，画风独特，片中魔性怪诞的人物设计让人眼前一亮 ，人物形象真是可萌可酷。', '2020-01-31 16:58:44', '2020-02-06 13:15:34', 2, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (21, '大鱼海棠', 4, '20200131095908588.jpg', '“所有活着的人类，都是海里一条巨大的鱼”，这部电影引用了大量的神话故事，掺入了大量的东方元素，影片本来就是美得。故事情节则是意料之中却又出其不意。这部影片在上映之初就引发了一片轰动，票房打破了国内动画电影的记录，也引得许多电影明星为期点赞。在国漫排行榜2016前十名中在第六的位置。', '2020-01-31 16:59:08', '2020-04-14 18:32:20', 17, 32, 'video/大鱼海棠.mp4');
INSERT INTO `videos` VALUES (22, '魁拔', 4, '20200131095943545.jpeg', '这是在2011年开始推出的由王川执导的国产奇幻动画系列大电影。作品围绕主人公蛮吉等人，讲述了在架空的世界--元泱界中，天地两界共同合力对抗每隔333年诞生的可怕异常生命--魁拔的故事。这部电影目前共上映了三部，其中第二部最为成功，获得许多奖项。', '2020-01-31 16:59:43', '2020-02-07 14:36:51', 3, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (23, '麦兜响当当', 4, '20200131100017229.jpeg', '提起这部电影就是童年呀，麦兜可真是可爱到爆。这一系列属于中国香港的优秀作品，在2009年初现的时候，首日票房上千万，首周票房更是一举打破了国产动画电影的票房纪录，随后还获得了香港电影金像奖的提名。现在再回头看看麦兜，竟然看到的都是人生哲理呀，果然初闻不知剧中意，再看已是剧中人。', '2020-01-31 17:00:17', '2020-04-14 18:32:09', 6, 60, 'video/1.mp4');
INSERT INTO `videos` VALUES (24, '秦时明月之龙腾万里', 4, '20200131100046600.jpeg', '提起这部电影全都是情怀呀，最初我们了解的请时明月是电视版的动画片，秦时明月制作组算是国产动画崛起的先驱者之一了，秦时明月系列动画凭借出色的3D效果和细腻的人物刻画打开了国产动画的新篇章。', '2020-01-31 17:00:46', '2020-01-31 17:00:46', 0, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (25, '大世界', 4, '20200131100116711.jpeg', '这是一部成人动画电影，该片讲述了工地司机小张因抢劫巨款，而后被各路心怀鬼胎的人马追逐而引发的一连串荒诞故事。这部电影的知名度相对不高，但是它却入围了国际柏林电影节，这部影片的时间很短，只有75分钟，以简明的首笔勾勒出了真实的人性。', '2020-01-31 17:01:16', '2020-01-31 17:01:16', 0, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (26, '昨日青空', 4, '20200131100145296.jpeg', '这部影片一定程度上借鉴了日本动漫的长处，影片讲述了典型的中国式青春，这里的年轻人，他们讨厌考试，讨厌肥大的校服，却憧憬向往着爱情。这应该是我们每个人都有过的样子吧，这部电影会让大家产生很大的共鸣。', '2020-01-31 17:01:45', '2020-01-31 17:01:45', 0, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (27, '风语咒', 4, '20200131100211573.jpeg', '这是一部去年在国内上映的电影，影片讲述了朗明使用秘术“风语咒”封印四大凶兽之一“饕餮”的故事。整部片子充满中国哲学和美学元素，融合了五行学说，并且人物十分有侠义气概。', '2020-01-31 17:02:11', '2020-01-31 17:02:11', 0, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (28, '香肠派对', 10, '20200131101047941.jpg', '电影《香肠派对》是索尼影业全新力作的Ｒ级动画片，主人公就是一根香肠，该片主要是以这跟香肠从购物推车掉下来后与一帮新伙伴在超市里展开的一场疯狂而危险的旅程展开……\r\n然而，刺激的冒险之旅也不会一直持续，香肠君们必须在７月４日（美国国庆节）大打折之前复归原位。', '2020-01-31 17:10:47', '2020-02-08 18:43:05', 1, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (29, '冰雪奇缘2', 10, '20200131101235647.jpg', '勇敢无畏，一根筋直到底的安娜公主又将带来什么令人始料不及的故事呢？\r\n一直深怕自己的力量会再度伤害到人们的艾莎女王这次又是否会如她所想的那般给王国降至灾难呢？\r\n长年局于雪山之上的野外生存者与他那只忠心耿耿却又脏兮兮的驯鹿又将在冰天雪地里创造什么奇迹呢？\r\n因艾莎的魔力而诞生的雪宝是否能如愿迎接到夏日的暖分与骄阳呢？\r\n被皑皑白雪覆盖着的王国，漫天飘舞着雪花的国度，或将带来一次惊险刺激的冒险。\r\n善良的人们，王国的小鬼灵精们，他们的热情，他们的朝气，或将带来一段叫观众欢呼雀跃的惊奇之旅。', '2020-01-31 17:12:35', '2020-01-31 17:12:35', 0, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (30, '小羊肖恩', 8, '20200131101411910.jpg', '在英国某个小乡村的农场里，一名笨笨的农夫养着包括绵羊的一大群动物。绵羊群里有有只叫肖恩的小羊，它和农夫饲养的狗，以及农场里各种动物都快乐潇洒的生活在这个偌大的农场里。然而，绵羊们并不是表面上看起来那么温顺乖巧，它们在尽责吃草的同时还特别喜欢搞一些“业余”活动。这群看似兢兢业业在吃草的乖顺长毛羊羊实则总是异想天开，常常想出一些出人意料的“业余”活动的主意，因此闯祸总是在所难免。于是，这群活波好动又爱调皮捣蛋的小羊们让原本每日吃草的无聊生活变得生动有趣。它们有时会喜欢做各种运动，有时会和一墙之隔的三只小猪进行各种较劲。它们也可以趁着农夫不注意时拿卷心菜当球踢，也可以沉浸在自个儿开发的水彩画课程里，或者集体泡个舒舒服服的澡......总之，它们兴趣广泛没有限制，只要是能想得到的主意它们都会一一去尝试去实现，从而诞生出一个又一个搞笑可爱的故事。', '2020-01-31 17:14:11', '2020-01-31 17:14:11', 0, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (31, '驯龙高手2', 10, '20200131101520944.jpg', '继四年前上映的奇幻冒险动画电影《驯龙高手》在北美取得2.17亿美元，更在全球斩获5亿美元的不俗票房之后，如今续集《驯龙高手2》也在众多影迷的翘首以待中终于来袭了！这次新作品《驯龙高手2》的故事时间是从第一部的五年之后开始讲起，此时的博克岛上已经成为了龙的乐园，几乎每个居民都拥有自己的龙，没有龙的会被认为是异类，主人公小嗝嗝时隔五年也已经长大，并与他的飞龙没牙仔踏上了探索新大陆的冒险旅程。在旅程中，他们发现了一个神秘的冰洞，里面住着成千上万的新野生龙，并且有一个神秘的龙骑士。此时他们也发现自己已被卷入一场战争的中心地带，他们必须率领族人捍卫这片土地的平静.......在《驯龙高手2》中，除了剧情所讲的拯救龙族的线索之外，小嗝嗝与家人间的感情线也将会是贯穿全片的重点，而在第一部中所有台前配音以及幕后主创原班人马将悉数回归这部续集，打造原汁原味的真正续章！', '2020-01-31 17:15:20', '2020-02-08 18:48:44', 6, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (32, '头脑特工队', 10, '20200131101623280.jpg', '皮克斯动画制作室出品的动画电影《头脑特工队》再次展现了皮克斯团队非凡的想象力与创造力。影片将人类情绪划分为五大类，分别由五个小小人来担任，通过对它们活灵活现的刻画来探索人类大脑的形成。本次影片将由《怪兽公司》《飞屋环游记》的导演彼特·道格特执导。《头脑特工队》讲述的是发生在一个小女孩脑中的故事。女孩的名字叫莱利，十一岁，处于还在成长中的阶段，而成长的路总是磕磕绊绊，永远都不可能一帆风顺。莱利一家原本居住在明尼苏达，后来因为父亲要去旧金山开始一份新的工作和开启崭新的生活，还是小孩的她即使多么喜欢曾经熟悉的地方也不得不跟随大人的想法而迁居。和所有人一样，莱利虽是个懵懂无知的十一岁小女孩，但其也有自己各种各样的情绪，并被这些情绪所左右。这些情绪分别是：快乐、悲伤、厌恶、恐惧、愤怒，它们是居住在莱利脑袋控制中心的五个小小人。生活中，它们帮助莱利，在遇到问题时可以给她提供建议。当莱利面对旧金山的新生活时感到了前所未有的不适感，情感控制中心的小小人们也开始动荡起来。悲伤、厌恶、恐惧、愤怒的情绪开始不能自持，乱了分寸，莱利也因此陷入了各种恐慌、失望、沮丧的泥沼中。幸好，还有“快乐”这个情绪的小小人始终保持清醒的状态，以它乐观积极的态度，帮助莱利勇敢直面陌生环境，融入陌生人群，处理莱利在家庭和学校之间滋生的各种情感矛盾。', '2020-01-31 17:16:23', '2020-02-06 13:15:21', 8, 2, 'video/1.mp4');
INSERT INTO `videos` VALUES (33, 'video1', 5, '20200131102411624.jpg', '11', '2020-01-31 17:24:11', '2020-01-31 17:24:11', 0, 0, '1');
INSERT INTO `videos` VALUES (34, '疯狂动物城', 10, '20200131102832684.jpeg', '《疯狂动物城》该片主要讲述了，在一个所有动物和平共处的动物城市，兔子朱迪通过自己努力奋斗，最终完成了自己儿时的梦想，成为动物警察的故事。', '2020-01-31 17:28:32', '2020-01-31 17:28:32', 0, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (35, 'video4', 4, '20200204100133688.jpg', 'video4video4video4', '2020-02-04 17:01:33', '2020-02-04 17:01:33', 0, 0, 'video/1.mp4');
INSERT INTO `videos` VALUES (38, 'video41', 10, '20200410042045936.jpg', '12', '2020-04-10 10:20:22', '2020-04-10 10:20:45', 0, 0, '112');

SET FOREIGN_KEY_CHECKS = 1;
