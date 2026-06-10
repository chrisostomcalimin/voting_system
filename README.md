# Student Voting System

## Overview

This is a basic PHP/MySQL student voting system built for a local XAMPP environment. It provides:
- Student registration and login
- One-time voting for registered students
- Live vote progress tracking
- Election result display
- Admin dashboard for candidate management, student listings, and election reset

## Key Pages

- `register.php` - Student signup page
- `login.php` - Student login page
- `vote.php` - Voting page for students after login
- `cast_vote.php` - Processes vote submissions
- `results.php` - Displays election results
- `logout.php` - Student logout page

- `admin_login.php` - Admin login page
- `admin_dashboard.php` - Admin control page
- `manage_candidates.php` - Add and list candidates
- `manage_students.php` - View registered students
- `reset_election.php` - Reset votes and voting status

## Setup Instructions

1. Install XAMPP and start Apache + MySQL.
2. Copy the `student-voting-system` folder into `htdocs`.
3. Import the SQL file into MySQL using phpMyAdmin or the MySQL CLI:

   - `db.sql`

4. Verify database configuration in `config/db.php`.
   - The file currently uses:
     - `host: localhost`
     - `user: root`
     - `password: `` (empty)
     - `dbname: voting_system`

   - Note: `db.sql` creates a database named `student_voting_system`. Make sure the database name matches or update `config/db.php` accordingly.

5. Create an admin account manually because the current SQL file does not include an `admins` table.

   Example SQL:

   ```sql
   CREATE TABLE admins (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) UNIQUE NOT NULL,
       password VARCHAR(255) NOT NULL
   );
   ```

   Then insert a hashed password using PHP:

   ```php
   <?php
   echo password_hash('admin123', PASSWORD_DEFAULT);
   ?>
   ```

   Finally insert the admin record using the generated hash:

   ```sql
   INSERT INTO admins (username, password)
   VALUES ('admin', '<generated_hash>');
   ```

## How to Use

### Student Flow

1. Open `register.php` to create a student account.
2. After successful registration, the system redirects to `login.php`.
3. Log in using your Student ID and password.
4. Choose a candidate on `vote.php` and submit your vote.
5. If voting is successful, the student is marked as having voted and cannot vote again.
6. View the current election statistics and results on `results.php`.

### Admin Flow

1. Open `admin_login.php` and sign in with admin credentials.
2. Use `admin_dashboard.php` to access management pages.
3. Add candidates on `manage_candidates.php`.
4. View all registered students on `manage_students.php`.
5. Reset the election on `reset_election.php`.

## Database Structure

### `students`
- `id` INT AUTO_INCREMENT PRIMARY KEY
- `fullname` VARCHAR(100)
- `student_id` VARCHAR(50) UNIQUE
- `email` VARCHAR(100) UNIQUE
- `password` VARCHAR(255)
- `department` VARCHAR(100)
- `has_voted` TINYINT(1) DEFAULT 0
- `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP

### `candidates`
- `id` INT AUTO_INCREMENT PRIMARY KEY
- `name` VARCHAR(100)
- `position` VARCHAR(100)

### `votes`
- `id` INT AUTO_INCREMENT PRIMARY KEY
- `student_id` INT
- `candidate_id` INT
- `voted_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP

## Notes and Known Issues

- The system expects `student_id` to be unique and uses it for student login.
- `manage_candidates.php` includes a file upload field for candidate photo upload, but the database insertion currently does not store the photo path.
- `admin.php` exists in the project root but is currently empty/unused.
- The admin login feature requires a manually created `admins` table and admin credentials.

## Improvements

Possible future improvements:
- Add proper validation and sanitization for form inputs.
- Store candidate photo metadata in the database.
- Add email verification and password reset support.
- Use prepared statements consistently for all database queries.
- Align database names between `db.sql` and `config/db.php`.

## Running the System

Visit the system in your browser via:

- Student registration/login: `http://localhost/student-voting-system/register.php`
- Admin login: `http://localhost/student-voting-system/admin_login.php`

Enjoy the voting system!