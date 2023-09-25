<?php
namespace Drupal\mynews;
use GuzzleHttp\Client;

class ClientFactory{
    
    /**
     * Return a configured Client object.
     */
    
    public function get() {
        $config = [
            'base_uri' => 'https://newsapi.org/v2/top-headlines',
        ];
        $client = new Client($config);
        return $client;
    }
}
?>