<?php
// Check if the user is logged in
if (isset($_SESSION['username'])) {
// The user is logged in, redirect them to the home page
header('Location: index1.html');
} else {
// The user is not logged in, process the login form
if (isset($_POST['username']) && isset($_POST['password'])) {
// Get the username and password from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the username and password are valid
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
// The username and password are valid, log the user in
$_SESSION['username'] = $username;
header('Location: index.php');
} else {
// The username and password are not valid, show an error message
echo '<div class="error">Invalid username or password</div>';
}
}

// Check if the password is strong
if (!isStrongPassword($password)) {
// The password is not strong, show an error message
echo '<div class="error">The password must be at least 12 characters long and contain a mix of uppercase and lowercase letters, numbers, and symbols.</div>';
}
}

// This function checks if the password is strong
function isStrongPassword($password) {
// The password must be at least 12 characters long
if (strlen($password) < 12) {
return false;
}

// The password must contain a mix of uppercase and lowercase letters, numbers, and symbols
$uppercase = preg_match('/[A-Z]/', $password);
$lowercase = preg_match('/[a-z]/', $password);
$number = preg_match('/[0-9]/', $password);
$symbol = preg_match('/[!@#$%^&*()_+-={}|:<>?,.]/', $password);

if (!$uppercase || !$lowercase || !$number || !$symbol) {
return false;
}

// The password is strong
return true;
}
?>