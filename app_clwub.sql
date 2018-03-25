-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018-02-28 17:43:51
-- 服务器版本： 5.5.56-log
-- PHP Version: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_clwub`
--

-- --------------------------------------------------------

--
-- 表的结构 `blog_details`
--

CREATE TABLE `blog_details` (
  `id` int(10) NOT NULL,
  `first` tinyint(1) NOT NULL DEFAULT '0' COMMENT '帖子回复（1=帖子，0=回复）',
  `tid` int(10) NOT NULL COMMENT '帖子id',
  `pid` int(10) DEFAULT NULL,
  `authorid` int(10) NOT NULL COMMENT '发贴人id',
  `title` varchar(600) NOT NULL COMMENT '帖子标题',
  `content` mediumtext NOT NULL COMMENT '帖子/回帖内容',
  `addtime` int(12) NOT NULL COMMENT '发布时间',
  `replycount` int(12) NOT NULL DEFAULT '0' COMMENT '帖子的回复数量',
  `hits` int(12) NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `attachment` smallint(3) DEFAULT NULL COMMENT '帖子附件',
  `isdel` int(2) DEFAULT '0' COMMENT '是否放入回收站（1=是，0=否）',
  `style` char(10) DEFAULT NULL COMMENT '帖子标题颜色（css样式）'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='帖子信息表';

--
-- 转存表中的数据 `blog_details`
--

INSERT INTO `blog_details` (`id`, `first`, `tid`, `pid`, `authorid`, `title`, `content`, `addtime`, `replycount`, `hits`, `attachment`, `isdel`, `style`) VALUES
(1, 1, 0, 0, 1, '第一个标题', '第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点第一个帖子多写一点', 1514466117, 3, 2, NULL, 0, NULL),
(98, 1, 0, 9, 1, '第二个帖子', '第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多第二个帖子的内容也很多', 1514467243, 3, 0, NULL, 0, NULL),
(99, 1, 0, 5, 1, '第三个帖子', '第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多第三个帖子的内容照样多v', 1514467298, 3, 0, NULL, 0, NULL),
(100, 1, 0, 6, 1, '第四个帖子', '第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示第四个帖子在首页不展示', 1514467354, 3, 6, NULL, 0, NULL),
(101, 1, 0, 4, 1, '第五个帖子', '五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够五个帖子还不够', 1514519740, 3, 4, NULL, 0, NULL),
(102, 1, 0, 2, 1, '第六个帖子', '六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页六个帖子凑完两页', 1514519778, 3, 40, NULL, 0, NULL),
(103, 1, 0, 3, 1, '第七个帖子', '七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页七个帖子终于翻页', 1514519861, 3, 220, NULL, 0, NULL),
(104, 0, 103, NULL, 2, '', '回复一下，感觉自己棒棒哒\r\n回复一下，感觉自己棒棒哒\r\n回复一下，感觉自己棒棒哒\r\n回复一下，感觉自己棒棒哒\r\n回复一下，感觉自己棒棒哒\r\n回复一下，感觉自己棒棒哒\r\n回复一下，感觉自己棒棒哒\r\n回复一下，感觉自己棒棒哒\r\n回复一下，感觉自己棒棒哒\r\n回复一下，感觉自己棒棒哒\r\n回复一下，感觉自己棒棒哒\r\n', 1514537283, 3, 0, NULL, 0, NULL),
(105, 0, 103, NULL, 2, '', '继续回复不要停，\r\n继续回复不要停，\r\n继续回复不要停，\r\n继续回复不要停，\r\n继续回复不要停，\r\n继续回复不要停，\r\n继续回复不要停，\r\n继续回复不要停，\r\n继续回复不要停，\r\n继续回复不要停，\r\n继续回复不要停，\r\n继续回复不要停，\r\n', 1514539320, 3, 0, NULL, 0, NULL),
(106, 0, 103, NULL, 2, '', '我的回复顶破天\r\n我的回复顶破天\r\n我的回复顶破天\r\n我的回复顶破天\r\n我的回复顶破天\r\n我的回复顶破天\r\n我的回复顶破天\r\n我的回复顶破天\r\n我的回复顶破天\r\n我的回复顶破天\r\n我的回复顶破天\r\n我的回复顶破天\r\n我的回复顶破天\r\n我的回复顶破天\r\n我的回复顶破天\r\n我的回复顶破天\r\nvv', 1514539366, 3, 1, NULL, 0, NULL),
(107, 0, 103, NULL, 2, '', '友善的讨论一下下友善的讨论一下下\r\n友善的讨论一下下\r\n友善的讨论一下下\r\n友善的讨论一下下\r\n友善的讨论一下下\r\n友善的讨论一下下\r\n友善的讨论一下下\r\n友善的讨论一下下\r\n友善的讨论一下下\r\n友善的讨论一下下\r\n友善的讨论一下下\r\n友善的讨论一下下\r\n\r\n', 1514539450, 3, 0, NULL, 0, NULL),
(108, 0, 103, NULL, 2, '', '回复回复一点都不累\r\n回复回复一点都不累\r\n回复回复一点都不累\r\n回复回复一点都不累\r\n回复回复一点都不累\r\n回复回复一点都不累\r\n回复回复一点都不累\r\n回复回复一点都不累\r\n回复回复一点都不累\r\n回复回复一点都不累\r\n回复回复一点都不累\r\n回复回复一点都不累\r\n回复回复一点都不累\r\n', 1514539511, 3, 0, NULL, 0, NULL),
(109, 0, 103, NULL, 1, '', '楼上女人哭喊夫妻吵架没有人管', 1514615080, 3, 1, NULL, 0, NULL),
(110, 0, 103, NULL, 1, '', '*谁来斗胆讲仙丹会断肠*', 1514615765, 3, 0, NULL, 0, NULL),
(111, 0, 103, 3, 1, '', '以前我说，，每个人', 1514616313, 3, 0, NULL, 0, NULL),
(112, 0, 103, 3, 1, '', '波若波罗蜜', 1514616503, 3, 0, NULL, 0, NULL),
(113, 0, 103, 3, 1, '', '故事的结局不需要任何说明', 1514617218, 3, 0, NULL, 0, NULL),
(118, 1, 0, 8, 1, '再来一个帖子', '再拉了一个忒儿子', 1514623142, 3, 18, NULL, 0, NULL),
(120, 0, 103, 3, 1, '', '如今一个人听歌总是会觉得失落', 1514720971, 3, 0, NULL, 0, NULL),
(122, 0, 118, 3, 5, '', '到此一游', 1514783000, 3, 0, NULL, 0, NULL),
(123, 0, 103, 3, 6, '', 'av', 1514783690, 3, 0, NULL, 0, NULL),
(124, 0, 118, 3, 5, '', '1', 1514803983, 3, 0, NULL, 0, NULL),
(125, 0, 118, 3, 5, '', '2', 1514804189, 3, 0, NULL, 0, NULL),
(126, 0, 102, 3, 1, '', '回复一下下', 1514804520, 3, 0, NULL, 0, NULL),
(127, 1, 0, 8, 1, '九个帖子九个帖子', '操吴戈兮被犀甲，车错毂兮短兵接。\r\n旌蔽日兮敌若云，矢交坠兮士争先。\r\n凌余阵兮躐余行，左骖殪兮右刃伤。\r\n霾两轮兮絷四马，援玉枹兮击鸣鼓。\r\n天时怼兮威灵怒，严杀尽兮弃原野。\r\n出不入兮往不反，平原忽兮路超远。\r\n带长剑兮挟秦弓，首身离兮心不惩。\r\n诚既勇兮又以武，终刚强兮不可凌。\r\n身既死兮神以灵，子魂魄兮为鬼雄。', 1514806971, 3, 52, NULL, 0, NULL),
(128, 0, 127, 3, 1, '', '这个帖子的图片怎么和上个帖子一样呢', 1514807009, 3, 1, NULL, 0, NULL),
(129, 0, 127, 3, 5, '', '没事，这张图片很好看', 1514807109, 3, 0, NULL, 0, NULL),
(130, 0, 127, 3, 5, '', '现在是北京时间', 1514811714, 3, 0, NULL, 0, NULL),
(131, 0, 127, 3, 5, '', '对不对啊', 1514813721, 3, 0, NULL, 0, NULL),
(136, 0, 127, 3, 1, '', '凉凉夜色为你思念成河', 1514853116, 3, 0, NULL, 0, NULL),
(137, 0, 127, 3, 1, '', '化作春泥呵护着我', 1514854152, 3, 0, NULL, 0, NULL),
(138, 0, 127, 3, 1, '', '在水一方', 1514854580, 3, 0, NULL, 0, NULL),
(139, 1, 0, 6, 1, '刚发表的文章', '刚发表的文章', 1514862610, 3, 1, NULL, 0, NULL),
(140, 1, 0, 9, 1, '第二个刚发表的文章', '第二个刚发表的文章', 1514862740, 3, 39, NULL, 0, NULL),
(141, 0, 140, 3, 1, '', '回复一个', 1514862756, 3, 0, NULL, 0, NULL),
(143, 0, 140, NULL, 12, '', '我觉得还行', 1519464718, 3, 0, NULL, 1, NULL),
(145, 1, 0, 2, 1, '像少年啦飞驰', '作为货的我，站在后车厢里，手抓着栏杆，望着这个县城，春风沉醉。虽然我的脸上还是疼，但是我能吹到风，虽然我的旁边有铁栏杆，但是我能纵身一跃，拍死在公路上，这已经多么自由。\r\n\r\n我要从这里出发，沿着 318 号国道，开到那里的尽头。不要以为这只是一场肤浅的自驾游，不要以为我是无根的漂泊，我的根深深地扎在这片土地上，我一度以为自己是种子，被这季风吹来吹去，但是我终于意识到，我不是种子，我就是连着根的植物，至于我是一棵什么样的植物，我看不到我自己，那得问其他的植物，至于我为什么一直在换地方，因为我以为我扎在泥土里，但其实我扎在了流沙中。这么多年来，一直是我脚下的流沙裹着我四处漂泊，它也不淹没我，它只是时不时提醒我，你没有别的选择，否则你就被风吹走了。我就这么浑浑噩噩地度过了我所有热血的岁月，被裹到东，被裹到西，连我曾经所鄙视的种子都不如。一直到一周以前，我对流沙说，让风把我吹走吧。流沙说，你没了根，马上就死。  我说，我存够了水，能活一阵子。流沙说，但是风会把你无休止的留在空中，你就脱水了。我说，我还有雨水。流沙说，雨水要流到大地上，才能够积蓄成水塘，它在空中的时候，只是一个装饰品。我说，我会掉到水塘里的。流沙说，那你就淹死了。我说，让我试试吧。流沙说，我把你拱到小沙丘上，你低头看看，多少像你这样的植物，都是依附着我们。我说，有种你就把我抬得更高一点，让我看看普天下所有的植物，是不是都是像我们这样生活着。流沙说，你怎么能反抗我。我要吞没你。我说，那我就让西风带走我。于是我毅然往上一挣扎，其实也没有费力。我离开了流沙，往脚底下一看，操，原来我不是一个植物，我是一只动物，这帮孙子骗了我二十多年。作为一个有脚的动物，我终于可以决定我的去向。我回头看了流沙一眼，流沙说，你走吧，别告诉别的植物其实他们是动物。我要去向我的目的地。我要去那里支援我的兄弟们。', 1519522932, 3, 7, NULL, 1, NULL),
(146, 0, 145, NULL, 1, '', '我也这样觉得', 1519523166, 3, 0, NULL, 1, NULL),
(147, 0, 145, NULL, 1, '', '扎铁了老心', 1519523262, 3, 0, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `blog_gallery`
--

CREATE TABLE `blog_gallery` (
  `pid` int(10) NOT NULL,
  `path` varchar(600) NOT NULL COMMENT '帖子标题',
  `contents` mediumtext NOT NULL COMMENT '帖子/回帖内容',
  `attachment` smallint(3) DEFAULT NULL COMMENT '帖子附件',
  `isdel` int(2) DEFAULT '0' COMMENT '是否放入回收站（1=是，0=否）',
  `style` char(10) DEFAULT NULL COMMENT '帖子标题颜色（css样式）',
  `isdisplay` int(2) NOT NULL DEFAULT '0' COMMENT '是否屏蔽回复内容（1=是，0=否）'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='帖子信息表';

--
-- 转存表中的数据 `blog_gallery`
--

INSERT INTO `blog_gallery` (`pid`, `path`, `contents`, `attachment`, `isdel`, `style`, `isdisplay`) VALUES
(0, '/images/img8.jpg', '彩虹六号：围攻基本可以说是育碧磨剑之作了，优秀的场景破坏效果，探员之间的战术配合，成为了玩家们的最爱', NULL, 0, NULL, 0),
(1, '/images/img9.jpg', '盐漠是幽灵行动：荒野中最具特色的场景之一，截图旅游不虚此行', NULL, 0, NULL, 0),
(2, '/images/img10.jpg', '玻利维亚的景色美不胜收，同时这种和孤岛危机3、4一样的地图设计也大大减少了城镇区域，增加了野外面积', NULL, 0, NULL, 0),
(3, '/images/img11.jpg', '育碧的美工没得黑，每个游戏的logo都很有意境', NULL, 0, NULL, 0),
(4, '/images/img12.jpg', ' 幽灵行动：荒野中的最终BOSS，但是实际上在游戏中这个BOSS并没有起到什么推动剧情的作用', NULL, 0, NULL, 0),
(5, '/images/img13.jpg', '全景封锁的初期时间线，新型天花病毒大爆发，幸存下来的人民纷纷涌向隔离区', NULL, 0, NULL, 0),
(6, '/images/img14.jpg', '一夜之间很多曼哈顿的公共区域被废弃，杂乱不堪的场景大部分时间会成为探索和交火的战场', NULL, 0, NULL, 0),
(7, '/images/img15.jpg', '幽灵行动：荒野中有多重载具供特工们选择，但是由于荒野的地图设计，很多车辆都是拿来越野的', NULL, 0, NULL, 0),
(8, '/images/img16.jpg', '游戏中的跑车类型十分单调，只有肌肉车和兰博跑车两款，而且并没有比其他车辆好到哪里去', NULL, 0, NULL, 0),
(9, '/images/img17.jpg', '彩虹六号：围攻基本可以说是育碧磨剑之作了，优秀的场景破坏效果，探员之间的战术配合，成为了玩家们的最爱', NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `blog_link`
--

CREATE TABLE `blog_link` (
  `lid` smallint(6) NOT NULL,
  `name` varchar(30) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` mediumtext,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `blog_link`
--

INSERT INTO `blog_link` (`lid`, `name`, `url`, `description`, `logo`) VALUES
(1, 'steam商城', 'http://http://store.steampowered.com/', '不要问为什么，买就对了', 'public/img/friendUp1.gif'),
(2, 'Gamker的游戏频道', 'http://space.bilibili.com/13297724#/', '非常有价值的游戏品测UP主', ''),
(3, '游民星空', 'http://www.gamersky.com/', '游戏新闻更新很及时', ''),
(4, 'S1论坛', 'https://bbs.saraba1st.com/2b/forum.php', '有意思的吹比灌水论坛', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `blog_msg`
--

CREATE TABLE `blog_msg` (
  `id` int(11) NOT NULL COMMENT '序号',
  `name` varchar(200) NOT NULL COMMENT '名称',
  `content` varchar(255) NOT NULL COMMENT '内容',
  `isset` tinyint(2) DEFAULT NULL COMMENT '判断（1=是。0=否）'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `blog_msg`
--

INSERT INTO `blog_msg` (`id`, `name`, `content`, `isset`) VALUES
(1, 'webTitle', '若游所思', 0),
(2, 'webName', '若游所思-个人博客', NULL),
(3, 'webUrl', 'http://www.clwub.xin/', NULL),
(4, 'webCode', '京ICP备 89273号', NULL),
(5, 'webInfo', '欢迎来到“若游所思”博客空间，在这里我会发表在游戏游玩时产生的感想、一些简单的游戏测评、游戏中的美景截图和一些有意思的彩蛋，欢迎大家积极交流。', NULL),
(7, 'webMore', '游戏之所以被称为第九艺术，是因为在他那不断蓬勃发展，日新月异的外表形式下，被掩盖的内核与电影、文学和音乐等其他八大艺术是相近的，都可以在与人们的互动中传递很多思想价值。而且其互动性，沉浸体验，叙事能力，思想交互甚至可以说是综合几首了其他艺术形式的长处，假以强大的科技发展，达到了很高的艺术形态。', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `blog_user`
--

CREATE TABLE `blog_user` (
  `uid` int(11) NOT NULL,
  `username` char(16) NOT NULL COMMENT '账号',
  `password` char(32) NOT NULL COMMENT '密码（md5加密）',
  `email` char(30) DEFAULT NULL COMMENT '邮箱',
  `undertype` tinyint(2) NOT NULL DEFAULT '0' COMMENT '账号类型（1=管理员，0=普通用户）',
  `regtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `picture` varchar(255) NOT NULL DEFAULT '/images/avatar.png' COMMENT '头像',
  `phone` char(13) NOT NULL COMMENT '手机号码',
  `autograph` varchar(500) DEFAULT NULL COMMENT '个人签名',
  `allowlogin` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否允许登录（0=允许，1=不允许）'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户基本资料表';

--
-- 转存表中的数据 `blog_user`
--

INSERT INTO `blog_user` (`uid`, `username`, `password`, `email`, `undertype`, `regtime`, `picture`, `phone`, `autograph`, `allowlogin`) VALUES
(1, 'adminn', '9c1ad00a16a7c67e2727b471ac969e96', '574@qq.com', 1, '2018-02-24 04:40:38', '/images/face/5a91295035b16.jpeg', '17671703026', '<p>\r\n	我就是admin</p>\r\n', 0),
(2, 'xiaohua', 'ee755bdd4adb8ac6270ef476fefab245', 'xiaohua@xx.com', 0, '2018-02-24 04:40:38', '/images/avatar.png', '13241253453', NULL, 0),
(4, 'xiaolan', 'da5d9acc91d6628e6e1c4c99fe808913', NULL, 0, '2018-02-24 04:40:38', '/images/avatar.png', '18871885777', NULL, 0),
(5, 'xiaofen', '02f510c04985a3f37b1b25c51cc0a079', NULL, 0, '2018-02-24 04:40:38', '/images/avatar.png', '18871885775', NULL, 0),
(6, 'a123456', 'dc483e80a7a0bd9ef71d8cf973673924', NULL, 0, '2018-02-24 04:40:38', '/images/avatar.png', '15702459965', NULL, 1),
(12, 'xiaoming', '97304531204ef7431330c20427d95481', NULL, 0, '2018-02-24 05:16:25', '/images/face/5a91311d8612e.jpeg', '17671703025', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_details`
--
ALTER TABLE `blog_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_gallery`
--
ALTER TABLE `blog_gallery`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `blog_link`
--
ALTER TABLE `blog_link`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `blog_msg`
--
ALTER TABLE `blog_msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_user`
--
ALTER TABLE `blog_user`
  ADD PRIMARY KEY (`uid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `blog_details`
--
ALTER TABLE `blog_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;
--
-- 使用表AUTO_INCREMENT `blog_gallery`
--
ALTER TABLE `blog_gallery`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- 使用表AUTO_INCREMENT `blog_link`
--
ALTER TABLE `blog_link`
  MODIFY `lid` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- 使用表AUTO_INCREMENT `blog_msg`
--
ALTER TABLE `blog_msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '序号', AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `blog_user`
--
ALTER TABLE `blog_user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
