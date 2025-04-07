<?php
session_start();
require 'db.php';

// Google OAuth Config
$client_id = "29758585847-e96pcq4ud681j1q52up0mpl9sr0jsvc6.apps.googleusercontent.com";
$client_secret = "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";
$redirect_uri = "http://localhost/google_login/google-callback.php";

// Exchange authorization code for access token
if (isset($_GET['code'])) {
    $token_url = "https://oauth2.googleapis.com/token";
    $params = [
        "code" => $_GET['code'],
        "client_id" => $client_id,
        "client_secret" => $client_secret,
        "redirect_uri" => $redirect_uri,
        "grant_type" => "authorization_code"
    ];

    $response = file_get_contents($token_url, false, stream_context_create([
        'http' => ['method' => 'POST', 'header' => 'Content-Type: application/x-www-form-urlencoded', 'content' => http_build_query($params)]
    ]));
    $token = json_decode($response, true);

    if (isset($token['access_token'])) {
        $user_info = file_get_contents("https://www.googleapis.com/oauth2/v2/userinfo?access_token=" . $token['access_token']);
        $user = json_decode($user_info, true);

        // Save user info to database
        $full_name = $user['name'];
        $email = $user['email'];
        $provider_id = $user['id'];
        $provider = 'Google';

        // Insert/Check user
        $stmt = $conn->prepare("INSERT IGNORE INTO registration (full_name, email, provider, provider_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $full_name, $email, $provider, $provider_id);
        $stmt->execute();

        $_SESSION['user'] = $user;
        
        header("Location: index.php");
        exit();
    }
}
?>
