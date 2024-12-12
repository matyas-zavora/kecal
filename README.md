# Kecal

This is the Kecal project, a PHP-based application using the [Contributte Skeleton](https://github.com/contributte/skeleton). This project uses Docker for development and testing, and GitHub Actions for continuous integration, including PHPUnit tests and code quality checks.

## Requirements

- PHP 8.1+ (8.2 preferred)
- Composer
- Docker (for containerized development)
- GitHub Actions (for CI/CD)

## Setup
### 1. Clone the repository
```bash
git clone https://github.com/your-username/kecal.git
cd kecal
```
### 2. Install dependencies
If you want to set up the environment manually (not using Docker), you'll need to install the Composer dependencies:
```bash
composer install
```
### 3. Running with Docker
If you're using Docker, you can run the project in containers using docker-compose. Make sure Docker and Docker Compose are installed on your machine.

- Start the environment:
  - ```bash
    docker-compose up -d
    ```
  or
  - ```bash
    docker compose up -d
	```
- Run migrations:
  - ```bash
    docker-compose exec php bin/console migrations:migrate
	```
  or
  - ```bash
    docker compose exec php bin/console migrations:migrate
	```
