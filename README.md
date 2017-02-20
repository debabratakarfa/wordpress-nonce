# WordPress nonce
WordPress plugin that enables the wordpress nonce function in environment.

##How to install

Add to your composer.json file this package as a require an then run 'composer update'
```
"debabratakarfa/wordpress-nonce": "1.0.*"
```

Or directly run
```
composer require debabratakarfa/wordpress-nonce
```

##How to use

Create nonce
```php
$Nonce = new Nonce();
$nonce = $Nonce->create_nonce('my-nonce');
```
