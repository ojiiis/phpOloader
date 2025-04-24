# phpOloader 🚀

A lightweight and minimal PHP application loader designed to make building PHP backends faster, more structured, and easier to manage. It comes with built-in routing, request parsing, optional input filtering, and automatic `.htaccess` setup for clean URLs.

---

## 🌐 Website / Docs

🔗 [https://ojiiis.github.io/phpOloader/](https://ojiiis.github.io/phpOloader/)

---

## 📦 Features

- Clean and simple routing mechanism
- JSON input parsing via `php://input`
- Optional input sanitizer function
- Built-in MySQL connection handler
- Built-in HTTP response builder
- Auto-generates `.htaccess` file for clean URLs
- Lightweight and dependency-free

---

## 🛠️ Installation

You can integrate phpOloader into your project by following these simple steps:

### Option 1: Clone or Download
```bash
git clone https://github.com/ojiiis/phpOloader.git
```

Or download and extract the file manually into your project directory.

### Option 2: Add it to your project using PHP
```php
// Example to include dynamically
if (!file_exists("phpOloader.php")) {
    file_put_contents("phpOloader.php", file_get_contents("https://ojiiis.github.io/phpOloader/phpOloader.txt"));
}
require_once "phpOloader.php";
```

---

## ✨ Automatic `.htaccess` Setup

phpOloader automatically writes a working `.htaccess` file (if one doesn't exist) during class initialization:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php [QSA,L]
</IfModule>
```

This enables clean URLs and routing support out of the box.

---

## 🚀 Quick Example

### `index.php`
```php
require_once 'phpOloader.php';

use oRouter\App;

$app = new App(function($input) {
    return htmlspecialchars(trim($input));
}, [
    "host" => "localhost",
    "username" => "root",
    "password" => "",
    "database" => "testdb"
]);

// Check current route
if ($app->route['url'] === '/api/hello') {
    $app->setStatus(1);
    $app->setMessage("Hello from phpOloader!");
    $app->setData(["name" => "Samuel"]);
    echo json_encode($app->getResponse());
}
```

---

## 📥 Example JSON Request
Send JSON data using tools like Postman or `curl`:
```bash
curl -X POST http://localhost/api/submit \
     -H "Content-Type: application/json" \
     -d '{"email": "sam@example.com"}'
```

Then in your PHP:
```php
$email = $app->input["email"] ?? null;
```

---

## 🧠 Database Query Example
```php
$result = $app->runQuery(null, "SELECT * FROM users");
while ($row = mysqli_fetch_assoc($result)) {
    // Process $row
}
```

Or use the built-in connection:
```php
$con = $app->getConnection();
```

---

## 🧾 Response Structure
All responses use a unified format:
```json
{
  "status": 1,
  "message": "Success message",
  "errors": [],
  "data": {}
}
```

---

## ⚠️ Requirements

- PHP 7.0 or higher
- Apache with mod_rewrite enabled
- MySQL (optional if using DB)

---

## 🔐 License / Ownership

```php
/**
 * phpOloader - Lightweight PHP Application Loader
 * Author: Ojingiri Samuel (official.ojingirisamuel@gmail.com)
 * Website: https://ojiiis.github.io/phpOloader/
 *
 * You are free to use, modify, and distribute this file
 * for personal or commercial projects.
 *
 * No warranty is provided, use at your own risk.
 * Credit is appreciated but not required.
 */
```

---

## ❤️ Contributing

Pull requests, feature suggestions, and bug reports are welcome!  
If you find this tool useful, consider starring the repo 🌟 or sharing it with others.

---

## 📫 Contact

**Ojingiri Samuel**  
📧 official.ojingirisamuel@gmail.com  
🔗 [https://ojiiis.github.io/](https://ojiiis.github.io/)

---

Made with 💡 in Nigeria.
