<?php

function url(string $link): string
{
    return URL_BASE . "" . $link;
}

function redirect(string $rota): void
{
    header("location: " . URL_BASE . "" . $rota);
    exit;
}

function setMessage(string $msg, string $type = "alert-success"): void
{
    $_SESSION["msg_alert"] = $msg;
    $_SESSION["msg_type"] = $type;
}

function showMessage(): string
{
    if (isset($_SESSION["msg_alert"])) {
        $string = '<div class="alert ' . $_SESSION["msg_type"] . ' alert-dismissible fade show" role="alert">';
        $string .= $_SESSION["msg_alert"];
        $string .= '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        $string .= '</div>';
        unset($_SESSION["msg_alert"]);
    }
    return $string ?? "";
}

function traduzMes(string $mes): string
{
    switch ($mes) {
        case "Jan":
            return "Janeiro";
        case "Feb":
            return "Fevereiro";
        case "Mar":
            return "Março";
        case "Apr":
            return "Abril";
        case "May":
            return "Maio";
        case "Jun":
            return "Junho";
        case "Jul":
            return "Julho";
        case "Aug":
            return "Agosto";
        case "Sep":
            return "Setembro";
        case "Oct":
            return "Outubro";
        case "Nov":
            return "Novembro";
        case "Dec":
            return "Dezembro";
        default:
            return "Inválido";
    }
}
