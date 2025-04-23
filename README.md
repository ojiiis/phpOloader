# phpOloader

A lightweight PHP loader and initializer module that helps structure and simplify your PHP applications. It includes built-in support for routing, input sanitization, and JSON-based responses.

**Website/Docs:** [https://ojiiis.github.io/phpOloader/](https://ojiiis.github.io/phpOloader/)

---

## Features

- Simple routing structure
- Clean JSON response handling
- Automatic input parsing (`php://input`)
- Optional input sanitization function
- Minimalistic and easy to extend

---

## Installation

You can add `phpOloader` to your project by simply checking if it exists, and writing it to a file:
The loader will also create a default `.htaccess` file in the same directory (if one doesn’t already exist) to enable clean URLs using Apache rewrite rules. You can modify this file to suit your routing needs.


```php
$olink = 'https://ojiiis.github.io/phpOloader/App.php';
$target = __DIR__ . '/App.php';

if (!file_exists($target)) {
    file_put_contents($target, file_get_contents($olink));
}
```

> This will download the latest `App.php` and place it in your project directory.

---

## Usage

```php
require_once 'App.php';

use oRouter\App;

$sanitize = function ($v) {
    return htmlspecialchars(trim($v));
};

$app = new App($sanitize);

// Routing example
if ($app->route['url'] === '/hello') {
    $app->setStatus(1);
    $app->setMessage("Hello, world!");
    $app->setData(["user" => "Guest"]);
} else {
    $app->setErrors(["Invalid path"]);
}

// Output response
header('Content-Type: application/json');
echo json_encode($app->getResponse());
```

---

## Constructor Option

You can pass a sanitization function (callable) to the constructor:

```php
$app = new App(function ($v) {
    return htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
});
```

---

## License

This project is open-source under the [MIT License](LICENSE).

---

## Author

**Ojingiri Samuel**  
Instructor, Developer, Creator of `phpOloader`  
Contact: [official.ojingirisamuel@gmail.com](mailto:official.ojingirisamuel@gmail.com)

```
