# Installation

#### Requirements
Be sure to have installed in your machine the following:

* [Docker](https://docs.docker.com/install/)

* [Docker Compose](https://docs.docker.com/compose/install/)

Run the commands

```
git clone https://github.com/kaitoqueiroz/laravel-tasks.git

cd laravel-tasks

docker-compose build

docker-compose up

docker exec -it app composer update

docker exec -it app mv .env.example .env

docker exec -it app php artisan key:generate

docker exec -it app php artisan migrate

docker exec -it app php artisan db:seed

```

Run Tests:

```
docker exec -it app php vendor/bin/phpunit
```

# Tasks

### 1. Create an order for a customer based on his subscription next order date
Run the command below in order to create orders where `subscriptions.next-order-date` is set to today:
> docker exec -it app php artisan orders:place-next-order-date-today

You could Check the log:
> docker exec -it app tail storage/logs/laravel.log

Or visiting:
[http://localhost/api/orders](http://localhost/api/orders)

### 2. Set the next order date of the customer’s subscription based on the day iteration
The command for task #1 will execute automatically the task #2. The next order date will be set based on the iteration day. It could be checked doing a GET Request to [http://localhost/api/subscriptions](http://localhost/api/subscriptions) or just access with the browser.

### 3. Set the iteration frequency for a customer

send a `PUT` request to [http://localhost/api/subscriptions/set-iteration-frequency](http://localhost/api/subscriptions/set-iteration-frequency) with Content-Type `application/json`

Having in the body:
```
{
	"customer_id": 2,
	"frequency": 5
}
```

### 4. Get last paid order date for all customers

Do a GET Request to [http://localhost/api/customers/last-paid-order](http://localhost/api/customers/last-paid-order) or just access with the browser

### 5. Get all customers with more than one paid order

Do a GET Request to [http://localhost/api/customers/more-than-one-paid-order](http://localhost/api/customers/more-than-one-paid-order) or just access with the browser

### 6. Get all customers with an active subscription and with at least one paid order

Do a GET Request to [http://localhost/api/customers/active-subscription-and-paid-order](http://localhost/api/customers/active-subscription-and-paid-order) or just access with the browser

## Deliveries

### 7. Create deliveries when an order is set to paid

Do a PUT Request to [http://localhost/api/orders/set-to-paid/<ORDER_ID>](http://localhost/api/orders/set-to-paid/<ORDER_ID>) and it will set the order to paid and automatically creates a new Delivery.

### 8. Export deliveries to CSV

Do a GET Request to [http://localhost/api/deliveries/export-csv](http://localhost/api/deliveries/export-csv) or just access with the browser.
