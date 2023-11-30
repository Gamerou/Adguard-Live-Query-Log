
This webpage displays live AdGuard query logs, providing real-time insights into DNS queries made by clients. With a clean interface, it showcases query details such as client IP, domain, and status. Easily configurable with environment variables, it seamlessly integrates with AdGuard and offers a straightforward visual representation of filtered and rewritten queries.

Not optimised for mobile yet!

Here's a step-by-step tutorial on how to install Apache2, PHP, download your GitHub files, place them in the HTML directory, and set environment variables for Apache. Additionally, it includes modifying the `get_query_log.php` file to use the AdGuard URL.

### Step 1: Install Apache2 and PHP

```bash
# Update package lists
sudo apt update

# Install Apache2
sudo apt install apache2

# Install PHP and necessary modules
sudo apt install php libapache2-mod-php php-curl git
```

### Step 2: Download GitHub Files

Assuming your Apache HTML directory is `/var/www/html`, you can download your GitHub files:

```bash
# Navigate to the Apache HTML directory
cd /var/www/html

# Clone your GitHub repository
git clone https://github.com/Gamerou/Adguard-Live-Query-Log

# Make sure permissions are set correctly
sudo chown -R www-data:www-data /var/www/html
sudo chmod -R 755 /var/www/html
```

### Step 3: Set Environment Variables

Edit your Apache virtual host configuration file:

```bash
sudo nano /etc/apache2/sites-available/000-default.conf
```

Add the following lines within the `<VirtualHost>` block:

```apache
<VirtualHost *:80>
    # ... existing configuration ...

    SetEnv AGH_USERNAME "your_username"
    SetEnv AGH_PASSWORD "your_password"

    # ... existing configuration ...
</VirtualHost>
```

Save and exit the text editor. Then, restart Apache:

```bash
sudo service apache2 restart
```

### Step 4: Modify `get_query_log.php`

Edit the `get_query_log.php` file in your HTML directory:

```bash
nano /var/www/html/api/get_query_log.php
```

Replace the AdGuard URL with the correct URL:

```php
// Replace 'YOUR_ADGUARD_URL' with the actual URL
$adGuardURL = 'YOUR_ADGUARD_URL';
```

Save and exit the text editor.

### Step 5: Test

Visit your server's IP or domain in a web browser. You should see your AdGuard Query Log page.

Make sure to replace placeholders such as `your_username`, `your_password`, and `YOUR_ADGUARD_URL` with your actual GitHub information and AdGuard URL.
If you have done everything correctly, you can now go to http://your-ip and see the live query log.
