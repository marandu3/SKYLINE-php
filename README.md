# Skyline Technology Website

A modern, responsive website for Skyline Technology with content management system, dark/light mode, and contact form functionality.

## Features

- Responsive design that works on all devices
- Dark and light mode support
- Contact form with database storage
- Admin panel to manage content and view messages
- Database-driven content management
- Modern UI with animations and icons

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache web server with mod_rewrite enabled

## Installation

1. **Clone or download this repository** to your web server's document root or a subdirectory.

2. **Create the database**
   
   Navigate to the `setup` directory in your browser:
   ```
   http://your-domain.com/setup/create_database.php
   ```
   
   This will create the database, tables, and default admin user.
   
   Alternatively, you can manually set up the database by importing the SQL schema:
   ```
   mysql -u your_username -p your_database < database_schema.sql
   ```

3. **Configure database connection**
   
   Update the database connection settings in `config/db_config.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'your_db_username');
   define('DB_PASS', 'your_db_password');
   define('DB_NAME', 'skyline_db');
   ```

4. **Set appropriate permissions**
   
   Make sure the web server has appropriate permissions to write to the logs directory:
   ```
   chmod -R 755 logs/
   ```

5. **Access the website**
   
   Visit your domain in a web browser:
   ```
   http://your-domain.com/
   ```

6. **Access the admin panel**
   
   Visit the admin login page:
   ```
   http://your-domain.com/admin/login.php
   ```
   
   Default admin credentials:
   - Username: admin
   - Password: admin123
   
   **Important:** Change the default password immediately after first login for security.

## Directory Structure

```
/
├── admin/                 # Admin panel
│   ├── dashboard.php      # Admin dashboard
│   ├── login.php          # Admin login
│   ├── messages.php       # View contact messages
│   ├── content.php        # Edit website content
│   └── logout.php         # Admin logout
│
├── assets/                # Static assets
│   └── images/            # Image files
│
├── config/                # Configuration files
│   └── db_config.php      # Database configuration
│
├── includes/              # PHP includes
│   └── contact_handler.php # Contact form handler
│
├── setup/                 # Setup scripts
│   └── create_database.php # Database setup script
│
├── .htaccess              # Apache configuration
├── 404.php                # Custom 404 error page
├── index.php              # Homepage
├── styles.css             # Main stylesheet
└── script.js              # JavaScript file
```

## Customization

### Adding New Content Sections

1. Add the new section to the `website_content` table in the database.
2. Update the `index.php` file to include the new section.
3. Add appropriate styling in `styles.css`.

### Changing Theme Colors

1. Modify the CSS variables in the `:root` section of `styles.css` to change the color scheme.

### Adding New Pages

1. Create a new PHP file in the root directory.
2. Include the header and footer from the main page.
3. Add the page to the navigation menu in all relevant files.

## Security Considerations

- Change the default admin password immediately after installation.
- Keep PHP and MySQL updated to the latest versions.
- Regularly backup your database.
- Consider implementing HTTPS for secure communication.

## License

[MIT License](LICENSE)

## Support

For questions or issues, please contact us at:
- Email: info@skylinetech.com
- Phone: +255 613 980 136 