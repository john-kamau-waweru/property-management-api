# Property Management REST API

This is a REST API built with Laravel and it helps in property management.

1. I created the models:

    - User
    - Property
    - Unit
    - Lease
    - Payment
    - Tenant

2. The routes are defined in the routes/api.php.

    - REGISTER => /api/register
    - Register Payload:
      {
      "name": "John Doe",
      "email": "john@doe.com",
      "password": "password",
      "password_confirmation": "password",
      "role": "landlord"
      }
    - LOGIN => /api/login
    - Login Payload:
      {
      "email": "john@doe.com",
      "password": "password"
      }
    - LOGOUT => /api/logout
    - The logout need to have the Bearer token in order for it to work. For testing purposes, we added the token in the Authorization Header with 'Bearer userstoken'. This token will be used by Sanctum to check if the user authorized user.

    - PROPERTIES => /api/properties
    - Adding a property is done by the landlord/admin and the properties belong to the landlord and only they can update/delete their properties. Addition of properties takes in the 'Bearer token', name, and city. Then the properties are bound by the landlords id

    - TENANTS => /api/tenants
    - LEASES => /api/leases
    - Leases can be done on units and they are assigned to tenants. On creation of a lease, it takes unit_id and tenant_id as the foreign keys.

    - PAYMENTS => /api/payments
    - Payments can be done on a certain lease. Lease_id is the foreign key that shows that a certain payment belongs to a particular lease

---

# How to Setup

1. Clone the repo to your local machine or server
2. Create a .env file based on the .env.example
3. Create a database in MySQL based on the database name defined in the .env.example
4. Run composer install to install the dependencies
5. Generate application using the following command: php artisan key:generate
6. Since the application is using Sanctum, publish it: php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
7. Run migrations: php artisan migrate
8. Run php artisan serve to run the application
