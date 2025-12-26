<?php

namespace App\Domain\Service;

interface CodeGeneratorInterface
{
    public function generateCode(int $length = 6): string;
}