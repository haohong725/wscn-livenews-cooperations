<?php

/**
 * 更新指定时间区间内的数据
 */

require "requires.php";

use components\LivenewsHanlder;

$livenewsHanlder = LivenewsHanlder::getInstance();

$start = isset($argv[1])?$argv[1]:time()-7*24*3600;
$end = isset($argv[2])?$argv[2]:time();
$limit = 100;

do {
    $url = "https://api.wallstreetcn.com/v2/livenews?";
    $url .= "&since_time=".$start."&max_time=".$end."&limit=".$limit;

    $livenewsList = getLiveNews($url);

    createOrUpdate($livenewsList);

    $end = getMinUpdatedAt($livenewsList);
} while (count($livenewsList) >= $limit);

function createOrUpdate($livenewsList)
{
    $fieldFilter = [
        'id',
        'title',
        'status',
        'type',
        'codeType',
        'importance',
        'craetedAt',
        'updatedAt',
        'imageCount',
        'image',
        'videoCount',
        'video',
        'sourceName',
        'sourceUrl',
        'userId',
        'categorySet',
        'hasMore',
        'channelSet',
        'contentExtra',
        'contentFollowup',
        'contentAnalysis'
    ];

    $livenewsHanlder = LivenewsHanlder::getInstance();
    foreach ($livenewsList as $v) {
        $item = array_merge($v, $v['text']);

        $item = array_filter($item, function ($v, $k) use ($fieldFilter) {
            if (in_array($k, $fieldFilter)) {
                return true;
            }

            return false;
        }, ARRAY_FILTER_USE_BOTH
        );

        $livenewsHanlder->createOrUpdate($item);
    }
}

function getMinUpdatedAt($livenewsList)
{
    $min = 2000000000;
    foreach ($livenewsList as $item) {
        if ($item['updatedAt'] > 0) {
            $min = min($item['updatedAt'], $min);
        }
    }

    return $min;
}

function getLiveNews($url)
{
    $client = new \GuzzleHttp\Client();
    $res = $client->request('GET', $url);
    $res = $res->getBody();
    $res = json_decode($res, true);
    $results = $res['results'];

    return $results;
}