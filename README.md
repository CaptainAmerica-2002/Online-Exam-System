# Online Exam System

## 📌 Project Overview

The Online Exam System is a web-based application developed as an academic project during my Master of Computer Applications (MCA).

The system is designed to simplify the examination process by providing separate modules for administrators, teachers, and students. It supports exam management, online examination submission, automatic evaluation, and result generation.

## 🎯 Objectives

- Simplify the process of conducting online examinations.
- Provide role-based access for administrators, teachers, and students.
- Enable teachers to manage questions and examinations.
- Allow students to take examinations online.
- Automate evaluation and result generation.
- Make examination results available in a convenient format.

## ✨ Features

- **Admin Module:** Administrative functions for managing the examination system.
- **Teacher Module:** Tools for managing questions and examinations.
- **Student Module:** Access to available examinations and online exam submission.
- **Question Bank:** Management of examination questions.
- **Timed Examinations:** Examinations with a time limit.
- **Automatic Evaluation:** Automatic evaluation of supported question types.
- **Result Generation:** Generation and display of examination results.
- **PDF Marksheets:** Downloadable marksheets, if enabled in the application.

*Note: Features listed above describe the intended functionality of the project. Their availability may depend on the current implementation.*

## 🛠️ Technologies Used

- **Backend:** PHP / Laravel
- **Frontend:** HTML, CSS, JavaScript and Blade templates, where applicable
- **Database:** MySQL, if configured
- **Local Development Environment:** XAMPP
- **Dependency Management:** Composer

## 💻 Requirements

Before running the project, ensure that you have the following installed:

- XAMPP with a compatible PHP version
- Composer
- Git
- A web browser

The required PHP version and extensions depend on the Laravel version used by this project.

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

### 3. Install Dependencies

Run:

```bash
composer install
```

### 4. Configure the Environment

Create your environment configuration file:

**Windows Command Prompt:**

```cmd
copy .env.example .env
```

Open the `.env` file and configure the database settings to match your local MySQL configuration.

### 5. Generate the Application Key

```bash
php artisan key:generate
```

### 6. Create the Database

1. Start Apache and MySQL from the XAMPP Control Panel.
2. Open phpMyAdmin in your browser.
3. Create a database using the name configured in your `.env` file.

### 7. Run Database Migrations

If the project includes Laravel migrations, run:

```bash
php artisan migrate
```

If the project uses a supplied SQL database file instead, import that file into your database rather than running migrations blindly.

### 8. Start the Application

From the project directory, run:

```bash
php artisan serve
```

Open the local address displayed in the terminal in your browser.

**Important:** The exact setup process may vary depending on the project's Laravel version, database structure, and configuration. These instructions must be verified against the current source code before being treated as a guaranteed installation procedure.

## 📸 Screenshots

Screenshots of the application's main pages will be added here.

Suggested screenshots:

- Login page
- Admin dashboard
- Teacher dashboard
- Student dashboard
- Examination page
- Results page

## 📚 Academic Information

**Project Name:** Online Exam System  
**Degree:** Master of Computer Applications (MCA)  
**Project Type:** Academic Project

## 👨‍💻 Developer

**GitHub:** [CaptainAmerica-2002](https://github.com/CaptainAmerica-2002)

**Repository:** [Online Exam System](https://github.com/CaptainAmerica-2002/Online-Exam-System)
