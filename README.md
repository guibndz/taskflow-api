# Taskflow API

## Overview  
The Taskflow API allows you to manage tasks, users, and workflows. With Docker support, it's easy to set up and run the API locally or in production.

## Installation Instructions  
1. **Clone the repository**  
   ```bash  
   git clone https://github.com/guibndz/taskflow-api.git  
   cd taskflow-api  
   ```  
2. **Build the Docker containers**  
   ```bash  
   docker-compose build  
   ```  
3. **Run the Docker containers**  
   ```bash  
   docker-compose up  
   ```  
4. **Access the API**  
   The API will be available at `http://localhost:8000`.

## Migrations and Seeders  
To run migrations and seed the database, execute the following commands within the Docker container:  
```bash  
docker-compose exec app php artisan migrate --seed  
```

## Endpoint Testing Guidance  
You can use tools like Postman or curl to test the endpoints. Make sure the server is running before you hit any endpoints. Example request:

### Get all tasks  
```bash  
curl -X GET http://localhost:8000/api/tasks  
```

### Create a new task  
```bash  
curl -X POST http://localhost:8000/api/tasks -d '{"name": "New Task"}' -H 'Content-Type: application/json'  
```

## License  
MIT License  
See `LICENSE` for details.