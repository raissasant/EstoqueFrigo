<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CnpjValid implements Rule
{
     public function passes($attribute, $value)
    {
        return $this->validarCNPJ($value);
    }

    public function message()
    {
        return 'O CNPJ informado é inválido.';
    }

    private function validarCNPJ($cnpj)
    {
        //Remove caracteres que não são numéricos
        $cnpj = preg_replace('/\D/', '', $cnpj);

        // CNPJ deve ter 14 números digitados
        if (strlen($cnpj) != 14) {
            return false;
        }

     
        return true; 
    }
}
