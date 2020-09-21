Overview
============
Small demo api app which bases mainly on api platform and Symfony 4 LTS.

Installation
============

1. Add to composer.json:
"minimum-stability": "dev",
"prefer-stable": true

2. Execute:
composer require test-area/item-bundle

3. Execute:
bin/console doctrine:migrations:diff
bin/console doctrine:migrations:migrate

4.Load data to db by:
bin/console insert:item-data
OR
php bin/console doctrine:fixtures:load

5. PHPUNIT:
add to phpunit.xml (in main symfony directory) entry:
<directory>./vendor/test-area/item-bundle/tests</directory>

Example:
~~~~
<testsuites>
    <testsuite name="Project Test Suite">
        <directory>./vendor/test-area/item-bundle/tests</directory>
    </testsuite>
</testsuites>
~~~~

6. API GUI and documentation(description of endpoints, curl) should be available by /api for example: http://symfony.localhost/api/

LOCAL ENV
============
https://github.com/eko/docker-symfony
