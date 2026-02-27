# Admart - Classified Ads Platform

> A modern, feature-rich classified ads marketplace platform for buying and selling items online.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PHP Version](https://img.shields.io/badge/PHP-7.4+-blue.svg)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7+-green.svg)](https://www.mysql.com/)

## 📋 Table of Contents


- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Database Setup](#database-setup)
- [Admin Panel](#admin-panel)
- [Contributing](#contributing)
- [License](#license)

## 🎯 Overview

Admart is a comprehensive classified ads platform that enables users to post, search, and manage advertisements for various categories including mobiles, electronics, vehicles, property, jobs, fashion, and more. Built with PHP and MySQL, it provides a robust backend with an intuitive user interface.

## ✨ Features

### User Features
- **User Authentication**: Secure login and signup functionality
- **Post Advertisements**: Create and manage classified ads with images
- **Browse Categories**: Explore ads across multiple categories
- **Search & Filter**: Advanced search and filtering capabilities
- **View Details**: Comprehensive ad detail pages with seller information
- **Manage Ads**: Edit, update, and delete personal advertisements
- **Contact Seller**: Direct contact functionality with sellers

### Admin Features
- **Dashboard**: Comprehensive admin dashboard with analytics
- **User Management**: Add, edit, and manage users
- **Ad Management**: Review, approve, and manage all advertisements
- **Category Management**: Create and manage ad categories
- **Notes Management**: Add and manage internal notes
- **Location Management**: Manage cities and locations
- **Message System**: Handle user inquiries and messages
- **Reports**: View detailed analytics and statistics

### Technical Features
- **Responsive Design**: Mobile-friendly interface
- **SEO Optimized**: Meta tags and sitemap for search engines
- **Security**: Input validation and SQL injection prevention
- **Database**: MySQL with normalized schema
- **Dynamic Content**: Data-driven architecture

## 🛠️ Tech Stack

- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Frontend**: HTML5, CSS3, JavaScript
- **Server**: Apache (XAMPP)
- **Additional**: Bootstrap, Font Awesome, jQuery

## 📦 Installation

### Prerequisites
- XAMPP/WAMP/LAMP stack installed
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web browser
- Git (for version control)

### Steps

1. **Clone the repository**
```bash
git clone https://github.com/yourusername/admart.git
cd admart
```

2. **Place in web directory**
```bash
# For XAMPP on Windows
copy admart C:\xampp\htdocs\

# For XAMPP on Mac/Linux
cp -r admart /Applications/XAMPP/xamppfiles/htdocs/
```

3. **Import database**
```bash
# Open phpMyAdmin
# Create new database named 'edmsdb'
# Import Database Sql File/edmsdb.sql
```

4. **Configure database connection**
- Edit `admin/includes/config.php`
- Set your database credentials:
```php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME', 'edmsdb');
```

5. **Access the application**
```
http://localhost/admart/index.php
```

## ⚙️ Configuration

### Database Configuration
Update `admin/includes/config.php` with your database details:

```php
define('DB_SERVER','localhost');  // Database host
define('DB_USER','root');          // Database user
define('DB_PASS','');              // Database password
define('DB_NAME', 'edmsdb');       // Database name
```

### Directory Permissions
Ensure write permissions for upload directories:
```bash
chmod 755 admin/uploads/
chmod 755 uploads/
```

## 🚀 Usage

### For Users

1. **Sign Up**
   - Click "Sign Up" on the homepage
   - Enter your details and create account
   - Login to your account

2. **Post an Ad**
   - Click "Post Ad" after login
   - Fill in ad details (title, price, category, etc.)
   - Upload images
   - Submit for posting

3. **Search Ads**
   - Use search bar on homepage
   - Filter by category or location
   - Click on ads to view details
   - Contact seller for inquiries

4. **Manage Your Ads**
   - Go to "My Ads" after login
   - View, edit, or delete your advertisements
   - Track ad status and responses

### For Admins

1. **Access Admin Panel**
   - Navigate to `/admin/`
   - Login with admin credentials

2. **Dashboard Features**
   - View system statistics
   - Monitor recent activities
   - Check user analytics

3. **Content Management**
   - Manage Users: Add, edit, remove users
   - Manage Ads: Approve or reject ads
   - Manage Categories: Create ad categories
   - Manage Notes: Add internal notes

## 📁 Project Structure

```
admart/
├── index.php                 # Homepage
├── login.php                 # Login page
├── signup.php                # Registration page
├── post_ad.php              # Ad posting form
├── my_ad.php                # User's ads management
├── view_detail.php          # Ad detail page
├── category.php             # Category page
├── search.php               # Search results
├── contact_us.php           # Contact page
├── navbar.php               # Navigation component
├── footer.php               # Footer component
├── styles.css               # Main stylesheet
├── main.js                  # Main JavaScript
├── country.php              # Country data
├── cities.csv               # Cities data
│
├── admin/                   # Admin panel
│   ├── index.php           # Admin login
│   ├── dashboard.php       # Admin dashboard
│   ├── manage-ads.php      # Manage advertisements
│   ├── manage-user.php     # Manage users
│   ├── manage-categories.php # Manage categories
│   ├── add-user.php        # Add new user
│   ├── edit-ad.php         # Edit advertisement
│   ├── includes/           # Database config
│   ├── css/                # Admin styles
│   ├── js/                 # Admin scripts
│   └── uploads/            # Uploaded files
│
├── images/                  # Static images
├── uploads/                 # User uploads
├── Database Sql File/
│   └── edmsdb.sql          # Database schema
│
└── README.md               # This file
```

## 🗄️ Database Setup

### Import Database
1. Open phpMyAdmin (http://localhost/phpmyadmin/)
2. Create new database: `edmsdb`
3. Go to Import tab
4. Select file: `Database Sql File/edmsdb.sql`
5. Click Import

### Database Tables
- **users**: User accounts and profiles
- **ads**: Advertisement listings
- **categories**: Ad categories
- **cities**: Location data
- **messages**: User messages/inquiries
- **notes**: Admin notes

## 👨‍💼 Admin Panel

### Login
- URL: `http://localhost/admart/admin/`
- Default credentials: (Set up after first run)

### Admin Functions
- Dashboard with analytics
- User management
- Advertisement approval system
- Category management
- Location management
- Message handling
- Password management

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 🐛 Troubleshooting

### Database Connection Error
- Verify MySQL is running
- Check credentials in `admin/includes/config.php`
- Ensure database exists

### File Upload Error
- Check directory permissions
- Verify write access to `uploads/` and `admin/uploads/`

### Login Issues
- Clear browser cache and cookies
- Verify database tables exist
- Check user credentials

## 📞 Support

For issues, questions, or suggestions:
- Create an issue on GitHub
- Contact the development team

## 🎓 Learn More

- [PHP Documentation](https://www.php.net/manual/)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [Bootstrap Framework](https://getbootstrap.com/)

---

**Made with ❤️ by the Admart Team**

Last Updated: February 2026
