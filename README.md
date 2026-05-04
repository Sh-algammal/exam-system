# 🎓 Faculty of Science - Exam Schedule System (API)

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white)

A scalable RESTful API built with **Laravel 12** to manage and display university exam schedules. The system allows regular users to view schedules and enables administrators to seamlessly manage data (Sections, Levels, Laihas, and Courses) with support for **High-Performance Bulk Excel Data Imports**.

---

## ✨ Features

- **Role-Based Authentication**: Secure login mechanism using `Laravel Sanctum` (Admin & User).
- **Public & Protected Endpoints**: 
  - Students/Users can browse sections, levels, laihas, and courses.
  - Admins have exclusive access to CRUD operations for system management.
- **Lightning Fast Excel Imports**: Upload thousands of courses at once! Implemented **Bulk Insert & Chunking** strategies to prevent server timeouts and memory exhaustion.
- **Cloud Ready**: Configured for seamless deployment on `Laravel Cloud` using Serverless PostgreSQL.

---

## 🛠️ Database Structure (Main Entities)

- **Users**: Can be 'admin' or 'user'.
- **Sections (الأقسام)**: Departments within the faculty.
- **Levels (المستويات)**: Academic levels/years.
- **Laihas (اللوائح)**: Academic regulations systems.
- **Courses (المواد)**: Contains course name, code, exam day, date, doctor name, and location, linked to a section.

---

## 🚀 API Endpoints Overview

### 🔐 Authentication
| Method | Endpoint | Description | Access |
|---|---|---|---|
| POST | `/api/login` | Login and receive Sanctum Token | Public |
| POST | `/api/register` | Register a new user | Public |
| DELETE | `/api/logout` | Logout & revoke Token | Auth |

### 📖 Public Endpoints (Read-Only)
| Method | Endpoint | Description | Access |
|---|---|---|---|
| GET | `/api/sections` | Get all sections | Public |
| GET | `/api/courses` | Get all courses (Schedules) | Public |
| GET | `/api/levels` | Get all levels | Public |
| GET | `/api/laihas` | Get all laihas | Public |

### 🛡️ Admin Endpoints (Protected)
*Requires `Authorization: Bearer {token}` header.*
| Method | Endpoint | Description | Access |
|---|---|---|---|
| POST | `/api/sections` | Create a new section | Admin |
| POST | `/api/courses` | Create a new course | Admin |
| POST | `/api/courses/import` | Upload `.xlsx` or `.csv` to bulk insert courses | Admin |
| DELETE | `/api/courses/{id}`| Delete a specific course | Admin |

*(Standard GET/POST/PUT/DELETE are supported for all main entities via API resources).*

---

## 💻 Local Setup & Installation

If you want to run this project on your local machine:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/YourUsername/exam-system.git
   cd exam-system
   ```
2. **Install Composer Dependencies:**
    ```bash
    composer install
    ```
3. **Configure Environment Options:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Make sure to update your `.env` file with your local MySQL database credentials.*
4. **Run Migrations & Seeders:**
    ```bash
    php artisan migrate --seed
    ```
5. **Start the Local Development Server:**
    ```bash
    php artisan serve
    ```
## ☁️ Deployment

This project is deployed on Laravel Cloud.

- **Live API URL:** ``https://faculty-of-science-final-exam.free.laravel.cloud``
- **Database:** Laravel Serverless Postgres.
- **Changes** pushed to the `main` branch on GitHub automatically trigger a seamless deployment.
---
*Developed for the Faculty of Science to streamline the final exams scheduling process.*