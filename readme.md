School management software as SaaS, using multi tenant achitecture with multiple database.

## Installation

[:arrow_up: Back to top](#index)

#### Installing dependencies

- PHP >= 7.2
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- MySQL >= 5.6 `OR` MariaDB >= 10.1
- [hrshadhin/laravel-userstamps](https://github.com/hrshadhin/laravel-userstamps.git)
- NodeJS, npm, webpack

#### Download and setup

  ```
  $ git clone https://github.com/hrshadhin/school-management-system.git cloudschool
  ```

- change directory
  ```
  $ cd cloudschool
  ```
- Copy sample `env` file and change configuration according to your need in ".env" file and create Database
  ```
  $ cp .env.example .env
  ```
- Install php libraries
  ```
  $ composer install
  
  - Step by step

    ```
    $ php artisan storage:link
    $ php artisan key:generate --ansi

    # Create database tables and load essential data
    $ php artisan migrate
    $ php artisan db:seed
