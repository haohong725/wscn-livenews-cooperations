<?php

/**
 * 初始化脚本
 */

require '../src/config/config.php';
require '../vendor/autoload.php';

use components\MySQLi;
use components\LivenewsHanlder;

$db = MySQLi::getInstance();

$countSql = "SELECT count(*) FROM eva_livenews_news AS n LEFT JOIN eva_livenews_texts AS t ON n.id = t.newsId";
$count = $db->getVar($countSql);

$limit = 300;
$index = 0;

while ($index < $count) {
    $selectSql = <<<SQL
SELECT n.*, t.contentExtra, t.contentFollowup, t.contentAnalysis
FROM eva_livenews_news AS n
LEFT JOIN eva_livenews_texts AS t
ON n.id = t.newsId LIMIT $index, $limit
SQL;

    $index += $limit;

    $data = $db->getData($selectSql);

    insertData($data);
}

function insertData($data)
{
    $livenewsHanlder = LivenewsHanlder::getInstance();
    foreach ($data as $item) {
        $livenewsHanlder->createOrUpdate($item);
    }
}