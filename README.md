# Laravel Forum - School Project

A functional forum built with Laravel, developed as part of a learning module. This project demonstrates the application of fundamental and advanced web development concepts.

##  Goal

The goal of this project was to develop a fully functional forum using Laravel, with a focus on correctly applying the following concepts:
- MVC (Model-View-Controller) architecture
- Routing and controllers
- Eloquent ORM for database interactions
- User authentication and authorization
- Service layer separation for business logic
- Modern frontend tools (Vite, npm)

---

##  Features

- **User Authentication**: Registration, login, and logout functionality.
- **Forum Structure**: Support for threads, topics, and replies.
- **Admin Role**: Dedicated admin role for user and content management.
- **Rich Text Editor**: Integration with Quill for formatted posts.
- **Dark Mode**: A dark theme for the forum, switchable by the user.
- **Service Layer**: Logic for topics is cleanly separated into a service layer.
- **User Management**: Basic pages for managing user profiles.

---

##  Installation

Follow these steps to run the project locally.

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & npm
- A database (MySQL, PostgreSQL, or SQLite)

### Steps

1.  **Clone the repository**
    ```bash
    git clone <your-repo-url>
    cd <directory-name>
    ```

2.  **Install dependencies**
    ```bash
    composer install
    npm install
    npm run build
    ```

3.  **Configure the environment**
    Copy the example file and adjust the database settings.
    ```bash
    cp .env.example .env
    ```
    Open `.env` and set your `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`.

4.  **Generate the application key**
    ```bash
    php artisan key:generate
    ```

5.  **Run the database migrations**
    This will create the necessary tables in your database.
    ```bash
    php artisan migrate
    ```
    *(Optional)* Populate the database with sample data:
    ```bash
    php artisan db:seed
    ```

6.  **Start the development server**
    ```bash
    php artisan serve
    ```
    Now, open `http://127.0.0.1:8000` in your browser.

---


