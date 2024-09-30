<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cpf implements Rule
{
    public function passes($attribute, $value)
    {
        return $this->isValidCpf($value);
    }

    public function message()
    {
        return 'O CPF informado é inválido.';
    }

    private function isValidCpf($cpf)
    {
        // Remover caracteres não numéricos
        $cpf = preg_replace('/\D/', '', $cpf);

        // Verificar se tem 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verificar se todos os números são iguais
        if (preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }

        // Validação  dos números digitados
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }
}
