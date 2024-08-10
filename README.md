# Task Management System

This Task Management System is a web application built using Laravel and Blade templating, with interactivity provided by jQuery. The system allows users to create, update, delete, and manage tasks efficiently. The project utilizes Docker and Laravel Sail for easy setup and deployment.

## Features

### Task Creation
- Authenticated users can create tasks with fields including title, description, due date, and category.
- Tasks are saved in the database using Eloquent ORM.
- Form submissions are validated to ensure all required fields are filled out correctly.

### Task Listing
- Displays a list of tasks for the authenticated user.
- Tasks are retrieved from the database using Eloquent ORM.
- Pagination is implemented to allow easy navigation through tasks.

### Task Status Management
- Users can toggle the status of tasks between "Pending" and "Completed".
- Status updates are handled using jQuery for seamless, real-time updates without a full page refresh.

### Task Editing
- Users can update task details such as title, description, due date, and category.
- Updates are saved back to the database using Eloquent ORM.
- Form submissions are validated for correctness.

### Task Deletion
- Users can delete tasks from the system.
- Tasks are removed from the database using Eloquent ORM.

### User Interface
- Responsive UI designed with Tailwind CSS to ensure the application is mobile-friendly and adapts to different screen sizes.
- Blade templates are used for rendering views.

### Interactivity
- jQuery is used to handle interactive features such as toggling task status without reloading the page.
- The following jQuery script is used for handling AJAX requests for toggling task status:

    ```javascript
    $(document).ready(function() {
        $('.toggle-status').click(function() {
            var taskId = $(this).data('id');
            var button = $(this);
            
            $.ajax({
                url: '/tasks/' + taskId + '/toggle-status',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'completed') {
                        button.text('Mark as Pending')
                            .removeClass('bg-green-500 hover:bg-green-600')
                            .addClass('bg-red-500 hover:bg-red-600')
                            .closest('tr').find('td:nth-child(5) span')
                            .removeClass('bg-red-100 text-red-700')
                            .addClass('bg-green-100 text-green-700')
                            .text('Completed');
                    } else {
                        button.text('Mark as Completed')
                            .removeClass('bg-red-500 hover:bg-red-600')
                            .addClass('bg-green-500 hover:bg-green-600')
                            .closest('tr').find('td:nth-child(5) span')
                            .removeClass('bg-green-100 text-green-700')
                            .addClass('bg-red-100 text-red-700')
                            .text('Pending');
                    }
                },
                error: function() {
                    alert('There was an error updating the task status.');
                }
            });
        });
    });
    ```

### Database Migrations and Seeding
- Migrations are created for users and tasks tables.
- Seeders are implemented to populate the database with initial data for users and tasks.

## Setup and Installation

### Prerequisites
- [Docker](https://www.docker.com/get-started) installed on your system.
- [Laravel Sail](https://laravel.com/docs/10.x/sail) for managing your Laravel project inside Docker.

### Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/your-username/task-management-system.git
    cd task-management-system
    ```

2. **Install dependencies:**

    ```bash
    composer install
    npm install
    ```

3. **Set up the environment:**

    - Copy the example `.env` file and configure it:

      ```bash
      cp .env.example .env
      ```

    - Generate an application key:

      ```bash
      php artisan key:generate
      ```

    - Configure your database settings in the `.env` file.

4. **Run the Docker containers using Laravel Sail:**

    ```bash
    ./vendor/bin/sail up -d
    ```

5. **Run database migrations:**

    ```bash
    ./vendor/bin/sail artisan migrate
    ```

6. **(Optional) Seed the database with initial data:**

    ```bash
    ./vendor/bin/sail artisan db:seed
    ```

7. **Run the development server:**

    ```bash
    ./vendor/bin/sail artisan serve
    ```

8. **Compile assets:**

    ```bash
    npm run dev
    ```

Now you can access the application at [http://localhost](http://localhost).

## Usage

### Accessing the Application
- Visit [http://localhost](http://localhost) to access the application.

### Dashboard
- The dashboard provides an overview of all tasks, displaying task title, description, due date, category, and status.
- From the dashboard, you can create, edit, delete, and toggle the status of tasks.

### Task Management
- Navigate to the Dashboard to manage tasks.
- Use the "New Task" button to create a new task.
- View the list of tasks, where you can edit, delete, or change the status of any task.

### Task Status Management
- The status of a task can be toggled between "Pending" and "Completed" by clicking the button next to the task.

## Testing (Optional)
- You can run basic unit tests for the Task model and related functionalities using PHPUnit.

    ```bash
    ./vendor/bin/sail test
    ```

## Contributing
- Contributions are welcome! Please open an issue or submit a pull request.

## License
- This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
