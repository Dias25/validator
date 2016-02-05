<?php

require_once('base/loader.php');

use Base\Loader;
use Forms\LoginForm;
use Forms\RegisterForm;

(new Loader())->register();

try 
{
    /**
     * Проверяем первую форму
     */
    
    $data = [
        'login' => 'username',
        'password' => '1'
    ];
    
    $form = new LoginForm();
    
    if($form->validate($data))
    {
        echo 'Good' . '<br />';
    }
    else
    {
        echo 'Not good <br />';
        
        foreach($form->getErrors() as $field => $errors)
        {
            foreach($errors as $error)
            {
                echo $field . ' ' . $error . '<br />';
            }
        }
    }
    
    echo '<br /><br />';
    
    /**
     * Проверяем вторую форму
     */
    
    $data = [
        'email' => 'test@mail.ua',
        'password' => '123'
    ];
    
    $form = new RegisterForm();
    
    if($form->validate($data))
    {
        echo 'Good' . '<br />';
    }
    else
    {
        echo 'Not good <br />';
        
        foreach($form->getErrors('email') as $error)
        {
            echo $error . '<br />';
        }
    }    
    
}
catch(Exception $e)
{
    echo $e->getMessage();
}

