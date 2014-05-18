#php fifa-scraper to json
breve demostracion de como programar un simple spider en tiempo real de la fifa

#usage
modo de uso del script online
```php
<?php
	require('fifa.class.php');
    try 
    {
        $a = new fifa;
        print $a->init();
    }
    catch (Exception $e) 
    {
        die($e->getMessage());
    }
```
dudas o consultas : jpmaster.net@gmail.com
derechos reservados : https:cocolabs.com
fifa scrapper to json PHP
