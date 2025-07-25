<?php
$password_admin = 'admin123'; // Ganti dengan password yang Anda inginkan
$password_user = 'user1';   // Ganti dengan password yang Anda inginkan

$hashed_password_admin = password_hash($password_admin, PASSWORD_DEFAULT);
$hashed_password_user = password_hash($password_user, PASSWORD_DEFAULT);

echo "Hash untuk '{$password_admin}': " . $hashed_password_admin . "<br>";
echo "Hash untuk '{$password_user}': " . $hashed_password_user . "<br>";
?>