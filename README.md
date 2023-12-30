# Build and start the containers
```bash
docker compose up --build -d
```

> **NOTE:** Please ensure that the composer install command has finished executing inside the Docker container before you start using the application.

# Import salesmen:
```bash
docker exec -it prosight_php_dev php artisan app:import-salesmen salesmen.csv
```

> **NOTE:** Please ensure that the salesmen.csv file is placed in the /app/storage/app directory before running the command.
