<?php

namespace Forms;

use Base\AbstractForm;
use Validators\RequiredValidator;
use Validators\StringValidator;
use Validators\EmailValidator;

class RegisterForm extends AbstractForm {
    
    /**
     * В инициализации добавляем валидаторы
     */
    public function initialize()
    {
        // Добавляем валидаторы на поле email и password
        // Можно добавить поля как через запятую в строке, так и через массив
        $this->add(['email', 'password'], new RequiredValidator(['message' => 'Поле обязательно для заполнения']));
        $this->add('email', new EmailValidator(['message' => 'Проверьте правильность email']));    
    }
        
}