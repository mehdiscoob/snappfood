# Sanppfood Laravel Project

This is a Laravel project that includes a Docker setup for easy development and deployment.

## Installation

### Prerequisites

Make sure you have the following installed on your system:

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/install/)

### Steps

1. **Build and start the Docker containers:**

   ```bash
   docker compose up -d
   ```
   ```bash
   docker exec -it snappfood-laravel-app-1 php artisan refresh-db-command
   ```
This command sets up MySQL, PHP, and Nginx in Docker containers, and it also runs Migrate:
- **MySQL:** Stores application data; configure it in your Laravel app.
- **PHP:** Handles Laravel requests using PHP-FPM.
- **Nginx:** Acts as a reverse proxy, directing HTTP requests to the PHP container.

Access your Laravel app at http://localhost:9000. Code changes reflect in real-time.

2. **Integrate APIs:**

**API Endpoints:**

1. **Create Delay Report:**
    - **Endpoint:** `http://localhost:9000/api/delay/`
    - **Method:** POST
    - **Description:** Creates delay reports. To create a delay report, you need an order_id, which you can obtain from the API: `http://127.0.0.1:9000/api/order/randomly`. Additionally, you need user information obtained from `http://127.0.0.1:9000/api/user/{order.user_id}` for Authorization (api_token), based on the user_id of the order.(You can call `http://127.0.0.1:9000/api/order/[1 to 4]` if you want the order doesn't have Delay Reports)
      Following JSON body:
     ```json
     {
         "order_id": 1 //For example
     }
     ```

2. **Get Delay Reports by Vendor:**
    - **Endpoint:** `http://localhost:9000/api/delay/vendor/order/time/{vendor_id}`
    - **Method:** GET
    - **Description:** Retrieves all delay reports ordered by delay_time for a specific vendor. You can obtain the vendor ID from `http://127.0.0.1:9000/api/vendor/randomly`. If you receive a vendorId, it means this vendor has delay reports.
      Following JSON body:
     ```json
     {
         "vendor_id": 6 //For example
     }
     ```

3. **Assign Agent to Delay Report:**
    - **Endpoint:** `http://localhost:9000/api/delay/agent`
    - **Method:** POST
    - **Description:** This endpoint assigns an agent to a delay report. To assign an agent, send a POST request to this URL. For authorization, use the api_token obtained from `http://127.0.0.1:9000/api/user/randomly?role=agent`.

### Helpers

- **Create Order:**
    - **Endpoint:** `POST http://localhost:9000/api/order`
    - **Method:** POST
    - **Description:** This endpoint allows you to create orders. Send a POST request to this URL, providing the `vendor_id` obtained from `http://localhost:9000/api/vendor/randomly` as a parameter.

- **Create Trips:**
    - **Endpoint:** `POST http://localhost:9000/api/trip`
    - **Method:** POST
    - **Description:** To create trips, send a POST request to this URL. Include the `order_id` obtained from `http://localhost:9000/api/order/randomly` and the driver's authorization (api_token) obtained from `http://localhost:9000/api/user/randomly?role=driver`.

- **Refresh Database:**
    - **Command:** `php artisan refresh-db-command`
    - **Description:** You can refresh the database using this Artisan command. Execute this command in the Laravel project directory to reset and reseed the database, ensuring a clean and updated state for your application.

Feel free to utilize these helper endpoints and commands for managing orders, trips, and database refresh operations in your Laravel application!

### Testing

This Laravel project includes unit tests for the `DelayReportService` class. These tests validate the functionality and statuses of the main APIs.

To run the tests, execute the following command in your terminal within the project directory:

```bash
php artisan test
```






