<?php
require '../src/config/config.php';
require '../vendor/autoload.php';
use components\MySQLi;


$db = MySQLi::getInstance();


$countSql = "SELECT count(*) FROM eva_livenews_news AS n LEFT JOIN eva_livenews_texts AS t ON n.id = t.newsId";
$count = $db->getVar($countSql);


$limit = 100;
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

    insertData($data, $db);
}

function insertData($data, $db)
{
    foreach ($data as $item) {
        insertItem($item, $db);
    }
}


function insertItem($item, $db)
{
    $columns = '';
    $values = '';

    foreach ($item as $k => $v) {
        $tmp = empty($columns) ? $k : ','.$k;
        $columns .= $tmp;

        $tmp = empty($values) ? "'$v'" : ','."'$v'";
        $values .= $tmp;
    }


    $insertSql = <<<SQL
INSERT INTO livenews ($columns) VALUES ($values);
SQL;

    /**
     * @var $db MySQLi
     */
    $db->query($insertSql);

    $id = $item['id'];
    echo "正在初始化实时新闻 : ".$id."\n";
}