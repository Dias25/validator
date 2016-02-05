<?php

namespace validators;

use base\AbstractValidator;

class EmailValidator extends AbstractValidator {
    
    public function validate($data)
    {
        if(filter_var($data, FILTER_VALIDATE_EMAIL))
        {
            return true;
        }
        
        return false;
    }
        
}