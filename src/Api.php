<?php

namespace Alina\Klientiks;

class Api
{
    private $auth;
    private $url;

    public function __construct(string $accountID, string $userID, string $accessToken)
    {
        $this->url = "https://klientiks.ru/clientix/Restapi";
        $this->auth = "/a/$accountID/u/$userID/t/$accessToken";
    }

    public function addClient(array $client): array
    {
        return $this->post('/add' ,'/m/Clients', $client);
    }

    public function getClients(): array
    {
        return $this->get('/list', '/m/clients/date');
    }

    public function getClientByPhone(string $phone): array
    {
        return $this->get('/list', '/m/getClientByPhone/phone/' . $phone);
    }

    public function updateClient(array $client): array
    {
        return $this->post('/edit', '/m/Clients', $client);
    }

    private function post(string $action, string $path, array $data): array
    {
        $opts = [
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => ['Content-Type:application/x-www-form-urlencoded'],
            CURLOPT_URL => $this->url . $action . $this->auth . $path,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POSTFIELDS => http_build_query($data)
        ];

        $curl = curl_init();
        curl_setopt_array($curl, $opts);
        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result, true);
    }

    private function get(string $action, string $path): array
    {
        $opts = [
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_URL => $this->url . $action . $this->auth . $path,
            CURLOPT_RETURNTRANSFER => 1
        ];
        echo $opts[CURLOPT_URL] . PHP_EOL;

        $curl = curl_init();
        curl_setopt_array($curl, $opts);
        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result, true);
    }
}
