## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/ammardab3an/student-management.git
    ```

2. Change into the project's directory:

    ```bash
    cd your-student-management
    ```

3. Install PHP dependencies:

    ```bash
    composer install
    ```

4. Install Node.js dependencies:

    ```bash
    npm install
    ```

5. Copy the `.env.example` file to a new file named `.env`:

    ```bash
    cp .env.example .env
    ```

6. Generate the application key:

    ```bash
    php artisan key:generate
    ```

## Configuration

1. Open the `.env` file in your preferred text editor.

2. Configure your database settings:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=your_database_host
    DB_PORT=your_database_port
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

    Replace the placeholders with your actual database details.

3. Configure other settings as needed, such as mail and cache settings.

## Usage

1. Migrate the database:

    ```bash
    php artisan migrate
    ```

2. Seed the database (if applicable):

    ```bash
    php artisan db:seed
    ```

3. Run the development server:

    ```bash
    npm run dev
    ```
    
4. Run the development server:

    ```bash
    php artisan serve
    ```

5. Visit `http://localhost:8000` in your browser.

## Seeded Admin User

- **Email:** admin@example.com
- **Password:** password

## Steps to test all the functionalities of the project
* log in as admin
* /students
* create student
* show student
* edit student
* delete student
* /users
* create user
* show user
* edit user and make it admin
* delete user
* logout
* register a new user
* login as the new user
* /student
* /profile
* edit profile
* logout
