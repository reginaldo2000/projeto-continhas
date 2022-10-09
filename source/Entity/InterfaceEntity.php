<?php

namespace Source\Entity;

interface InterfaceEntity
{
    public function isValid(): bool;
    public function toArray(): array;
}
