# Voting App

This is a simple voting application built with Laravel. It allows users to sign up, log in, view candidates, vote for candidates, and view the vote counts. Admins can manage candidates by adding, updating, and deleting them.

## Features

- User authentication (sign up, log in, log out)
- Role-based access control (admin and user)
- Candidate management (add, update, delete candidates)
- Voting system (users can vote for candidates)
- View vote counts for each candidate

## Technologies Used

- Laravel
- Sanctum for API token authentication
- MySQL for database

## API Endpoints

### Authentication

#### Sign Up
- **Endpoint:** `POST /signup`
- **Description:** Sign up a new user.

#### Login
- **Endpoint:** `POST /login`
- **Description:** Log in an existing user.

#### Logout
- **Endpoint:** `POST /logout`
- **Description:** Log out the current user.
- **Headers:** `Authorization: Bearer <token>`

### Candidates

#### Get Candidates
- **Endpoint:** `GET /candidates`
- **Description:** Get the list of all candidates.
- **Headers:** `Authorization: Bearer <token>`

#### Add Candidate (Admin only)
- **Endpoint:** `POST /candidate`
- **Description:** Add a new candidate.
- **Headers:** `Authorization: Bearer <token>`

#### Update Candidate (Admin only)
- **Endpoint:** `PUT /candidate/:id`
- **Description:** Update a candidate by ID.
- **Headers:** `Authorization: Bearer <token>`

#### Delete Candidate (Admin only)
- **Endpoint:** `DELETE /candidate/:id`
- **Description:** Delete a candidate by ID.
- **Headers:** `Authorization: Bearer <token>`

### Voting

#### Get Vote Count
- **Endpoint:** `GET /getvotes`
- **Description:** Get the count of votes for each candidate.
- **Headers:** `Authorization: Bearer <token>`

#### Vote for Candidate (User only)
- **Endpoint:** `POST /votecandidate/:id`
- **Description:** Vote for a candidate.
- **Headers:** `Authorization: Bearer <token>`

### Users

#### Get Users (Admin only)
- **Endpoint:** `GET /users`
- **Description:** Get the list of all users with the role 'user'.
- **Headers:** `Authorization: Bearer <token>`

## How to Run the Project

1. Clone the repository:
   ```sh
   git clone https://github.com/yourusername/voting_app.git
   ```

2. Run database migrations:
```sh
 php artisan migrate
 ```

3. Run dev server:
```sh
php artisan serve
```
