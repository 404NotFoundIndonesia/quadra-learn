# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

QuadraLearn is a web-based interactive learning media for quadratic function topics in grade X using the tutorial method. It's an educational platform built with Laravel for mathematics education.

## Technology Stack

- **Backend**: PHP 8.2+, Laravel 11.0
- **Database**: SQLite (development), MySQL Community Server (production)
- **Frontend**: HTML, CSS, JavaScript with Vite build system
- **Authentication**: Laravel built-in authentication
- **Role Management**: Enum-based role system (admin, teacher, student)

## Development Commands

### Backend Commands
```bash
# Install PHP dependencies
composer install

# Run development server
php artisan serve

# Connect application to storage
php artisan storage:link

# Run database migrations
php artisan migrate

# Run database seeders
php artisan db:seed

# Code formatting (Laravel Pint)
./vendor/bin/pint
```

### Frontend Commands
```bash
# Development mode with hot reload
npm run dev

# Build for production
npm run build
```

### Testing
```bash
# Run all tests
php artisan test

# Or using PHPUnit directly
./vendor/bin/phpunit

# Run specific test suite
./vendor/bin/phpunit --testsuite Feature
./vendor/bin/phpunit --testsuite Unit
```

## Application Architecture

### Authentication & Authorization
- Users authenticate with username/password or NIS (Nomor Induk Siswa) for students
- Three role types: `admin`, `teacher`, `student` (defined in `app/Enum/Role.php`)
- Role-based middleware controls access to admin/teacher features
- Students can only access learning content, teachers manage students

### Key Models & Relationships
- **User Model** (`app/Models/User.php`): Central user model with role-based methods
  - `isStudent()` / `isTeacher()` helper methods
  - Avatar handling with default fallback
  - Scopes for filtering students and search functionality

### Route Organization
- Public routes: welcome page, login, register
- Authenticated routes: dashboard, profile management
- Teacher-only routes: student management (`/students`)
- Role middleware: `role:teacher` restricts access to teacher features

### File Storage
- User avatars stored in `storage/app/public/`
- Default avatar: `public/404_Black.jpg`
- Storage linked via `php artisan storage:link`

### Database Structure
- SQLite for development (`database/database.sqlite`)
- Users table includes: name, email, username, nis, role, avatar
- Role stored as string enum value

### Frontend Structure
- Blade templates in `resources/views/`
- Layouts: `app.blade.php` (public), `dashboard.blade.php` (authenticated)
- Components: navbar, sidebar, footer
- Vite handles CSS/JS bundling from `resources/css/app.css` and `resources/js/app.js`

## Code Conventions

### PHP/Laravel Conventions
- Follow PSR-12 coding standards
- Use Laravel Pint for code formatting
- Enum classes for constants (e.g., Role enum)
- Form Request classes for validation
- Resource controllers with standard REST methods
- Blade templates with component-based structure

### Database Conventions
- Migration files follow Laravel timestamp naming
- Foreign keys use standard Laravel conventions
- Use Eloquent relationships over raw queries
- Database seeding for development data

### Frontend Conventions
- Blade templates with semantic HTML
- CSS organized in `resources/css/`
- JavaScript modules in `resources/js/`
- Asset compilation through Vite

## Key Features

### Educational Core (Based on Thesis Proposal)
QuadraLearn is an interactive web-based learning platform for quadratic functions (Grade X) using tutorial methodology. The application implements sequential learning where students must complete each section before advancing.

**Learning Structure:**
- **Pendahuluan**: Introduction to quadratic function basics
- **Materi 1-3**: Progressive modules covering characteristics, graphing, and applications
- **Latihan**: Interactive practice with GeoGebra integration
- **Evaluasi**: Formal assessments with minimum score requirements
- **Tutorial Method**: Lock/unlock progression system ensuring mastery before advancement

### Role-Based Functionality

#### Admin Role
- System management and user oversight
- Platform configuration and maintenance
- Monitor overall usage and performance

#### Teacher Role  
- Student account management (view, search, create, delete)
- Student password reset functionality
- Progress monitoring and assessment review
- Access to student analytics and performance data

#### Student Role
- Sequential tutorial progression through quadratic function concepts
- Interactive explorations and real-world applications
- Practice exercises with immediate feedback
- Formal evaluations with score tracking
- Profile management (avatar, password changes)

### Technical Learning Features
- **GeoGebra Integration**: Visual graphing and mathematical exploration
- **MathJax Support**: Proper mathematical notation rendering
- **Adaptive Learning**: Minimum score requirements for progression
- **Real-world Applications**: Car motion, projectile paths, architectural examples

### Assessment System
- Multiple choice and fill-in-the-blank questions
- Progress tracking with completion percentages
- Minimum threshold requirements (typically 75% for advancement)
- Comprehensive module evaluations

### Authentication Flow
- Registration creates student accounts by default
- Username derived from NIS for students
- Role-based dashboard redirection
- Session-based authentication