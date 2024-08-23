Overview

This repository contains a simple school management system. It is designed to handle basic school administration tasks such as student management, staff management, attendance, and grading.
Features

    Student Management:
        Add, edit, and delete students
        View student information (name, ID, class, etc.)
        Search for students
    Staff Management:
        Add, edit, and delete staff
        View staff information (name, ID, position, etc.)
        Search for staff
    Attendance:
        Record student and staff attendance
        Generate attendance reports
    Grading:
        Assign grades to students
        Generate grade reports
    User Authentication:
        Secure user login and access control

Technology Stack

    Backend: [Php , Javascript ]
    Database: [SQLite]
    Framework: [Laravel + Vuejs + Inertiajs]
    Frontend: [TailwindCss]

Installation

Clone the repository:
Bash

    git clone https://github.com/JermineJunior/Student-Management-System

Use code with caution.

Install dependencies:

    composer install && npm i
copy the .env.example to .env

    cp .env.example .env

Create the application key 

    php artisan key:generate
Set up database: Create a database and configure database credentials in the configuration file.

run the migration and seed the database

    php artisan migrate:seed
Run the application:


    php artisan serve
Use the credentials below to sign in 

    Email: admin@admin.com
    Password: password
