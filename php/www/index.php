<?php
require 'vendor/autoload.php';
use \Firebase\JWT\JWT;

$expire = time() + 3600;
$key = "example_key";
$alg = 'HS256';
$issuer = 'admin';
$jwt_cookie_name = $issuer . '-session';

// POST 時
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
   $payload = array(
            "iss" => $issuer,
            "iat" => time(),
            "exp" => $expire,
            "sub" => $_POST['user_id']);
   // print_r ($payload);
   setcookie($jwt_cookie_name, JWT::encode($payload, $key), $expire);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title>sample</title>
</head>
<body>
<h1>Hey. please input credential!</h1>
<form action="index.php" method="post">
<input type="text" name="user_id" value=""/>
<input type="password" name="password" value=""/>
<button type="submit">login</button>
</form>
<h2>credential info</h2>
<p>
<?php
$jwt = $_COOKIE[$jwt_cookie_name];
if ($jwt) {
   print_r (JWT::decode($jwt, $key, array($alg)));
}
?>
</p>
</body>
</html>
