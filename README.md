# Booking Microservice

This is the Booking microservice for the ShipAnything platform, handling reservation management and scheduling systems. **This service is protected by the Auth Gateway and requires a valid Bearer token for API access.**

## Features

-   Booking creation and management
-   Schedule management and calendar integration
-   Reservation tracking and status updates
-   Availability checking and slot management
-   User-specific booking history

## Authentication

**All API endpoints (except health check) are protected by the NGINX API Gateway and require a valid Bearer token.**

The authentication flow works as follows:

1. Client sends request to `http://booking.shipanything.test/api/*` with Bearer token
2. NGINX API Gateway intercepts and validates the token with the auth service
3. If valid, NGINX forwards the request with user context headers to this service
4. This service processes the request with authenticated user context

**Example API call:**

```bash
curl -X GET http://booking.shipanything.test/api/bookings \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN"
```

**To get an access token, register/login via the Auth service:**

```bash
# Login to get token
curl -X POST http://auth.shipanything.test/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email": "your@email.com", "password": "yourpassword"}'
```

## API Endpoints

### Public Endpoints (No Authentication Required)

-   `GET /health` - Service health check
-   `GET /api/availability` - Check general availability (no user context)

### Protected Endpoints (Require Bearer Token)

-   `GET /api/bookings` - Get user's bookings
-   `POST /api/bookings` - Create new booking
-   `GET /api/bookings/{id}` - Get specific booking details
-   `PUT /api/bookings/{id}` - Update booking
-   `DELETE /api/bookings/{id}` - Cancel booking
-   `GET /api/bookings/{id}/status` - Get booking status

### Internal Test Endpoints (Container Network Only)

-   `GET /api/test/dbs` - Database connectivity test
-   `GET /api/test/rabbitmq` - RabbitMQ connectivity test
-   `GET /api/test/kafka` - Kafka connectivity test
-   `GET /api/test/auth-status` - Authentication status check

## User Context

**This service automatically receives user context from the NGINX API Gateway:**

-   User ID is available in controllers via `$request->attributes->get('user_id')`
-   User email via `$request->attributes->get('user_email')`
-   All booking data is automatically filtered by authenticated user
-   Booking ownership validation for security

**Example usage in controller:**

```php
public function getBookings(Request $request)
{
    $userId = $request->attributes->get('user_id');
    $userEmail = $request->attributes->get('user_email');

    // Get bookings for the authenticated user only
    $bookings = Booking::where('user_id', $userId)->get();

    return response()->json($bookings);
}
```

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
