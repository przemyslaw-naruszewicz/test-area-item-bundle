Overview
============
Small demo api app which bases mainly on api platform and Symfony 4 LTS.

Installation
============

1/ Add to composer.json:
"minimum-stability": "dev",
"prefer-stable": true

2/ Execute:
composer require test-area/item-bundle

3/ Execute:
bin/console doctrine:migrations:diff
bin/console doctrine:migrations:migrate

4/ Load data to db by:
bin/console insert:item-data
OR
php bin/console doctrine:fixtures:load

5/ PHPUNIT:
Add entry to phpunit.xml (in main symfony directory):
<directory>./vendor/test-area/item-bundle/tests</directory>

Example:
~~~~
<testsuites>
    <testsuite name="Project Test Suite">
        <directory>./vendor/test-area/item-bundle/tests</directory>
    </testsuite>
</testsuites>
~~~~

6/ API GUI and documentation(description of endpoints, curl) should be available by /api for example: http://symfony.localhost/api/

LOCAL ENV
============
https://github.com/eko/docker-symfony

Symfony dependencies:
============
~~~~
    "require": {
        "php": ">=7.1.3",
        "ext-ctype": "*",
        "ext-iconv": "*",
        "api-platform/core": "^2.5",
        "composer/package-versions-deprecated": "^1.11",
        "doctrine/annotations": "^1.0",
        "doctrine/doctrine-bundle": "^2.1",
        "doctrine/doctrine-migrations-bundle": "^3.0",
        "doctrine/orm": "^2.7",
        "nelmio/cors-bundle": "^2.1",
        "phpdocumentor/reflection-docblock": "^5.2",
        "symfony/asset": "4.4.*",
        "symfony/console": "4.4.*",
        "symfony/dotenv": "4.4.*",
        "symfony/expression-language": "4.4.*",
        "symfony/flex": "^1.3.1",
        "symfony/framework-bundle": "4.4.*",
        "symfony/property-access": "4.4.*",
        "symfony/property-info": "4.4.*",
        "symfony/security-bundle": "4.4.*",
        "symfony/serializer": "4.4.*",
        "symfony/twig-bundle": "^4.4",
        "symfony/validator": "4.4.*",
        "symfony/yaml": "4.4.*",
        "test-area/item-bundle": "dev-master"
    },
    "require-dev": {
        "doctrine/doctrine-fixtures-bundle": "^3.3",
        "symfony/browser-kit": "4.4.*",
        "symfony/css-selector": "^4.4",
        "symfony/http-client": "4.4.*",
        "symfony/maker-bundle": "^1.21",
        "symfony/phpunit-bridge": "^5.1",
        "symfony/stopwatch": "^4.4",
        "symfony/web-profiler-bundle": "^4.4",
        "theofidry/alice-data-fixtures": "^1.2"
    },
~~~~
