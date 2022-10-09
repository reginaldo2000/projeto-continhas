<?php

namespace Source\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contas")
 */
class Conta implements InterfaceEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private ?int $id = null;

    /**
     * @ORM\Column
     */
    private string $descricao;

    /**
     * @ORM\Column(length=30)
     */
    private string $categoria;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private float $valor;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTime $data;

    public function __construct()
    {
    }

    public function isValid(): bool
    {
        if ($this->descricao == "") {
            return false;
        }
        return true;
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "descricao" => $this->descricao,
            "categoria" => $this->categoria,
            "valor" => $this->valor,
            "data" => $this->data->format("Y-m-d")
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getCategoria(): string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): void
    {
        $this->categoria = $categoria;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function setValor(float $valor): void
    {
        $this->valor = $valor;
    }

    public function getData(): DateTime
    {
        return $this->data;
    }

    public function setData(DateTime $data): void
    {
        $this->data = $data;
    }
}
