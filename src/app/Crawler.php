<?php

namespace App;

use App\Lib\phpUri;

class Crawler {

    private $url = "https://tentreem.mywhc.ca/devtest/products/";

    private function getRequestContent(string $currentUrl, string $path) {
        $this->url = phpUri::parse($currentUrl)->join($path);
        $contentUrl = file_get_contents($this->url);
        return ($contentUrl);
    }

    private function getUrl() {
        return $this->url;
    }

    private function getLinks(string $html): array {
        $regex = '/<a\s+(?:[^>]*?\s+)?href=(["\'])(.*?)\1/';
        preg_match_all($regex, $html, $matches, PREG_SET_ORDER, 0);
        return array_map(function($values) {  return $values[2];   }, $matches);
    }

    private function getData(string $html) {
        $patternTitle = '/<h1 ?.*>(.*)<\/h1>|<span ?.*>(.*)<\/span>|<img[^>]+src="([^">]*).*\/>/';
        preg_match_all($patternTitle, $html, $matches );

        $title = $matches[1][0];
        $price = $matches[2][1];
        $img = $matches[3][2]?:$matches[3][3];
        
       return [$title,  $price,  $img];
    }

    private function extractData($url, $path ) {

        $content = $this->getRequestContent($url, $path);
        $links = $this->getLinks($content);
        $data = $this->getData($content);

        $currentUrl = $this->getUrl();

        list($titleCat) = $data; 
        
        $mainCat = new Category($titleCat);


        if(count($links)) {

            foreach ($links as $link) {

                list($objectData, $category) = $this->extractData($currentUrl, $link);
                list($title, $price, $img) = $objectData;

                if($img) {
                    $mainCat->add(new Product($title, $img, $price));
        
                }else {
                    $mainCat->add($category);
                }
            }

        }

        return [$data, $mainCat];
    }

    public function run() {
        list(, $mainCategory) = $this->extractData($this->url, '');
        echo $mainCategory->render();
    }
}
