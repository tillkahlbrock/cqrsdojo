<?php

require __DIR__ . "/../../vendor/autoload.php";

$app = new \Slim\Slim();
$app->get('/affiliate', function() use ($app) {
    $affiliate = new \Dojo\Affiliate();
    $affiliate->setId(1);
    $affiliate->setName('Bob');
    $affiliate->setCountry('Germany');

    $affiliates = array(
        $affiliate
    );

    $app->response()->body(json_encode($affiliates));
});
$app->run();
