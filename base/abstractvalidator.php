<?php

namespace Base;

abstract class AbstractValidator {
    
    /**
     * Текст сообщения об ошибке
     * 
     * @var string $_message
     */
    protected $_message = '';
    
    /**
     * Опции для валидатора, которые используются в методе validate
     * 
     * @var array $_options
     */
    protected $_options = [];
    
    /**
     * В конструкторе проверяем опции, а так же
     * добавляем сообщение об ошибке, если оно передано в опциях
     * 
     * @param array $options
     */
    public function __construct($options = [])
    {
        if( ! is_array($options))
        {
            throw new \Exception('Options must be an array');
        }
        
        if(isset($options['message']))
        {
            $this->_message = $options['message'];
        }
        else
        {
            $this->_message = $this->getDefaultMessage();
        }
        
        $this->_options = $options;
    }
    
    /**
     * Сообщение об ошибке, которое получает класс формы
     */
    public function getMessage()
    {
        return $this->_message;
    }
    
    /**
     * Сообщение об ошибке по умолчанию,
     * можно переопределить и добавить своё сообщение по умолчанию
     * 
     * @return string
     */
    public function getDefaultMessage()
    {
        return '';
    }
    
    /**
     * Получить значение опции по названию,
     * если такой опции нет, то возвращаем значение по умолчанию
     * 
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getOption($name, $default = null)
    {
        return isset($this->_options[$name]) ? $this->_options[$name] : $default;
    }
    
    /**
     * Абстрактный метод валидации,
     * в который будет передаваться значения поля формы 
     * и должен возвращатсья результат валидации
     * 
     * @param mixed $data
     * @return bool
     */
    abstract function validate($data);
    
}