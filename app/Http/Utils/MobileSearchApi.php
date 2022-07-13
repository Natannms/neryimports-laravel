<?php

namespace App\Http\Utils;

use Exception;
use GuzzleHttp\Client;

class MobileSearchApi {
  
        static function getAll()
        {
          //trás todos os produtos paginados com total de  1956 aprox
            $client = new Client();
            
            $response = $client->request('POST', 'https://apis.dashboard.techspecs.io/7s2kibnwqb1dy2yl/en/v3/product/all?page=2', [
              'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'x-blobr-key' => 'EAJIGl4C5ZQTkohu8DNlQoXCYCWGNP42',
              ],
            ]);
            
            return $response->getBody();
        }
        //retornar todas as marcas de eletronicos
        public function getAllBrands()
        {
          $client = new Client();

            $response = $client->request('GET', 'https://apis.dashboard.techspecs.io/7s2kibnwqb1dy2yl/en/v3/brand/all?category=smartphone', [
              'headers' => [
                'Accept' => 'application/json',
                'x-blobr-key' => 'EAJIGl4C5ZQTkohu8DNlQoXCYCWGNP42',
              ],
            ]);

            return $response->getBody();
        }

        public function getByKey()
        {
          $client = new Client();
          $response = $client->request('POST', 'https://apis.dashboard.techspecs.io/7s2kibnwqb1dy2yl/en/v3/product/search?query=Mi Watch Revolve Active', [
            'body' => '{"category":"smartphone","brand":"xiaomi","model":"Mi Watch Revolve Active","color":"black","price":"100","page":1}',
            'headers' => [
              'Accept' => 'application/json',
              'Content-Type' => 'application/json',
              'x-blobr-key' => 'EAJIGl4C5ZQTkohu8DNlQoXCYCWGNP42',
            ],
          ]);

          return $response->getBody();
        }
        public function getByName()
        {
          $client = new Client();
          $response = $client->request('GET', 'https://apis.dashboard.techspecs.io/hdw91oa2as7syxd4/MachineIDLookup?q=iphone8%2C2', [
            'headers' => [
              'Accept' => 'application/json',
              'X-BLOBR-KEY' => 'EAJIGl4C5ZQTkohu8DNlQoXCYCWGNP42',
            ],
          ]);

          return $response->getBody();
        }

}