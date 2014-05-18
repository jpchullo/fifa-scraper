fifa-scraper
============

#PHP FIFA-SCRAPER TO JSON CONVERT
breve demostracion de como programar un simple spider en tiempo real de la fifa

#USAGE
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

fifa scrapper to json PHP
