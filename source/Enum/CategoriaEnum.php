<?php

namespace Source\Enum;

class CategoriaEnum extends Teste
{

    const ALIMENTACAO = "ALIMENTACAO";
    const TRANSPORTE = "TRANSPORTE";
    const GASTO_FIXO = "GASTO_FIXO";
    const COMPRA_PARCELADA = "COMPRA_PARCELADA";
    const COMPRA = "COMPRA";
    const MERCANTIL = "MERCANTIL";

    public static function list(): array
    {
        $list = [
            self::ALIMENTACAO,
            self::TRANSPORTE,
            self::GASTO_FIXO,
            self::COMPRA_PARCELADA,
            self::COMPRA,
            self::MERCANTIL
        ];
        asort($list);
        return $list;
    }
}
