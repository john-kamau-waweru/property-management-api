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
