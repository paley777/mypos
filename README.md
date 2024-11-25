<a href="https://ibb.co/w79WMN9"><img src="https://i.ibb.co/w79WMN9/logo-app.png" alt="logo-app" border="0"></a>

# MyPOS Version 2.0 | Point of Sales Integrated Systems

MyPOS Version 2.0 is a website-based integrated point of sales system using the Laravel Framework. This system has the features needed by a POS system, starting from management of goods flow, stock, cashier, invoices to reporting.

## Integration
Apart from using Laravel 10, this system also integrates the Bootstrap Framework as a front-end. This system uses SQL and Jquery databases.

## User Features

- Registration, Customer and Supplier Management.
- Management of incoming, outgoing and stock flow of goods.
- Cashier System
- Invoices
- Reporting
- Returns Management
- Receivables Management
  
## System Features

- Using Eloquent from Laravel
- Templates for headers and footers
- Full CRUD integration
- Authentication from Laravel
- Account Role: Super Admin, Admin, Cashier
- Cashier System
- Returns and Receivables management
- Sales Summary

## Optimization

- Table optimized by Datatables.
- Middleware
- FormRequest

## licences

- Under license by Valleryan Virgil Zuliuskandar

## Run Locally

Clone the project

```bash
  git clone [https://github.com/paley777/siperpus.git](https://github.com/paley777/mypos.git)
```

Go to the project directory

```bash
  cd mypos
```

Copy example.env to .env file

```bash
  cp .env.example .env
```

Install dependencies

```bash
  composer install
```

Delete Cache

```bash
  php artisan cache:clear
```
Generate Laravel Key

```bash
  php artisan key:generate
```
Make Storage Link

```bash
  php artisan storage:link
```
Migrate

```bash
   php artisan migrate
```
Start the server

```bash
   php artisan serve
```

## Screenshots
![image](https://github.com/user-attachments/assets/054212d5-18bd-4b03-a2a1-5f529d515e24)
![image](https://github.com/user-attachments/assets/b3b88198-9723-4cee-92c2-452a1c972f97)
![image](https://github.com/user-attachments/assets/2e6b58a0-7458-46cc-a8cf-6624d6f37f44)
![image](https://github.com/user-attachments/assets/72bff507-47ee-4825-91eb-086599563ca2)

## Contributions
Thanks to @DemuraAIdev for contribution in Version 2.0

## Suggestion
For suggestions and input on this system, please email valleryan1212@gmail.com
