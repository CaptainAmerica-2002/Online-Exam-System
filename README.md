# Online Exam System

A web-based Online Exam System developed as an academic project during my Master of Computer Applications (MCA). The application is designed to simplify online examinations by providing separate modules for administrators, teachers, and students.

## 📌 Project Overview

The Online Exam System helps manage examinations through a web application. It is designed to support question management, scheduled and timed examinations, online exam submissions, automatic evaluation, and result generation.

The project uses Laravel for backend development and MySQL for database management.

## 🎯 Objectives

- Simplify the process of conducting online examinations.
- Provide role-based access for administrators, teachers, and students.
- Support question-bank and examination management.
- Allow students to take examinations online.
- Support automatic evaluation of applicable question types.
- Generate and display examination results.

## ✨ Features

- **Admin Module:** Administrative functions for managing the examination system.
- **Teacher Module:** Functions for managing questions and examinations.
- **Student Module:** Access to available examinations and online submissions.
- **Question Bank:** Management of examination questions.
- **Timed Examinations:** Support for time-limited examinations.
- **Automatic Evaluation:** Evaluation of supported question types.
- **Result Generation:** Generation and display of examination results.
- **PDF Marksheets:** PDF result documents, where supported by the application.

*Note: The feature descriptions should be checked against the current implementation before being treated as a complete list of working features.*

## 🛠️ Technologies Used

- **Backend:** PHP
- **Framework:** Laravel 8
- **Frontend:** HTML, CSS, JavaScript, Blade templates
- **CSS Framework:** Tailwind CSS
- **JavaScript Library:** Alpine.js
- **Database:** MySQL
- **Frontend Build Tool:** Laravel Mix
- **PDF Generation:** Laravel DomPDF
- **Local Development Environment:** XAMPP
- **PHP Dependency Manager:** Composer
- **Frontend Dependency Manager:** npm

## 💻 Requirements

Install the following tools before setting up the project:

- XAMPP with a compatible PHP version and MySQL
- Composer
- Node.js and npm
- Git
- A web browser

The project's `composer.json` specifies PHP `^7.3|^8.0` and Laravel `^8.75`. Actual compatibility depends on the PHP version and the installed dependencies.

## ⚙️ Installation and Setup

### 1. Clone the Repository

Open a terminal and run:

```bash
git clone https://github.com/CaptainAmerica-2002/Online-Exam-System.git
```

### 2. Navigate to the Project Directory

```bash
cd Online-Exam-System
```

### 3. Install PHP Dependencies

Run:

```bash
composer install
```

Wait for Composer to finish installing the required packages.

### 4. Configure the Environment

Create your local environment configuration file.

**Windows Command Prompt:**

```cmd
copy .env.example .env
```

If a `.env` file already exists, do not overwrite it.

### 5. Configure the Database

This project is configured to use MySQL.

1. Open the XAMPP Control Panel.
2. Start **Apache** and **MySQL**.
3. Open phpMyAdmin in your browser.
4. Create a database named `laravel`.
5. Open the `.env` file in the project root directory.
6. Update the database configuration to match your local MySQL settings.

Example configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

These are example settings. Change the database name, username, or password if your local MySQL configuration is different.

**Important:** Never upload your actual `.env` file or private credentials to GitHub.

### 6. Generate the Application Key

Run:

```bash
php artisan key:generate
