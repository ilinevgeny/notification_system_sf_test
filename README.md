### Notification system for TestWork

## Installation

### Requirements
- Docker
- Docker-compose
- Composer

### Installation
- Clone the repository
- Run `composer install`
- Run `docker-compose up -d`
- Run `symfony console doctrine:database:create`
- Run `symfony console doctrine:migrations:migrate`
- Run `symfony serve -d`

### Usage
use test/scratches/notification_system_sf.http with PHPStorm to test the API

### Run tests
./vendor/bin/phpunit ./test


## API
