<?php

namespace App\classe;

use App\interface\ApiFormatInterface;

class JSONCustom implements ApiFormatInterface
{
    protected mixed $data = null;

    protected int $HTTPCode;
    protected string $description = '';
    protected array $header = [
        'Content-Type' => 'application/json'
    ];

    public function setHTTPCode(int $code, string $description = '') :void
    {
        $this->HTTPCode = $code;
        $this->description = $description;
    }

    public function getBody() :string
    {
        return json_encode($this->data);
    }

    public function setData(mixed $data) :void
    {
        $this->data = $data;
    }

    function getHTTPCode() :int
    {
        return $this->HTTPCode;
    }

    function getHTTPDescription() :string
    {
        return $this->description;
    }

    function error(int $code, mixed $detail = '', string $help = '') :void
    {
        $this->HTTPCode = $code;
        $error = [];
        if (!empty($detail)) {
            $error['message'] = $detail;
        }
        if (!empty($help)) {
            $error['help'] = $help;
        }
        if(!empty($error)){
            $this->data['error'] = $error;
        }
    }

    /**
     * @return array
     */
    public function getHeaders() :array
    {
        return $this->header;
    }

    public function getHeader($key) :string
    {
        return $this->header[$key] ?? '';
    }

    public function setHeader(string $key, string $value) :void
    {
        $this->header[$key] = $value;
    }

}