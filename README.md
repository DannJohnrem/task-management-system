# Task Management System

This Task Management System is a web application built using Laravel and Blade templating with interactivity provided by jQuery. The system allows users to create, update, delete, and manage tasks efficiently.

## Features

- **Task Creation**: Add new tasks with a title, description, due date, and category.
- **Task Status Management**: Toggle the status of tasks between "Pending" and "Completed" using jQuery for a seamless user experience.
- **Task Editing**: Modify existing tasks.
- **Task Deletion**: Remove tasks from the system.
- **Pagination**: Easily navigate through tasks using built-in Laravel pagination.
- **Responsive Design**: The application is mobile-friendly and adapts to different screen sizes.

## Installation

1. **Clone the repository**:
    ```bash
    git clone https://github.com/your-username/task-management-system.git
    cd task-management-system
    ```

2. **Install dependencies**:
    ```bash
    composer install
    npm install
    ```

3. **Set up the environment**:
    - Copy the `.env.example` file to `.env`:
      ```bash
      cp .env.example .env
      ```
    - Generate an application key:
      ```bash
      php artisan key:generate
      ```
    - Configure your database settings in the `.env` file.

4. **Run database migrations**:
    ```bash
    php artisan migrate
    ```

5. **Run the development server**:
    ```bash
    php artisan serve
    ```

6. **Compile assets**:
    ```bash
    npm run dev
    ```

Now you can access the application at `http://localhost:8000`.

## Usage

### Dashboard

The dashboard provides an overview of all tasks. It displays the task title, description, due date, category, and status. You can also create, edit, delete, and toggle the status of tasks directly from the dashboard.

### Task Status Management

The status of a task can be toggled between "Pending" and "Completed" by clicking the button next to the task. This is powered by jQuery and handled through AJAX requests.

### Task Creation

To create a new task, click the "New Task" button in the header. You will be redirected to a form where you can input the task details.

### Task Editing

To edit a task, click the edit icon next to the task in the dashboard. You will be redirected to a form where you can update the task details.

### Task Deletion

To delete a task, click the delete icon next to the task in the dashboard. A confirmation dialog will appear before the task is removed.

## Code Structure

- **Blade Template (`index.blade.php`)**:
  - The Blade template is responsible for rendering the tasks on the dashboard and includes the interactive elements powered by jQuery.

- **jQuery Interactivity**:
  - jQuery is used to handle AJAX requests for toggling the status of tasks without requiring a page refresh.

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


## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
