# Task Manager PHP MVC

## Description

This Task Manager application is built using PHP's Model-View-Controller (MVC) architecture. It allows users to create, view, edit, and delete tasks. The application includes features such as task sorting, searching by title and status, and pagination for task listing.

## Installation and Setup

### Requirements

- PHP 7/8
- Apache Server
- MySQL

### Installation Steps

1. **Database Setup:**

   - Create a database named `task_manager` in your MySQL server.
   - Import the SQL file `task_manager.sql` provided with this repository to set up the necessary tables.

2. **Setup on Localhost:**

   - Install XAMPP or Laragon for local server environment.
   - Clone or download this repository into your local web server directory (e.g., `htdocs` for XAMPP or `www` for Laragon).
   - If using a custom folder name, adjust the base URL and directory settings in `index.php` accordingly:

     ```php
     define('BASE_URL', 'http://localhost/taskmanager/index.php');
     define('BASE_DIR', 'http://localhost/taskmanager');
     ```

     If the project is directly in the root directory, use:

     ```php
     define('BASE_URL', 'http://localhost/index.php');
     define('BASE_DIR', 'http://localhost/');
     ```

   - Use Variable BASE_URL to get base url.

     If the project is directly in the root directory not on folder /taskmanager, on `router.php` change all this:
     /taskmanager

     ```php
        case "/":
        case "/taskmanager/":
        case "/taskmanager/index.php":
            $homeController = new HomeController();
            $homeController->index();
            break;
     ```

     /

     ```php
        case "/":
        case "/index.php":
            $homeController = new HomeController();
            $homeController->index();
           break;
     ```

3. **Accessing the Application:**

   - Open your web browser and enter the base URL (`BASE_URL`) to access the application.
   - Example URLs:
     - `http://localhost/taskmanager/index.php` (if inside `/taskmanager`)
     - `http://localhost/index.php` (if at the root directory)

### Project Directory

```php
    📦 taskmanager
    ├─ controllers
    │  ├─ BaseController.php
    │  └─ HomeController.php
    ├─ css
    ├─ image
    ├─ js
    ├─ models
    │  ├─ BaseModel.php
    │  └─ TaskModel.php
    ├─ views
    │  ├─ task
    │  │  ├─ create.php
    │  │  └─ view.php
    │  ├─ templates
    │  │  ├─ footer.php
    │  │  └─ header.php
    │  └─ index.php
    ├─ config.php
    ├─ index.php
    ├─ README.md
    ├─ router.php
    └─ task_manager.sql
```

## Testing

- After setup, navigate to the application URL and ensure all CRUD (Create, Read, Update, Delete) operations work as expected.
- Test features such as task creation, editing, deletion, sorting by columns, searching by title/status, and pagination.

## Additional Notes

- Modify database configurations (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`) in `config.php` if required.
- Ensure proper file permissions and server configurations to avoid any access or functionality issues.

## Additional Resource

- Templates using [Adminator](https://github.com/puikinsh/Adminator-admin-dashboard)
