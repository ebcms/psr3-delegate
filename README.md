# psr3-delegate

php psr3 delegate

## Installation

``` cmd
composer require ebcms/psr3-delegate
```

## Usage

``` php
$logger = new \Ebcms\LoggerDelegate();

$null_logger= new \Psr\Log\NullLogger();
$logger->addLogger($null_logger);
$logger->addLogger(LoggerInterface $...);

$logger->debug('test..');
```
