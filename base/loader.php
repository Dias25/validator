<?php

namespace Base;

class Loader {

	public function register()
	{
		spl_autoload_register([$this, 'autoLoad']);
	}

	public function autoLoad($class)
	{
		if(strpos($class, '\\') !== false)
		{
			$path = __DIR__ . DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, strtolower($class)) . '.php';
		}
		else
		{
			$path = strtolower($class) . '.php';
		}

		if(is_file($path))
		{
			require_once($path);
		}		
	}

}