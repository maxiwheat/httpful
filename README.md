
### Fork

PHP 8.0 or higher required.

**Installation**

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "git@github.com:diagnosia/httpful.git"
    }
  ],
  "require": {
    "nategood/httpful": "^0.4"
  }
}
```

**Local Development**

```bash
docker compose run --rm httpful bash

# In the container shell

# Install dependencies
composer install

# Run tests
vendor/bin/phpunit

# Run phpstan
vendor/bin/phpstan analyse src
vendor/bin/phpstan analyse tests
```


# Httpful

[![Build Status](https://secure.travis-ci.org/nategood/httpful.png?branch=master)](http://travis-ci.org/nategood/httpful) [![Total Downloads](https://poser.pugx.org/nategood/httpful/downloads.png)](https://packagist.org/packages/nategood/httpful)

Httpful is a simple Http Client library for PHP 7.2+.  There is an emphasis of readability, simplicity, and flexibility – basically provide the features and flexibility to get the job done and make those features really easy to use.

Features

 - Readable HTTP Method Support (GET, PUT, POST, DELETE, HEAD, PATCH and OPTIONS)
 - Custom Headers
 - Automatic "Smart" Parsing
 - Automatic Payload Serialization
 - Basic Auth
 - Client Side Certificate Auth
 - Request "Templates"

# Sneak Peak

Here's something to whet your appetite.  Search the twitter API for tweets containing "#PHP".  Include a trivial header for the heck of it.  Notice that the library automatically interprets the response as JSON (can override this if desired) and parses it as an array of objects.

```php
// Make a request to the GitHub API with a custom
// header of "X-Trvial-Header: Just as a demo".
$url = "https://api.github.com/users/nategood";
$response = src\Request::get($url)
    ->expectsJson()
    ->withXTrivialHeader('Just as a demo')
    ->send();

echo "{$response->body->name} joined GitHub on " .
                        date('M jS', strtotime($response->body->created_at)) ."\n";
```

# Installation

## Composer

Httpful is PSR-0 compliant and can be installed using [composer](http://getcomposer.org/).  Simply add `nategood/httpful` to your composer.json file.  _Composer is the sane alternative to PEAR.  It is excellent for managing dependencies in larger projects_.

```json
{
  "require": {
    "nategood/httpful": "*"
  }
}
```

# Contributing

Httpful highly encourages sending in pull requests.  When submitting a pull request please:

 - All pull requests should target the `dev` branch (not `master`)
 - Make sure your code follows the [coding conventions](http://pear.php.net/manual/en/standards.php)
 - Please use soft tabs (four spaces) instead of hard tabs
 - Make sure you add appropriate test coverage for your changes
 - Run all unit tests in the test directory via `phpunit ./tests`
 - Include commenting where appropriate and add a descriptive pull request message

