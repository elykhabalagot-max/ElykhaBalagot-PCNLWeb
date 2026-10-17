<?php
session_start();
require_once'dbconnection.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']); 
    $password = $_POST['password']; 

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE Email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['Password'])) {
        $_SESSION['user_id'] = $user['Id'];
        $_SESSION['fullname'] = $user['Fullname'];
        $_SESSION['role'] = strtolower($user['Role']);

        if ($_SESSION['role'] === 'admin') {
            header("Location: admin_student.php");
            exit();
        } else {

            $stmt2 = mysqli_prepare($conn, "SELECT * FROM students WHERE UserId = ?");
            mysqli_stmt_bind_param($stmt2, "i", $user['Id']);
            mysqli_stmt_execute($stmt2);
            $res2 = mysqli_stmt_get_result($stmt2);
            $student = mysqli_fetch_assoc($res2);

            if ($student) {
                $_SESSION['student_id'] = $student['StudentId'];
                $_SESSION['course'] = $student['Course'];
                $_SESSION['yearlevel'] = $student['Yearlevel'];
                $_SESSION['semester'] = $student['Semester'];
                $_SESSION['fullname'] = $student['Firstname'] . ' ' . $student['Lastname'];
                $_SESSION['TimeEnrolled'] = true;
                header("Location: subject.php");
            } else {
                header("Location: registrationform.php");
            }
            exit();
        }
    } else {
        $error = "Invalid email or password.";
    }
}

include("UI/head.php");
include("UI/navheadout.php");
?>
<div class="flex mt-40 mb-20 items-center justify-center">
    <div class="w-full max-w-xl rounded-3xl border border-blue-900 bg-white shadow-2xl overflow-hidden">
      <div class="p-8 pb-8">
        <div class="flex justify-center mb-4">
          <img src="UI/pcnllogo.png" alt="PCNL Logo" class="h-28 object-contain" width="120px" height="120px" />
        </div>

          <h1 class="text-center text-2xl font-bold text-blue-900 leading-tight mb-8">PCNL Enrollment<br>Management System</h1>

          <p style="color: red;"><?php echo $error; ?></p>

          <h1 class="text-center text-2xl font-bold text-blue-900 leading-tight mb-5">Login</h1>
        
          <form method="POST" id="loginForm" action="login.php" name="loginForm">
            <div class="mb-7">
              <label for="email" class="block text-xl font-bold text-blue-950 mb-1">Email:</label>
              <input type="text" name="email" id="email" class="w-full rounded-2xl border border-blue-900 text-blue-950 shadow-inner focus:ring-2 px-4 py-2" name="loginUser" required/>
            </div>
            <div class="mb-7">
              <label for="password" class="block text-xl font-bold text-blue-950 mb-1">Password:</label>
              <input type="password" name="password" id=password class="w-full rounded-2xl border border-blue-900 text-blue-950 shadow-inner focus:ring-2 px-4 py-2" name="loginUser" required/>
            </div>
              <button type="submit" name="login" class="w-full rounded-2xl bg-blue-900 py-3 text-xl font-bold text-white shadow-md focus:outline-none focus:ring-2 mt-8 focus:ring-blue-900 focus:ring-offset-2 "> Login</button>
          </form>

      </div>
        <div class="border-t border-blue-900 py-10 px-6 text-center space-y-2">
          <div>
            <a href="register.php" class="text-xl mb-4 font-bold text-blue-900 hover:underline">Create Account</a>
          </div>
        </div>
    </div>
  </div>
</body>
<?php
include("UI/footer.php");
?>
</html>