<?php
namespace App\controller;

use App\classe\ResponseAPIBuilder;
use App\interface\ApiFormatInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use VekaServer\Container\Container;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="My First API", version="0.1")
 */
class Controller extends \VekaServer\Framework\Controller
{

    protected ApiFormatInterface $responseApi;
    protected RequestHandlerInterface $handler;
    protected ServerRequestInterface $request;

    public function __construct()
    {
        $this->responseApi = Container::getInstance()->get('ResponseAPI');
        $router = Container::getInstance()->get('Router');
        $this->handler = $router->handler;
        $this->request = $router->request;
    }

    public function send(){
        $responseBuilder = new ResponseAPIBuilder();
        $responseBuilder->setApiFormat($this->responseApi);
        return  $responseBuilder->getResponse($this->handler, $this->request);
    }

}