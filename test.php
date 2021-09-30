<?php

use Alina\Klientiks\Api;
use Alina\Klientiks\Config;
use Alina\Klientiks\Tools;

require_once __DIR__ . '/vendor/autoload.php';

Tools::logSetup(__FILE__ . '.log');

$api = new Api(Config::ACCOUNT_ID, Config::USER_ID, Config::ACCESS_TOKEN);

$twoLast = [0, 1];
for ($i = 0; $i < 50; $i++) {
    $tmp = array_sum($twoLast);
    $client = [
        'phone' => Tools::generatePhone(),
        'first_name' => Tools::generateName(),
        'birth_date' => Tools::generateBirthDate(),
        'number' => $tmp
    ];
    Tools::log(json_encode($client, JSON_UNESCAPED_UNICODE));
    $res = $api->addClient($client);
    Tools::log(json_encode($res, JSON_UNESCAPED_UNICODE));
    array_shift($twoLast);
    $twoLast[] = $tmp;
    sleep(2);
}

// $res = $api->getClientByPhone(71834440808);

// Tools::log(json_encode($res, JSON_UNESCAPED_UNICODE));
