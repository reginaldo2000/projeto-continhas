<?php

ob_start();

include_once __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$route = new Router(URL_BASE, ":");

$route->namespace("Source\Controller");

$route->get("/", function () {
    redirect("/contas");
});
$route->get("/contas", "ContaController:contas");
$route->post("/conta/cadastrar", "ContaController:salvar");
$route->post("/conta/editar/{id}", "ContaController:atualizar");
$route->get("/conta/get/{id}", "ContaController:get");
$route->post("/conta/excluir/{id}", "ContaController:excluir");

$route->group("oops")->namespace("Source\Controller");
$route->get("/{errcode}", "ErroController:erro");

$route->dispatch();

if ($route->error()) {
    $route->redirect("/oops/{$route->error()}");
}

ob_flush();
