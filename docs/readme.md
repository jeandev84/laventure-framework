### PHP Code Style Fixer via ```PHP CodeSniffer```
- https://github.com/squizlabs/PHP_CodeSniffer
```bash
mkdir -p tools/php-cs-fixer
composer require --working-dir=tools/php-cs-fixer friendsofphp/php-cs-fixer
tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src
tools/php-cs-fixer/vendor/bin/php-cs-fixer fix tests
```

