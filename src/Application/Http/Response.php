<?php

namespace Juliana\Agenda\Application\Http;

class Response
{
    private int $status;
    private string $content;
    private string $type;

    public function __construct(int $status, string $content, string $type)
    {
        $this->status = $status;
        $this->content = $content;
        $this->type = $type;
    }

    public static function json(int $status, $data): Response
    {
        return new Response($status, json_encode($data), 'application/json');
    }

    public static function plain(int $status, string $content): Response
    {
        return new Response($status, $content, 'text/plain');
    }

    public function render(){
        header("HTTP/1.1 $this->status");
        header("Content-Type: $this->type");
        echo $this->content;
    }
}
