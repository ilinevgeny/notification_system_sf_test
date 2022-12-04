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