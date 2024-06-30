<?php
class Curl extends CI_Model {
    public function __construct(){ parent::__construct(); }

    public function post(string $url, array $fields){
        $response = $this->send(array('url'=>$url,'post'=>true,'fields'=>$fields));
        return $response;
    }
    private function send(array $args): mixed
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $args['url']);
        curl_setopt($ch, CURLOPT_POST, $args['post']);
        if($args['post']){ curl_setopt($ch, CURLOPT_POSTFIELDS, $args['fields']); };
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}