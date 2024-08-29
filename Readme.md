# SiteConfig Laravel Package
This Laravel package provides a simple and efficient way to manage site settings. You can store, retrieve, update, and delete configuration settings on a application using the SiteConfig class.

## Installation
To install the package, add it to your Laravel project using Composer:
composer require your/package-name

# Usage
Import the package in your class
```php
use Intelrx\Sitesettings\SiteConfig;

SiteConfig::store('phone', '1234567890');
SiteConfig::get('phone');
SiteConfig::update('phone', '18487');
SiteConfig::delete('phone');
SiteConfig::list()
```

## Storing Settings
To store a new site setting, use the store method:

```php
SiteConfig::store('phone', '1234567890');
```

## Retrieving Settings
To retrieve a stored site setting, use the get method:
```php
$phone = SiteConfig::get('phone');
```

## Updating Settings
To update an existing site setting, use the update method:
```php
SiteConfig::update('phone', '18487');
```

## Deleting Settings
To delete a site setting, use the delete method:
```php
SiteConfig::delete('phone');
```

## Listing all Setting
To list complete site settings use the list method:
```php
SiteConfig::list();
```