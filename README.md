#  README

==========

## 中信建投与华尔街见闻资讯合作脚本使用方法。

-----------------

####初始环境搭建
php5.6 + mysql
创建数据库
修改 src/config/config.php 相关数据库配置


####主要有三个脚本文件
1. public/init.php
2. public/cron.php
3. public/pick.php

####脚本简介及脚本使用方法

**public/init.php**

简介：初始化脚本，导入见闻旧的数据

初始工作：首先命令行进入mysql，use 相应数据库 执行命令 
> SOURCE data/init_livenews.sql; SOURCE /data/livenews.sql

运行方法
> php public/init.php

**public/cron.php**
简介：同步新数据脚本，加入定时任务，对接口进行轮询。建议1-3分钟执行一次

运行方法
> php public/cron.php

**public/pick.php**
简介：补充数据，用来补充缺漏的数据，传入时间戳参数
运行方法  
> php public/pick.php {start} {end}

示例
>php public/pick.php 1451577600 1452441600    #同步2016-01-01到2016-01-10的数据

>php public/pick.php   #不填参数，默认同步一个星期前到今天的数据