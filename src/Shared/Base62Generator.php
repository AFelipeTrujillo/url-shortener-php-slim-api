<?php

namespace App\Shared;

use App\Domain\Service\CodeGeneratorInterface;

class Base62Generator implements CodeGeneratorInterface
{
    private string $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    public function generateCode(int $length = 6): string
    {
        $code = '';

        for ($i = 0; $i < $length; $i++) {
            $code .= $this->characters[random_int(0, 61)];
        }

        return $code;
    }
}