<?php
namespace Drupal\mynews\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Component\Serialization\Json;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class MyNewsController extends ControllerBase{

    public function getConfig(){
        $mynews_config = \Drupal::config('mynews.settings');
        $mynews_access_token = $mynews_config->get('mynews_access_token');
        return $mynews_access_token;
    }

    public function getNewsByCategory($category,$country){
        $config  = $this->getConfig();
        $client  = \Drupal::httpClient();
        $url = "https://newsapi.org/v2/top-headlines?category=$category&country=$country&language=en&apiKey=$config";
        $request = $client->get(trim($url));  
        $response = $request->getBody()->getContents();
        $result = json::decode($response);
        return $result;
    }
    
/*     public function getInNews(){
        $config  = $this->getConfig();
        $client  = \Drupal::httpClient();
        $url = "https://newsapi.org/v2/top-headlines?country=in&apiKey=$config";
        $request = $client->get(trim($url));  
        $response = $request->getBody()->getContents();
        $result = json::decode($response);
        //echo '<pre>'; print_r($result['articles']);die();
         return [
                '#theme'=>'mynews_template',
                '#data' => $result['articles']
               ];
    } */

/*     public function getUsNews(){
        $config = $this->getConfig();
        $client  = \Drupal::httpClient();
        $url = "https://newsapi.org/v2/top-headlines?country=us&apiKey=$config";
        $request = $client->get(trim($url));  
        $response = $request->getBody()->getContents();
        $result = json::decode($response);
        //echo '<pre>'; print_r($result['articles']);die();
         return [
                '#theme'=>'mynews_template',
                '#data' => $result['articles']
               ];
    } */

    public function getSources(){
        $config =  $this->getConfig();
        $client = \Drupal::httpClient();
        $url = "https://newsapi.org/v2/top-headlines/sources?apiKey=$config";
        $request = $client->get(trim($url));
        $response = $request->getBody()->getContents();
        $result = json::decode($response);
        echo '<pre>'; print_r($result['sources']);die();
    }

    public function getCategoryNews(Request $request, $category){
       
        $result = $this->getNewsByCategory($category, $country='in');
        //echo '<pre>'; print_r($result);die();
        return [
            '#theme'=>'mynews_template',
            '#data' => $result['articles']
           ];
    }

    public function getNewsByCountry(Request $request, $country){
        $result = $this->getNewsByCategory($category='general', $country);
        //echo '<pre>'; print_r($result);die();
        return [
            '#theme'=>'mynews_template',
            '#data' => $result['articles']
           ];
    }
}
