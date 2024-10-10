# User Credit CLI Application

## Description
This project is a PHP backend service for managing users and transactions via CLI commands. The application supports adding transactions, listing users, and generating daily transaction reports.

## Installation

### Prerequisites
- Docker must be installed on your machine.

### Steps
1. Clone the repository:
   ```bash
   git clone <repository_url>
   cd user-credit-service
   ```

2. Build and start the Docker container:
   ```bash
   make build
   ```

## Running the Application

All interactions with the application are done via the Docker container.

### Available Commands
1. **Add Transaction**:
   ```bash
   make add-transaction userId=<USER_ID> amount=<AMOUNT> date=<DATE>
   ```
   **Example**:
   ```bash
   make add-transaction userId=1 amount=100.50 date=2024-10-10
   ```
   **Example without Docker**:
   ```bash
   php command.php add-transaction 2 55.4 2024-02-12
   ```

2. **List Users**:
   ```bash
   make list-users
   ```
   **Example without Docker**:
   ```bash
   php command.php list-users
   ```

### Stopping the Container
To stop the running container:
```bash
make stop
```

### Open a Shell Inside the Docker Container
To access the shell inside the Docker container:
```bash
make shell
```

## Testing
To run the tests using PHPUnit inside the container:
```bash
make test
```
