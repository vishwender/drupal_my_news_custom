<?php
namespace Drupal\mynews\Controller;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Component\Serialization\Json;

class MyNewsController extends ControllerBase{
    
    public function getInNews(){
        $mynews_config = \Drupal::config('mynews.settings');
        $mynews_access_token = $mynews_config->get('mynews_access_token');
        $client  = \Drupal::httpClient();
        $url = "https://newsapi.org/v2/top-headlines?country=in&apiKey=$mynews_access_token";
        $request = $client->get(trim($url));  
        $response = $request->getBody()->getContents();
        $result = json::decode($response);
        //echo '<pre>'; print_r($result['articles']);die();
         return [
                '#theme'=>'mynews_template',
                '#data' => $result['articles']
               ];
    }

    public function getUsNews(){
        $mynews_config = \Drupal::config('mynews.settings');
        $mynews_access_token = $mynews_config->get('mynews_access_token');
        $client  = \Drupal::httpClient();
        $url = "https://newsapi.org/v2/top-headlines?country=us&apiKey=$mynews_access_token";
        $request = $client->get(trim($url));  
        $response = $request->getBody()->getContents();
        $result = json::decode($response);
        //echo '<pre>'; print_r($result['articles']);die();
         return [
                '#theme'=>'mynews_template',
                '#data' => $result['articles']
               ];
    }
}
