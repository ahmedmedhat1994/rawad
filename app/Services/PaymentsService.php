<?php


namespace App\Services;




use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class PaymentsService
{

    private $base_url;
    private $headers;
    private $request_clint;
    public function __construct(Client $request_clint)
    {
        $this->request_clint = $request_clint;
        $this->base_url = env('Tap_Base_Url');
        $this->headers = [
            'Authorization' => 'Bearer '. env('Tap_Secret_Key'),
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ];
    }

    private function buildRequest($url, $method, $data = [])
    {
       $request = new Request($method, $this->base_url.$url, $this->headers);
       if (!$data)
           return false;
           $response = $this->request_clint->send($request, [
               'json' => $data,
           ]);
           if ($response->getStatusCode() != 200)
           {
            return false;
           }
           $response = json_decode($response->getBody(), true);
           return $response;
    }

public function sendPayment($data)
{
    $response = $this->buildRequest('/v2/authorize/','post',$data);
    return $response;
}

    public function getCancelUrl($order_id)
    {
        return route('checkout.cancel', $order_id);
    }

    public function getReturnUrl($order_id)
    {
        return route('checkout.complete', $order_id);
    }


}
