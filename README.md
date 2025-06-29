# User Management API

A Symfony-based API for user management with Domain-Driven Design (DDD) architecture.

## Project Overview

This project provides a RESTful API for managing users, including creating, retrieving, updating, and deleting user records. It is built with Symfony 7.3 and follows Domain-Driven Design principles to ensure a clean separation of concerns and maintainable codebase.

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run `docker compose build --pull --no-cache` to build fresh images
3. Run `docker compose up --wait` to set up and start a fresh Symfony project
4. (Optional) Run `docker compose exec php php bin/console doctrine:fixtures:load`
5. Run `docker compose down --remove-orphans` to stop the Docker containers.

## Architecture

The project follows Domain-Driven Design (DDD) architecture with the following structure:

### Domain Layer
- Contains the core business logic, entities, value objects, and domain services
- Located in `src/User/Domain`
- Includes value objects like UserId, Login, Password, and Phone

### Application Layer
- Contains application services that orchestrate domain objects to fulfill use cases
- Located in `src/User/Application`
- Services include UserCreator, UserLoader, UserRemover, and UserUpdater

### Infrastructure Layer
- Contains implementations of repositories, controllers, and external services
- Located in `src/User/Infrastructure`
- Includes the UserController and AccessTokenHandler

## API Documentation

The API uses token-based authentication. Include the token in the Authorization header:
```
Authorization: Bearer testAdmin
```

Available tokens:
- `testAdmin`
- `testUser`

### Endpoints

#### Create User
- **URL**: `/v1/api/users`
- **Method**: `POST`
- **Auth required**: Yes
- **Request Body**:
  ```json
  {
    "login": "username",
    "password": "password",
    "phone": "12345678"
  }
  ```
- **Success Response**: 
  - **Code**: 200
  - **Content**: User object

#### Get User
- **URL**: `/v1/api/users/{id}`
- **Method**: `GET`
- **Auth required**: Yes
- **URL Parameters**: `id=[string]` (8-character user ID)
- **Success Response**: 
  - **Code**: 200
  - **Content**: User object
- **Error Response**: 
  - **Code**: 404
  - **Content**: `null` (if user not found)

#### Update User
- **URL**: `/v1/api/users/{id}`
- **Method**: `PUT`
- **Auth required**: Yes
- **URL Parameters**: `id=[string]` (8-character user ID)
- **Request Body**:
  ```json
  {
    "login": "newLogin",
    "password": "new_pass",
    "phone": "09876543"
  }
  ```
- **Success Response**: 
  - **Code**: 200
  - **Content**: Updated user object

#### Delete User
- **URL**: `/v1/api/users/{id}`
- **Method**: `DELETE`
- **Auth required**: Yes
- **URL Parameters**: `id=[string]` (8-character user ID)
- **Success Response**: 
  - **Code**: 204
  - **Content**: None


