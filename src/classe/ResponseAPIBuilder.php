<?php

namespace App\classe;

use App\interface\ApiFormatInterface;

class ResponseAPIBuilder
{
    protected ApiFormatInterface $ressources;
    public function setApiFormat(ApiFormatInterface $ressources)
    {
        $this->ressources = $ressources;
    }

    public function getResponse(?\Psr\Http\Server\RequestHandlerInterface $handler, ?\Psr\Http\Message\ServerRequestInterface $request)
    {
        $response = $handler->handle($request);
        $response = $response->withStatus($this->ressources->getHTTPCode(), $this->ressources->getHTTPDescription());
        $stream = $response->getBody();
        $stream->write($this->ressources->getBody());
        $response->withBody($stream);

        // surcharge des header
        foreach ($this->ressources->getHeaders() as $key => $header){
            $response = $response->withHeader($key, $header);
        }

        return $response;
    }

}