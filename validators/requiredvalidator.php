<?php

namespace validators;

use base\AbstractValidator;

class RequiredValidator extends AbstractValidator {
    
    public function validate($data)
    {
        if(is_string($data))
        {
            return trim($data) != '';
        }
        elseif(is_array($data))
        {
            return (bool) count($data) > 0;
        }
        
        return false;
    }
    
    /**
     * Добавляем своё сообщение об ошибке
     */
    public function getDefaultMessage()
    {
        return 'Поле обязательно для заполнения';
    }
        
}