<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class BadWord extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'The value "{{ value }}" contains a bad word : {{ badword }}.';
    
    public $badwords = [];
            
    public function __construct($options = null) {
        parent::__construct($options);
        // $this->badwords = ...
    }
}
