# WordPress_Nonce
WordPress plugin that enables the wordpress nonce function in environment.

##How to install using composer

The composer.json file:
```
"debabratakarfa/wordpress-nonce": "1.0.*"

{
	"repositories": [
		{
			"type": "vcs",
			"url" : "https://github.com/debabratakarfa/wordpress-nonce"
		}
	],
	"require": {
		"debabratakarfa/wordpress-nonce" : "1.0.*"
	}
}

```

Add to your composer.json file this package as a require an then run 'composer install'

Or

```
Open Terminal

cd /path/to/your/install/wordpress/plugin_folder/
git clone https://github.com/debabratakarfa/wordpress-nonce.git
cd wordpress-nonce
composer install

Then go to Wp-Admin access to activate it

```
##How to use

Create nonce
```php
$Nonce = new Nonce();
$nonce = $Nonce->create_nonce('my-nonce');
```

Verify nonce
```php
$Nonce = new Nonce();

//Create New nonce
$nonce = $Nonce->create_nonce('my-nonce');
if ($nonce->verify_nonce($nonce, 'my-nonce')) {
	//If true, then your code
}else{
	//If false, then your code
}
```

Create nonce url

```
$nonce = new Nonce();
$url = $nonce->nonce_url('http://my-url.com', 'doing-something', 'my-nonce');
```
