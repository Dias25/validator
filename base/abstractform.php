<?php

namespace Base;

abstract class AbstractForm {
    
    /**
     * Поля формы.
     * Ключ - название поля, значение - массив из валидаторов.
     * 
     * @var array $_fields
     */
    protected $_fields = [];
    
    /**
     * Массив ошибок, если валидация не прошла успешно.
     * 
     * @var array $_errors
     */
    protected $_errors = [];
    
    /**
     * В конструкторе делаем инициализацию формы, в которой
     * можно добавить правила валидации.
     */
    
    public function __construct()
    {
        if(is_callable([$this, 'initialize']))
        {
            $this->initialize();
        }
    }
    
    /**
     * Добавляем валидатор, предварительно проверив передаваемое значение.
     * 
     * @param string|array $field название поля
     * @param object $validator объект валидатора
     */
    public function add($fields, $validator)
    {
        if( ! is_object($validator) || ( ! $validator instanceof \Base\AbstractValidator && ! $validator instanceof \Closure))
        {
            throw new \Exception('Validator must be instance of \Validators\AbstractValidator');
        }
        
        if(is_string($fields))
        {
            if(strpos($fields, ',') !== false)
            {
                $fields = explode(',', $fields);
            }
            else
            {
                $fields = (array) $fields;
            }
        }

        if(is_array($fields))
        {
            foreach($fields as $field)
            {
                $this->_fields[trim($field)][] = $validator;
            }            
        }
        else
        {
            throw new \Exception('Fields param must be string or array');
        }
    }
    
    /**
     * Проверка формы.
     * 
     * @param array $data
     * @return bool возвращаем true если проверка пройдена
     */
    public function validate($data)
    {
        if( ! is_array($data))
        {
            $this->_errors[] = 'Data is not array';
        }
        else
        {
            foreach($this->_fields as $name => $validators)
            {
                if( ! array_key_exists($name, $data))
                {
                    $this->_errors[$name][] = 'Field ' . $name . ' not exists in data';
                }
                else
                {
                    $fieldData = $data[$name];
                    
                    foreach($validators as $validator)
                    {
                        if($validator instanceof \Closure)
                        {
                            if(($result = call_user_func($validator, $fieldData)) !== true)
                            {
                                $this->_errors[$name][] = $result;
                            }
                            
                            continue;
                        }
                        
                        if( ! $validator->validate($fieldData))
                        {
                            $this->_errors[$name][] = $validator->getMessage();
                        }
                    }                
                }
            }            
        }
        
        if(count($this->_errors) == 0)
        {
            return true;
        }
        
        return false;
    }
    
    /**
     * Получаем список ошибок после валидации формы.
     * 
     * @param string $field название поля, если указать, то возвращает массив ошибок этого поля
     * @return array
     */
    public function getErrors($field = null)
    {
        if($field !== null && array_key_exists($field, $this->_errors))
        {
            return $this->_errors[$field];
        }
        
        return $this->_errors;
    }
}