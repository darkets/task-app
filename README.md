# Task Manager

## Description

Task Manager is a simple and efficient to-do app that allows users to view and manage tasks. Users can create tasks with detailed descriptions, making it easy to stay organized and on top of their daily activities.

### Features

- **View and Manage Tasks:** Easily navigate through your tasks and efficiently manage them within the application.
- **Create Tasks:** Add new tasks with detailed descriptions to keep track of your to-do list.

## Prerequisites

Before you begin with the installation, ensure that your system meets the following requirements:

- PHP version 7.4 or higher
- MySQL version 5.7 or higher OR MariaDB version 10.4 or higher
- Composer version 2.6 or higher

## Installation

1. **Clone Repository:**
   ```bash
   git clone https://github.com/darkets/task-manager.git
   ```
2. **Import Database Schema:**
    - Import the `task_manager_schema.sql` file into your MySQL or MariaDB database.

3. **Install Dependencies:**
    - Run the following command to install the required dependencies using Composer:
      ```bash
      composer install
      ```

4. **Copy and Configure .env File:**
    - Copy the `.env.example` file to create a new `.env` file.
    - Configure the database settings in the `.env` file.

5. **Run the Application:**
    - Navigate to the 'public' directory:
      ```bash
      cd public
      ```
    - Start the PHP built-in server:
      ```bash
      php -S localhost:8000
      ```

Now, you can access the Task Manager app by visiting [http://localhost:8000](http://localhost:8000) in your web browser.
