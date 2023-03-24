<?php

namespace App\interface;

interface ApiFormatInterface
{

    function getBody() :string;
    function getHTTPCode() :int;
    function getHTTPDescription() :string;
    public function setHTTPCode(int $code, string $description = '') :void;
    public function setData(mixed $data) :void;
    function error(int $code, mixed $detail = '', string $help = '') :void;
    public function getHeaders() :array;
    public function getHeader($key) :string;
    public function setHeader(string $key, string $value) :void;
}