# Exam System API (ngrok)

Base URL
https://irrelievable-reina-puzzlingly.ngrok-free.dev

API Base
https://irrelievable-reina-puzzlingly.ngrok-free.dev/api

Notes
- All protected endpoints require Authorization: Bearer <token>
- Content-Type: application/json

Auth
1) Register (public)
POST /api/register
Body (JSON):
{
  "name": "Test User",
  "email": "test@example.com",
  "password": "password123"
}

2) Login (public)
POST /api/login
Body (JSON):
{
  "email": "test@example.com",
  "password": "password123"
}
Response contains:
{
  "success": true,
  "token": "<access_token>",
  "user": { ... }
}

3) Logout (protected)
DELETE /api/logout
Header:
Authorization: Bearer <token>

4) Current user (protected)
GET /api/user
Header:
Authorization: Bearer <token>

Protected resources
All routes below require Authorization: Bearer <token>

Sections
- GET /api/sections
- POST /api/sections
  Body (JSON):
  {
    "name": "Section A",
    "level_id": 1
  }
- GET /api/sections/{section}
- PUT/PATCH /api/sections/{section}
  Body (JSON):
  {
    "name": "Section A",
    "level_id": 1
  }
- DELETE /api/sections/{section}

Laihas
- GET /api/laihas
- POST /api/laihas
  Body (JSON):
  {
    "name": "Laiha 1"
  }
- GET /api/laihas/{laiha}
- PUT/PATCH /api/laihas/{laiha}
  Body (JSON):
  {
    "name": "Laiha 1"
  }
- DELETE /api/laihas/{laiha}

Levels
- GET /api/levels
- POST /api/levels
  Body (JSON):
  {
    "name": "Level 1",
    "laiha_id": 1,
    "time": "08:00-10:00"
  }
- GET /api/levels/{level}
- PUT/PATCH /api/levels/{level}
  Body (JSON):
  {
    "name": "Level 1",
    "laiha_id": 1,
    "time": "08:00-10:00"
  }
- DELETE /api/levels/{level}

Courses
- GET /api/courses
- POST /api/courses
  Body (JSON):
  {
    "section_id": 1,
    "course_name": "Math",
    "course_code": "MTH101",
    "day": "Sunday",
    "date": "2026-05-10",
    "doctor": "Dr. Ahmed",
    "location": "Room 12"
  }
- GET /api/courses/{course}
- PUT/PATCH /api/courses/{course}
  Body (JSON):
  {
    "section_id": 1,
    "course_name": "Math",
    "course_code": "MTH101",
    "day": "Sunday",
    "date": "2026-05-10",
    "doctor": "Dr. Ahmed",
    "location": "Room 12"
  }
- DELETE /api/courses/{course}

Example curl
1) Login
curl -X POST "https://irrelievable-reina-puzzlingly.ngrok-free.dev/api/login" \
  -H "Content-Type: application/json" \
  -d '{"email":"test@example.com","password":"password123"}'

2) List sections (protected)
curl -X GET "https://irrelievable-reina-puzzlingly.ngrok-free.dev/api/sections" \
  -H "Authorization: Bearer <token>" \
  -H "Content-Type: application/json"
