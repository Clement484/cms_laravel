# My Laravel CMS Project


**cms_laravel** is a powerful, modular, and developer-friendly Content Management System (CMS) built using the Laravel framework. It is designed to help developers and teams quickly build and manage websites or web applications with structured content, flexible user roles, and a clean codebase that follows Laravel best practices.

This CMS offers all the essential tools needed for content creation, media management, and administrative control — without locking you into a bloated or overly opinionated system. Whether you're building a company website, a blog, or a client platform, **cms_laravel** gives you a solid foundation to start from.

# Project Installation Guide

Clone the repository
- git clone https://github.com/Clement484/cms_laravel.git

Navigate into the project directory
- cd cms_laravel

Copy the example environment file
- cp .env.example .env

Install PHP dependencies
- composer install

Generate the application key
- php artisan key:generate

Configure your database in .env

    Set your DB name, username, and password:
    DB_DATABASE=your_database_name  
    DB_USERNAME=your_db_username  
    DB_PASSWORD=your_db_password

Run database migrations
- php artisan migrate

Seed the database (optional)
- php artisan db:seed

Create storage symlink
- php artisan storage:link

Install Node.js dependencies
- npm install

Compile frontend assets
- npm run dev

Start the Laravel development server
- php artisan serve

Visit your app in the browser
- http://127.0.0.1:8000

  

# ⚠️ Heads Up: Email Setup Required for Registration

When a new user registers, the app tries to send out a confirmation or welcome email. If you're:

- Not connected to the internet, or

- Haven’t set up your email settings in the .env file (like MAIL_MAILER, MAIL_HOST, etc.)

then the registration process will throw an error because it couldn't send the email.

**Good news though** — the account still gets created. So, just head back to the login page and sign in with the credentials you used to register.

To avoid this in the future, you can either:

- Set up your mail config properly in the .env file, **or**

- Use the log mailer during development (add MAIL_MAILER=log in .env) so emails just get logged instead of sent.
