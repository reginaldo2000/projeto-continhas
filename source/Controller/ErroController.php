<?php

namespace Source\Controller;


class ErroController extends Controller
{

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../public");
    }

    public function erro(array $data): void
    {
        echo $this->view->render("erro", [
            "titulo" => "Erro: " . $data["errcode"],
            "mensagem" => $this->mensagemErro($data["errcode"])
        ]);
    }

    private function mensagemErro(int $code): string
    {
        switch ($code) {
            case 400:
                return "Sua solicitação não pode ser processada!";
            case 401:
                return "Login obrigatório!";
            case 404:
                return "A página que você solicitou não existe!";
            case 500:
                return "Erro interno da aplicação!";
            default:
                return "Algum problema ocorreu durante a execução!";
        }
    }
}
