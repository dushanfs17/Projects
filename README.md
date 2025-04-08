# Project 06 - Task Management System

Task Manager is a Laravel application for managing tasks, projects, and categories through a web interface and RESTful API. It leverages Eloquent ORM for database management, Laravel Resource classes for API responses, and Blade with Tailwind CSS for the frontend. Users can create, filter, and update tasks, projects, and categories seamlessly across web and API.

## Features

-   **Web Interface**: List, filter, create, and update tasks; manage projects and categories.
-   **API**: RESTful endpoints for tasks, projects, and categories with status updates.
-   **Database**: MySQL with relationships between tasks, projects, and categories.

## Technologies

-   **Backend**: Laravel
-   **Database**: MySQL (Eloquent ORM)
-   **API**: Laravel Resources (`TaskResource`, `ProjectResource`, `CategoryResource`)
-   **Frontend**: Blade, Tailwind CSS
-   **Validation**: Form Requests (`StoreTaskRequest`, `StoreProjectRequest`, `StoreCategoryRequest`)

## Prerequisites

-   PHP >= 8.0
-   Composer
-   MySQL
-   Node.js/npm (for Vite)
-   Laravel == 11.x
-   Postman (for API testing)

## Project Structure

-   **Controllers**: `TaskController`, `ProjectController`, `CategoryController`
-   **Resources**: `TaskResource`, `ProjectResource`, `CategoryResource`
-   **Requests**: `StoreTaskRequest`, `StoreProjectRequest`, `StoreCategoryRequest`
-   **Models**: `Task`, `Project`, `Category`
-   **Views**: `tasks/index.blade.php`, `projects/index.blade.php`, `categories/index.blade.php`

## Database Schema

### tasks

-   `id`: Primary key
-   `project_id`: Foreign key to `projects`
-   `category_id`: Foreign key to `categories`
-   `title`: String
-   `description`: Text
-   `status`: Enum (`pending`, `in_progress`, `completed`)
-   `due_date`: Date
-   `created_at`, `updated_at`: Timestamps

### projects

-   `id`: Primary key
-   `name`: String
-   `description`: Text
-   `due_date`: Date
-   `created_at`, `updated_at`: Timestamps

### categories

-   `id`: Primary key
-   `name`: String
-   `created_at`, `updated_at`: Timestamps

## Web Routes

### Tasks

-   `GET /tasks`: List and filter tasks
-   `POST /tasks`: Create task
-   `PATCH /tasks/{task}`: Update task status

### Projects

-   `GET /projects`: List projects
-   `POST /projects`: Create project

### Categories

-   `GET /categories`: List categories
-   `POST /categories`: Create category

## Usage

### Web Interface

#### Tasks

-   Navigate to `http://127.0.0.1:8000/tasks`.
-   Use the filter form to narrow down tasks by category or status.
-   Fill out the creation form to add a new task.
-   Change a task’s status using the dropdown.

#### Projects and Categories

-   Visit `http://127.0.0.1:8000/projects` or `/categories` to view and create new entries.

### API Testing with Postman

#### Setup

-   Install Postman (download from [postman.com](https://www.postman.com/)).
-   Create a new collection (e.g., "Task Manager API").

#### Test Endpoints

-   Add each request from the "API Endpoints" section to Postman.
-   Set headers as specified (e.g., `Accept: application/json`).
-   Send requests and verify responses match the examples.

#### Sequence

-   Start with GET requests to check existing data.
-   Use POST to create new records, then PATCH to update task statuses.

## Development Notes

-   **Resources**: API responses are formatted using Laravel Resources for consistency and nested data handling.
-   **Validation**: Form Requests ensure data integrity.
-   **Optimization**: Task status updates share a helper method in `TaskController`.
