Recipe Management Platform
A full-featured recipe-sharing platform built with Laravel, allowing users to create, manage, and explore recipes. This platform supports user authentication, recipe favoriting, pinning, and much more, with an intuitive and responsive design.

Features
User Authentication

User login and registration
Admin and user roles
Recipe Management

Create, edit, and delete recipes
Pin/unpin recipes on user profiles
Bulk delete recipes
Favorites

Favorite and unfavorite recipes
Display total number of favorites for each recipe
Explore Recipes

Search for recipes by category or title
Filter recipes based on user preferences
Profile Management

View and manage recipes posted by the user
Display all user recipes and favorite recipes on the profile
Admin Panel

Manage users and their recipes
Delete users and their associated content
Image Uploads

Upload and display recipe images
Requirements
PHP 8.x
Composer
MySQL (or any supported database)
Node.js and npm
Installation
Clone the Repository:

bash
Copy code
git clone <repository-url>
Navigate to the Project Directory:

bash
Copy code
cd <project-folder>
Install PHP Dependencies:

bash
Copy code
composer install
Install Node.js Dependencies:

bash
Copy code
npm install
Create Environment File:

bash
Copy code
cp .env.example .env
Generate Application Key:

bash
Copy code
php artisan key:generate
Set Up the Database:

Create a new database in MySQL.
Update the .env file with your database credentials:
env
Copy code
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
Run Migrations:

bash
Copy code
php artisan migrate --seed
Compile Frontend Assets:

bash
Copy code
npm run dev
Running the Application
Start the Development Server:

bash
Copy code
php artisan serve
Visit http://127.0.0.1:8000 to access the application.

Access Admin Panel: Log in as an admin to manage users and recipes:

arduino
Copy code
http://127.0.0.1:8000/login
Key Routes
Home Page (Recipe Explorer): /home
Add Recipe: /recipe-add
Profile Page: /profile
Admin Recipe List: /recipe-list
Project Structure
Controllers: Manage business logic for recipes, users, and admin functions.
Models: Represent the database structure for users, recipes, categories, and reviews.
Views: Blade templates for rendering pages such as adding recipes, viewing profiles, and managing recipes.
Contributions
Feel free to fork the project and submit pull requests. Contributions are welcome to improve the functionality and design of the platform!

License
This project is open-source and available under the MIT license.
