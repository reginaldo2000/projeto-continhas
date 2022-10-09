<?php

namespace Source\Controller;

use League\Plates\Engine;


abstract class Controller
{

    protected Engine $view;

    public function __construct(string $path)
    {
        $this->view = new Engine($path);
    }

    public function responseJson(bool $erro, string $msg, array $data = []): void {
        $json = [
            "erro" => $erro,
            "msg" => $msg,
            "data" => $data
        ];
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    }
}
