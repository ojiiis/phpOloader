<?php


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



namespace oRouter;

class App {
    public $route = [];
    private $response = [];
    private $input = [];
    
    public function __construct(callable $useInput = null) {
       $htaccess = __DIR__ . '/.htaccess';

if (!file_exists($htaccess)) {
    file_put_contents($htaccess, <<<HTACCESS
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php [QSA,L]
</IfModule>
HTACCESS
    );
}
        
        
        
        $this->response = [
            "status" => 0,
            "message" => "Wrong path.",
            "errors" => [],
            "data" => []
        ];

        $parse = explode('?', $_SERVER['REQUEST_URI']);
        $this->route['url'] = $parse[0];
        $this->route['query'] = (count($parse) > 1) ? $parse[1] : '';

        $_DATA = json_decode(file_get_contents("php://input"), true);
        if (is_array($_DATA) && count($_DATA) > 0) {
            foreach ($_DATA as $k => $v) {
                $this->input[$k] = $useInput ? $useInput($v) : $v;
            }
        }
    }

    public function setStatus($value) {
        $this->response["status"] = $value;
    }

    public function setMessage($value) {
        $this->response["message"] = $value;
    }

    public function setErrors($value) {
        $this->response["errors"] = $value;
    }

    public function setData($value) {
        $this->response["data"] = $value;
    }

    public function getResponse() {
        return $this->response;
    }
}
?>
