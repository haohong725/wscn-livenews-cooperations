<?php
require '../src/config/config.php';
require '../vendor/autoload.php';
use components\LivenewsHanlder;


$client = new \GuzzleHttp\Client();
$res = $client->request('GET', LIVENEWS_URL);
$livenewsHanlder = LivenewsHanlder::getInstance();

$res = $res->getBody();
$res = json_decode($res, true);
$results = $res['results'];

foreach ($results as $item) {
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

    $item = array_filter($item, function ($v, $k) use ($fieldFilter) {
        if (in_array($k, $fieldFilter)) {
            return true;
        }

        return false;
    },
    ARRAY_FILTER_USE_BOTH
    );

    $livenewsHanlder->createOrUpdate($item);
}

