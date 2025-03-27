# Online Voting System

A secure and user-friendly online voting system built with Laravel PHP Framework.

## Features

### For Voters
- Secure registration with Aadhar number verification
- One-time voting capability
- View voting results
- User-friendly interface

### For Administrators
- Dashboard with key statistics
- Manage candidates (add, edit, delete)
- Monitor voter participation
- View detailed voting results
- Track voter turnout

## Technical Requirements

- PHP >= 8.0
- MySQL >= 5.7
- Composer
- Laravel >= 9.0

## Installation

1. Clone the repository
```bash
git clone [repository-url]
cd voting-system
```

2. Install PHP dependencies
```bash
composer install
```

3. Install NPM dependencies
```bash
npm install
```

4. Create environment file
```bash
cp .env.example .env
```

5. Generate application key
```bash
php artisan key:generate
```

6. Configure database in .env file
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=voting_system
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. Run database migrations
```bash
php artisan migrate
```

8. Start the development server
```bash
php artisan serve
```

## Database Structure

### Users Table
- id (Primary Key)
- name
- aadhar_number (Unique)
- password
- role (admin/voter)
- is_voted (boolean)
- created_at
- updated_at

### Candidates Table
- id (Primary Key)
- name
- party
- age
- vote_count
- created_at
- updated_at

### Votes Table
- id (Primary Key)
- user_id (Foreign Key)
- candidate_id (Foreign Key)
- created_at
- updated_at

## Routes

### Public Routes
```
GET / - Welcome page
GET /login - Login page
POST /login - Handle login
GET /signup - Registration page
POST /signup - Handle registration
```

### Protected Routes (Requires Authentication)

#### Voter Routes
```
GET /user/dashboard - Voter dashboard
GET /user/candidates - View candidates
POST /user/vote/{id} - Cast vote
GET /user/results - View results
```

#### Admin Routes
```
GET /admin/dashboard - Admin dashboard
GET /admin/candidates - Manage candidates
POST /admin/candidates - Add candidate
PUT /admin/candidates/{id} - Update candidate
DELETE /admin/candidates/{id} - Delete candidate
GET /admin/users - Manage users
GET /admin/results - View results
```

## Security Features

1. **Authentication**
   - Secure password hashing
   - Aadhar number validation
   - Session management

2. **Authorization**
   - Role-based access control
   - Admin middleware protection
   - One-time voting validation

3. **Data Protection**
   - CSRF protection
   - Input validation
   - XSS prevention
   - Masked Aadhar numbers

