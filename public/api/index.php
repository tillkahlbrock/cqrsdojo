<?php

require __DIR__ . "/../../vendor/autoload.php";

$app = new \Slim\Slim();
$app->get('/affiliate', function() use ($app) {
    $service = new Dojo\AffiliateService(new Dojo\AffiliateRepository());

    $app->response()->body($service->listAffiliates());
});

$app->post('/affiliate/:id', function() use ($app) {
    $service = new Dojo\AffiliateService(new Dojo\AffiliateRepository());

    $service->createAffiliate(
        json_decode($app->request()->getBody(), true)
    );
});
$app->run();
