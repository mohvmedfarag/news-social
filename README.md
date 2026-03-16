# 📰 News Social – Laravel Project
## 📌 Overview

This project is a News Platform built using the Laravel Framework.
The platform allows users to browse news, create posts, interact with content, and receive notifications, while administrators manage users, categories, posts, and website settings through a dedicated admin dashboard.

The system also implements performance optimization using Redis caching, SEO techniques, and real-time notifications using Pusher.

# 🚀 Features
## 👤 User Features
### 🔐 Authentication System

- User Registration
- User Login / Logout
- Password Reset via Email
- Secure authentication using Laravel Auth

### 🏠 User Dashboard
- Personalized dashboard for users
- Manage user posts
- View post statistics

### 📝 Posts System
- Create posts
- Edit posts
- Enable / Disable comments
- View number of post views
- Users can interact with posts

### 💬 Comments System
- Users can comment on posts
- Post owners can enable or disable comments

### 🔔 Real-Time Notifications
- Notifications implemented using Pusher
- Users receive notifications for interactions

### ⚡ Performance Optimization
- Home page posts are cached using Redis
- Improves loading speed and performance

### 🔍 Search Engine Optimization (SEO)
- SEO-friendly URLs
- Optimized meta tags
- Improved search visibility

## 🛠 Admin Features
### 🔐 Admin Authentication
- Secure admin login system
- Admin password reset functionality

### 👥 User Management
View all users
- Create users
- Edit users
- Delete users
- Block User
- Manage user information

### 🗂 Category Management
- Create categories
- Edit categories
- Delete categories

### 📰 Post Management
- Manage all user posts
- Edit or delete posts
- Control content visibility

### ⚙ Settings Management
- Manage website settings from admin dashboard

## 🎨 UI & Frontend Tools
- The project uses several UI tools and plugins to enhance the user experience:
- Bootstrap
- Bootstrap Modals
- Summernote WYSIWYG Editor
- jQuery

These tools allow users to create and manage content easily with a rich text editor and dynamic interfaces.

## ⚙ Technologies Used
- Laravel
- PHP
- MySQL
- Redis
- Pusher
- Blade Template Engine
- Bootstrap
- JavaScript
- jQuery

## ⚡ Installation
### 1️⃣ Clone the repository
git clone https://github.com/mohvmedfarag/news-social.git
### 2️⃣ Navigate to project folder
cd news-platform
### 3️⃣ Install dependencies
composer install
### 4️⃣ Copy environment file
cp .env.example .env
### 5️⃣ Generate application key
php artisan key:generate
### 6️⃣ Configure database in .env
DB_DATABASE=news_db
DB_USERNAME=root
DB_PASSWORD=
### 7️⃣ Run migrations
php artisan migrate
### 8️⃣ Start the server
php artisan serve

## 📊 Current Development Progress

✔ User Authentication

✔ User Dashboard

✔ Posts System

✔ Comments System

✔ Post Views Counter

✔ Enable / Disable Comments

✔ Real-time Notifications (Pusher)

✔ Redis Caching for Home Page Posts

✔ SEO Optimization

✔ Admin Authentication

✔ Admin Reset Password

✔ User Management

✔ Category Management

✔ Post Management

✔ Settings Management

## 🚧 More features coming soon.

### 👨‍💻 Author

Mohammed Mohammed Farag

### 🔗 GitHub
https://github.com/mohvmedfarag

### 📜 License

This project is open-source and available under the MIT License.

## 📸 Project Screenshots

![dashboard](https://github.com/user-attachments/assets/c40366b1-2ede-4e55-839e-53a0b14a1c60)
![home](https://github.com/user-attachments/assets/985747a4-b6db-479c-ae1a-84b51271a2da)
![login](https://github.com/user-attachments/assets/bdccc712-0d84-45d5-8b00-867e657921fd)
![posts](https://github.com/user-attachments/assets/4fe7fbab-cab0-44f3-b117-e662e0f71841)
![show](https://github.com/user-attachments/assets/fafabfcc-7706-4cc3-9c8b-865c5bb6969b)
