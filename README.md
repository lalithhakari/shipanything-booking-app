# Booking Microservice

This is the Booking microservice for the ShipAnything platform, handling reservation management and scheduling systems.

## Features

-   Booking creation and management
-   Schedule management
-   Reservation tracking
-   Availability checking

## Endpoints

-   `GET /health` - Health check
-   `GET /api/test/dbs` - Database connectivity test
-   `GET /api/test/rabbitmq` - RabbitMQ connectivity test
-   `GET /api/test/kafka` - Kafka connectivity test

## Environment Variables

-   `DB_HOST` - PostgreSQL host (`booking-postgres`)
-   `DB_DATABASE` - Database name (`booking_db`)
-   `DB_USERNAME` - Database user (`booking_user`)
-   `DB_PASSWORD` - Database password (`booking_password`)
-   `REDIS_HOST` - Redis host (`booking-redis`)
-   `RABBITMQ_HOST` - RabbitMQ host (`booking-rabbitmq`)
-   `RABBITMQ_USER` - RabbitMQ user (`booking_user`)
-   `RABBITMQ_PASSWORD` - RabbitMQ password (`booking_password`)
-   `KAFKA_BROKERS` - Kafka brokers list (`kafka:29092`)

## Database Connection (Development)

**PostgreSQL:**

-   Host: `localhost`
-   Port: `5436`
-   Database: `booking_db`
-   Username: `booking_user`
-   Password: `booking_password`

**Redis:**

-   Host: `localhost`
-   Port: `6383`

**RabbitMQ Management UI:**

-   URL: http://localhost:15675
-   Username: `booking_user`
-   Password: `booking_password`

## Docker Compose Ports

-   **Application**: 8084
-   **PostgreSQL**: 5436
-   **Redis**: 6383
-   **RabbitMQ AMQP**: 5675
-   **RabbitMQ Management**: 15675

## Development

This service is part of the larger ShipAnything microservices platform. See the main repository README for setup and deployment instructions.

### Running Commands

```bash
# Navigate to the docker folder
cd microservices/booking-app/docker

# Run artisan commands
./cmd.sh php artisan migrate
./cmd.sh php artisan make:controller BookingController
./cmd.sh composer install
```
