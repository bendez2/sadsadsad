<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;

Router::get('/favicon.ico', function () {
    return '';
});

Router::addGroup('/api', function () {
    Router::get('/organization/inn/{inn}', 'Ports\Controller\OrganizationController@getByInn');

    Router::get('/bank/bic/{bic}', 'Ports\Controller\BankController@getByBic');
    Router::get('/bank/upload-all', 'Ports\Controller\BankController@uploadAll');


    Router::get('/address', 'Ports\Controller\AddressController@getAddress');
});
