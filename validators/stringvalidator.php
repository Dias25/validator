<?php

namespace validators;

use base\AbstractValidator;

class StringValidator extends AbstractValidator {
    
    public function validate($data)
    {
        $min = $this->getOption('min');
        $max = $this->getOption('max');
        
        if( ! $min && ! $max)
        {
            throw new \Exception('Min or max must be in options');
        }
        
        if($min && $max)
        {
            if(mb_strlen($data, 'UTF-8') >= $min && mb_strlen($data, 'UTF-8') <= $max)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
        if($min)
        {
            if(mb_strlen($data, 'UTF-8') >= $min)
            {
                return true;
            }
        }
        
        if($max)
        {
            if(mb_strlen($data, 'UTF-8') <= $max)
            {
                return true;
            }
        }
        
        return false;
    }
        
}