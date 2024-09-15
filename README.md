# EpicureanEats

EpicureanEats is a food and beverage sales system integrated with Midtrans as a payment gateway. It has two actors: the admin and the customer. The system allows seamless transactions with a robust, secure payment solution.

## Requirements

- PHP 7.4 or higher
- MySQL
- Composer
- Midtrans Account (for payment gateway integration)
```md
## Installation

1. **Clone the repository:**
   
   To set up EpicureanEats, first clone the repository into your local development environment (XAMPP or Laragon).

   ```bash
   git clone https://github.com/akmlnajib/EpicureantEats.git
   ```

   Place the project in your development directory:
   - For **XAMPP**, clone into `XAMPP/htdocs/`
   - For **Laragon**, clone into `laragon/www/`

2. **Database setup:**

   - Open [phpMyAdmin](http://localhost/phpmyadmin/).
   - Create a new database with the name `ee_store`.
   - Import the provided database file into `ee_store`.

3. **Midtrans Setup:**

   - Visit [Midtrans](https://midtrans.com/id) and sign up or log in to get your `Server Key` and `Client Key`.

4. **Configure Midtrans Payment Gateway:**

   - **Step 1:** Open the file located at `C:\laragon\www\ee_store\midtrans\examples\notification-handler.php` (for Laragon) or the equivalent path in XAMPP.
     
     Find the following line:

     ```php
     Config::$serverKey = 'Your Server Key';
     ```

     Replace `'Your Server Key'` with the server key from Midtrans.

     ```php
     Config::$serverKey = 'Your Actual Server Key';
     ```

     Similarly, for debugging, check:

     ```php
     echo htmlspecialchars('Config::$serverKey = \'Your Server Key\';');
     ```

   - **Step 2:** Open the file located at `C:\laragon\www\ee_store\midtrans\examples\snap\checkout-process-simple-version.php`.

     Update the following lines:

     ```php
     Config::$serverKey = 'Your Server Key';
     Config::$clientKey = 'Your Client Key';
     ```

     Replace `'Your Server Key'` and `'Your Client Key'` with the keys provided by Midtrans.

     ```php
     Config::$serverKey = 'Your Actual Server Key';
     Config::$clientKey = 'Your Actual Client Key';
     ```

     Similarly, for debugging:

     ```php
     echo htmlspecialchars('Config::$serverKey = \'Your Server Key\';');
     ```

## Usage

- Admins can manage products, view orders, and monitor transactions.
- Customers can browse food and beverage items, add them to the cart, and proceed with payments using the integrated Midtrans gateway.

## Additional Configuration

- Ensure that your local server is running (XAMPP or Laragon).
- For Customers: Access the application via `http://localhost/ee_store`.
- For Admin: Access the application via `http://localhost/ee_store/admin`.

## Support

For any issues, please reach out to the repository owner or submit an issue via the repository’s issue tracker.
