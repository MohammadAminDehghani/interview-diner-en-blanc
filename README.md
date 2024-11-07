# Invoice Processing Project

This project simulates sending 1 million invoices to users, designed to test the performance of Laravel’s queuing system and handle a large volume of data with a mocked mailing system. Below are the steps to set up and run the project.

---

## Prerequisites

- **PHP**: 8.1 or higher
- **Laravel**: 10
- **MySQL**: Ensure that MySQL is configured with enough capacity for large datasets
- **Redis**: Used for queue handling and caching
- **Composer**: For dependency management

---

## Installation

Install Dependencies:

composer install
npm install && npm run dev




## Environment Setup:

use the provided .env.
Set your database credentials in the .env file.
Create the Database:

In MySQL, create a database named interview (or set a different name in .env).




## Run Migrations and Seeders:

php artisan migrate --seed



## Queue Configuration:

Ensure Redis is installed and configured in your .env file to handle the queue.
Start the Laravel queue worker to begin processing jobs:
php artisan queue:work




## Simulated Mail Test:

Run the custom command to send the last invoice of each user (1 million invoices) with simulated mailing functionality:
php artisan send:invoices
This will create a log of successfully "sent" invoices with delays and errors to simulate a real email system.






## Monitoring Progress:

You can view the number of successful and failed emails directly in the terminal.
After every 1,000 emails, a summary file with fake email text will be saved in a folder named /storage/app/emails.



The email system simulation includes random delays and errors to mimic real-world behavior.




## Configuration Recommendations for Large Scale
PHP:
Increase memory_limit and max_execution_time in php.ini as needed.
MySQL:
Adjust max_connections and innodb_buffer_pool_size for efficient handling of large data.
Queue Workers:
For production, consider multiple workers and distributed job processing if high throughput is required.
