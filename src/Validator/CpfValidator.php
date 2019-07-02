<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CpfValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$this->validateCpf($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }

    private function validateCpf($cpf)
    {
        $cpf = preg_replace('/[^0-9]/', '', (string) $cpf);

        if ("" == trim($cpf)) {
            return true;
        }


        if (strlen($cpf) != 11) {
            return false;
        }

        for ($i = 0; $i <= 9; $i++) {
            if ($cpf == str_repeat($i, 11)) {
                return false;
            }
        }

        for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--) {
            $soma += $cpf{$i} * $j;
        }

        $resto = $soma % 11;

        if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto)) {
            return false;
        }

        for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--) {
            $soma += $cpf{$i} * $j;
        }

        $resto = $soma % 11;

        return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
    }
}
