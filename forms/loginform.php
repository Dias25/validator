<?php

namespace Forms;

use Base\AbstractForm;
use Validators\RequiredValidator;
use Validators\StringValidator;
use Validators\EmailValidator;

class LoginForm extends AbstractForm {
    
    /**
     * В инициализации добавляем валидаторы
     */
    public function initialize()
    {
        // Добавляем валидаторы на поле login и password
        $this->add('login, password', new RequiredValidator());
        $this->add('login', new StringValidator(['message' => 'Длина строки должна быть не менее 5 символов и не более 20', 'min' => 5, 'max' => 20]));
        
        // Можно добавить анонимную функцию, которая либо возвращает true либо текст ошибки
        $this->add('login', function($data){

            if(preg_match('/^[a-zA-Z0-9]+$/u', $data))
            {
                return true;
            }
            
            return 'Логин должен содержать только буквы и цифры';
            
        });
    }
        
}