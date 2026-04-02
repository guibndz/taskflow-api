# Taskflow API

## Overview  
The Taskflow API allows you to manage tasks, users, and workflows. With Docker support, it's easy to set up and run the API locally or in production.

## Table of Contents
- [Installation Instructions](#installation-instructions)
- [Running Migrations and Seeders](#running-migrations-and-seeders)
- [Testing Endpoints](#testing-endpoints)
- [License](#license)

## Installation Instructions

### Prerequisites
- Docker and Docker Compose installed on your machine
- Git installed

### Steps

1. **Clone the repository**  
   ```bash  
   git clone https://github.com/guibndz/taskflow-api.git  
   cd taskflow-api  
   ```  

2. **Copy environment configuration**  
   ```bash  
   cp .env.example .env  
   ```  

3. **Build the Docker containers**  
   ```bash  
   docker-compose build  
   ```  

4. **Run the Docker containers**  
   ```bash  
   docker-compose up -d  
   ```  

5. **Install PHP dependencies**  
   ```bash  
   docker-compose exec app composer install  
   ```  

6. **Generate application key**  
   ```bash  
   docker-compose exec app php artisan key:generate  
   ```  

7. **Verify the API is running**  
   The API will be available at `http://localhost:8000`

## Running Migrations and Seeders

To run migrations and seed the database with sample data:

```bash  
docker-compose exec app php artisan migrate --seed  
```

### Individual Commands

If you prefer to run migrations and seeders separately:

**Run migrations only:**
```bash
docker-compose exec app php artisan migrate
```

**Run seeders only:**
```bash
docker-compose exec app php artisan db:seed
```

**Rollback migrations:**
```bash
docker-compose exec app php artisan migrate:rollback
```

**Reset database (migrate:fresh):**
```bash
docker-compose exec app php artisan migrate:fresh --seed
```

## Testing Endpoints

You can use tools like **Postman**, **Insomnia**, or **curl** to test the endpoints. Make sure the server is running before testing any endpoints.

### Using curl

#### Get all tasks  
```bash  
curl -X GET http://localhost:8000/api/tasks  
```

#### Create a new task  
```bash  
curl -X POST http://localhost:8000/api/tasks \  
  -H 'Content-Type: application/json' \  
  -d '{"name": "New Task", "description": "Task description"}'  
```

#### Get a specific task  
```bash  
curl -X GET http://localhost:8000/api/tasks/1  
```

#### Update a task  
```bash  
curl -X PUT http://localhost:8000/api/tasks/1 \  
  -H 'Content-Type: application/json' \  
  -d '{"name": "Updated Task", "description": "Updated description"}'  
```

#### Delete a task  
```bash  
curl -X DELETE http://localhost:8000/api/tasks/1  
```

### Using Postman or Insomnia

1. Import the API endpoints or create them manually
2. Set the request method (GET, POST, PUT, DELETE)
3. Set the base URL to `http://localhost:8000/api`
4. For POST/PUT requests, add JSON body with appropriate headers
5. Send the request and check the response

### Running Tests

To run the test suite:

```bash
docker-compose exec app php artisan test
```

Or with more details:

```bash
docker-compose exec app php artisan test --verbose
```

## Troubleshooting

### Containers not starting
```bash
docker-compose down
docker-compose build --no-cache
docker-compose up -d
```

### Database connection issues
Verify your `.env` file has correct database credentials matching `compose.yaml`

### Port already in use
Change the port mapping in `compose.yaml` if port 8000 is already in use

## License  
MIT License  
See `LICENSE` for details.