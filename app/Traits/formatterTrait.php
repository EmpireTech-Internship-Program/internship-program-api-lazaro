<?php

namespace App\Traits;

trait formatterTrait
{
    public function formatCpf($cpf)
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    }

    
    public function formatNumber($number)
    {
        $number = preg_replace('/[^0-9]/', '', $number);

        return rtrim(chunk_split($number, 4, ' '));
    }
}