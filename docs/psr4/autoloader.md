### SIMPLE AUTOLOADER FOR MICRO-PROJECT


1. Create file laventure.json ```Example```

```php 
{
   "psr-4": {
      "Laventure\\" : "src"
   }
}
```


2. Include Autoloader

```php 
require __DIR__.'/src/Psr4/Autoloader.php';

\Laventure\Psr4\Autoloader::load(__DIR__);

$filesystem = new \Laventure\Component\Filesystem\Filesystem(__DIR__);

print_r($filesystem);
```