<?php
session_start();
require_once'dbconnection.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname']); 
    $email = trim($_POST['email']);  
    $password = $_POST['password'];   
    $role = 'student';

    if (strlen($password) < 6 || !preg_match('/[a-zA-Z]/', $password) || !preg_match('/\d/', $password) || !preg_match('/[^a-zA-Z0-9]/', $password)) {
        $error = "Password must be at least 6 characters long and contain letters, numbers, and special characters.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare($conn, "INSERT INTO users (Fullname, Email, Password, Role) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $hashed_password, $role);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['user_id'] = mysqli_insert_id($conn);
            $_SESSION['fullname'] = $fullname;
            $_SESSION['role'] = $role;

            header("Location: login.php");
            exit();
        } else {
            $error = "Registration failed. Email might already be in use.";
        }
    }
}
include("UI/head.php");
include("UI/navheadout.php");
?>
<div class="flex mt-40 mb-20 items-center justify-center">
    <div class="w-full max-w-xl rounded-3xl border border-blue-900 bg-white shadow-2xl overflow-hidden"">
        <div class="p-8 pb-8">
            <div class="flex justify-center mb-4">
                <img src="UI/pcnllogo.png" alt="PCNL Logo" class="h-28 object-contain" width="120px" height="120px" />
            </div>
        <h1 class="text-center text-2xl font-bold text-blue-900 leading-tight mb-8">PCNL Enrollment<br>Management System</h1>
       
        <h1 class="text-center text-2xl font-bold text-blue-900 leading-tight mb-8">Register</h1>
        <p style="color: red;"><?php echo $error; ?></p>
        <form id="registerForm" action="register.php" name="regForm" method="POST" class="space-y-4">
            
            <div class="mb-7">
                <label for="fullname" class="block text-xl font-bold text-blue-950 mb-1">Username:</label>
                <input type="text" id="fullname" name="fullname" class="w-full rounded-2xl border border-blue-900 text-blue-950 shadow-inner focus:ring-2 px-4 py-2" required>
            </div>

            <div class="mb-7">
                <label for="email" class="block text-xl font-bold text-blue-950 mb-1">Email Address:</label>
                <input type="text" name="email" id="email" class="w-full rounded-2xl border border-blue-900 text-blue-950 shadow-inner focus:ring-2 px-4 py-2" required >
                <p id="emailError" class="text-red-900 text-xs mt-1"></p>
                <p class="text-gray-900 text-xs mt-1">Must end with @gmail.com.</p>
            </div>

            <div class="mb-7">
                <label for="password" class="block text-xl font-bold text-blue-950 mb-1">Password:</label>
                <input type="password" id="password" name="password" class="w-full rounded-2xl border border-blue-900 text-blue-950 shadow-inner focus:ring-2 px-4 py-2" required >
                <p id="passwordError" class="text-red-900 text-xs mt-1"></p>
                <p class="text-gray-900 text-xs mt-1">Must be 6+ chars with letters, numbers, & special characters.</p>
            </div>
            <button type="submit" class="w-full bg-blue-900 text-white font-bold py-2 px-4 rounded-lg border border-blue-900 hover:text-blue-900 hover:bg-white transition btn btn-block">Register Account</button>
        </form>
        </div>
        <div class="border-t border-blue-900 py-10 px-6 text-center space-y-2">
            <a href="login.php" class="text-xl mt-2 font-bold text-blue-900 hover:underline">Already have an account? Login</a>
        </div>
    </div>
    </div>
    <script src="assets/js/validation.js"></script>
</div>
</body>
<?php 
include("UI/footer.php");
?>
</html>