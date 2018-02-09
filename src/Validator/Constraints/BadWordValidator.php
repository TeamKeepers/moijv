<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class BadWordValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint BadWord */
        foreach($constraint->badwords as $badword) {
            if(strpos($value, $badword) !== FALSE) {
                $this->context->buildViolation($constraint->message)
                        ->setParameter('{{ value }}', $value)
                        ->setParameter('{{ badword }}', $badword)
                        ->addViolation();
            }
        }
        
    }
}
