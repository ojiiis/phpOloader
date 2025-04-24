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
    public $input = [];
    private $con = null;
    public function __construct(callable $useInput = null,$con = []) {
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
        
        if (isset($con["host"], $con["username"], $con["password"], $con["database"])){
           try{
             $this->con = mysqli_connect($con["host"],$con["username"],$con["password"],$con["database"]);
           }catch(\Exception $e){
               throw $e;
           } 
        }
        
        $this->response = [
            "status" => 0,
            "message" => "Wrong path.",
            "errors" => [],
            "data" => []
        ];
        $cLink = substr($_SERVER["REQUEST_URI"],strlen(explode(basename($_SERVER["SCRIPT_NAME"]),$_SERVER["SCRIPT_NAME"])[0]));
        $this->route['url'] = '/'.$cLink;
        $this->route['query'] = $_SERVER["QUERY_STRING"];

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
    public function runQuery($con = null, $query){
        if($con == null){
            return mysqli_query($this->con,$query);
        }else{
            return mysqli_query($con,$query);
        }
    }
}
?>
