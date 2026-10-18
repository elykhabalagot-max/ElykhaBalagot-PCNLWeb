<?php
session_start();
require_once 'dbconnection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

$error = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    
    $type        = $_POST['type'];
    $iotstudent  = $_POST['iotstudent']; 
    $semester    = $_POST['semester'];   
    $school_year = $_POST['school_year'];
    $summer      = $_POST['summer'];       
    $sex         = $_POST['sex'];           
    $lastname    = $_POST['lastname'];  
    $firstname   = $_POST['firstname'];  
    $middlename  = $_POST['middlename']; 
    $course      = $_POST['course'];  
    $yearlevel   = $_POST['yearlevel'];   
    $s_address   = $_POST['s_address']; 
    $s_number    = $_POST['s_number']; 

    $stmt_email = mysqli_prepare($conn, "SELECT Email FROM users WHERE Id = ?");
    mysqli_stmt_bind_param($stmt_email, "i", $user_id);
    mysqli_stmt_execute($stmt_email);
    $res_email = mysqli_stmt_get_result($stmt_email);
    $user_data = mysqli_fetch_assoc($res_email);
    $s_email = $user_data['Email'] ?? ''; 

    $p_fullname  = $_POST['p_fullname']; 
    $p_address   = $_POST['p_address'];  
    $p_number    = $_POST['p_number']; 
    $p_email     = $_POST['p_email'];  

    $check_stmt = mysqli_prepare($conn, "SELECT StudentId FROM students WHERE UserId = ?");
    mysqli_stmt_bind_param($check_stmt, "i", $user_id);
    mysqli_stmt_execute($check_stmt);
    $check_res = mysqli_stmt_get_result($check_stmt);
    $existing_student = mysqli_fetch_assoc($check_res);

    if ($existing_student && $iotstudent !== 'Old Student') {
        $error = "Enrollment failed: This account already has an existing student record. Please select 'Old Student' in the student status column to proceed.";
    } else {
        try {
            if ($existing_student) {
                $student_id = $existing_student['StudentId'];
                
                $query = "UPDATE students SET StudentType = ?, Iotstudent = ?, Semester = ?, SchoolYear = ?, Summer = ?, Sex = ?, Lastname = ?, Firstname = ?, Middlename = ?, Course = ?, Yearlevel = ?, SAddress = ?, SNumber = ?, SEmail = ?, PFullname = ?, PAddress = ?, PNumber = ?, PEmail = ? WHERE UserId = ?";
                
                $stmt = mysqli_prepare($conn, $query);
                if ($stmt === false) {
                    throw new Exception("Prepare failed: " . mysqli_error($conn));
                }
                
                mysqli_stmt_bind_param($stmt, "ssssssssssssssssssi", $type, $iotstudent, $semester, $school_year, $summer, $sex, $lastname, $firstname, $middlename, $course, $yearlevel, $s_address, $s_number, $s_email, $p_fullname, $p_address, $p_number, $p_email, $user_id);

            } else {
                $query = "INSERT INTO students (UserId, StudentType, Iotstudent, Semester, SchoolYear, Summer, Sex, Lastname, Firstname, Middlename, Course, Yearlevel, SAddress, SNumber, SEmail, PFullname, PAddress, PNumber, PEmail) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                
                $stmt = mysqli_prepare($conn, $query);
                if ($stmt === false) {
                    throw new Exception("Prepare failed: " . mysqli_error($conn));
                }

                mysqli_stmt_bind_param($stmt, "issssssssssssssssss", $user_id, $type, $iotstudent, $semester, $school_year, $summer, $sex, $lastname, $firstname, $middlename, $course, $yearlevel, $s_address, $s_number, $s_email, $p_fullname, $p_address, $p_number, $p_email);
            }

            mysqli_stmt_execute($stmt);

            if ($existing_student) {
                $_SESSION['student_id'] = $student_id;
            } else {
                $_SESSION['student_id'] = mysqli_insert_id($conn);
            }

            $_SESSION['course'] = $course;
            $_SESSION['yearlevel'] = $yearlevel;
            $_SESSION['semester'] = $semester;
            $_SESSION['fullname'] = $firstname . ' ' . $lastname;
            $_SESSION['timeenrolled'] = true;

            header("Location: subject.php");
            exit();

        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) {
                $error = "Database Error: The student email address '{$s_email}' is already registered for another account.";
            } else {
                $error = "Database Error: " . $e->getMessage();
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
}
include("UI/head.php");
include("UI/navheaderuser.php");
?>
<div class="w-full px-6 md:px-10 space-y-8 pt-24 pb-24 md:w-full">
    <div class="shadow-lg rounded-lg bg-grey-900/20 border border-blue-900 px-6 md:px-10 py-6 md:py-10 mx-6 md:mx-10">
            <h1 class="font-extrabold mt-10 text-3xl text-blue-900"style="text-align: center;">Registration Form</h1>
            <br>
            <p class="text-gray-900 text-center text-sm mb-6">Fill in your complete registration details.</p>
            <?php if ($error): ?>
                <div class="bg-red-900 text-white p-3 rounded mb-4 text-sm"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <form id="userFormA" method="POST" action="registrationform.php">
                <h1 class="text-lg font-bold text-blue-900 pt-4 border-t">Student Information</h1>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                     <div>
                        <label class="block text-black-900 text-sm font-bold mb-1">Student Status</label>
                        <select name="type" class="w-full px-3 py-2 border rounded-lg" required>
                            <option value="Regular">Regular</option>
                            <option value="Irregular">Irregular</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-900 text-sm font-bold mb-1">Student Type</label>
                        <select name="iotstudent" class="w-full px-3 py-2 border rounded-lg" required>
                            <option value="Incoming Freshman">Incoming Freshman</option>
                            <option value="Old Student">Old Student</option>
                            <option value="Transferee">Transferee</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-900 text-sm font-bold mb-1">Semester</label>
                        <select name="semester" class="w-full px-3 py-2 border rounded-lg" required>
                            <option value="1st Semester">1st Semester</option>
                            <option value="2nd Semester">2nd Semester</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-900 text-sm font-bold mb-1">School Year</label>
                        <select name="school_year" class="w-full px-3 py-2 border rounded-lg">
                            <option value="2025-2026">2025-2026</option>
                            <option value="2026-2027">2026-2027</option>
                            <option value="2025-2026">2027-2028</option>
                            <option value="2026-2027">2028-2029</option>
                            <option value="2025-2026">2029-2030</option>
                            <option value="2026-2027">2031-2032</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-900 text-sm font-bold mb-1">Summer?</label>
                        <select name="summer" class="w-full px-3 py-2 border rounded-lg">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-900 text-sm font-bold mb-1">Sex</label>
                        <select name="sex" class="w-full px-3 py-2 border rounded-lg" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-900 text-sm font-bold mb-1">Last Name</label>
                        <input type="text" name="lastname" id="lastName" class="w-full px-3 py-2 border rounded-lg" required>
                    </div>
                    <div>
                        <label class="block text-gray-900 text-sm font-bold mb-1">First Name</label>
                        <input type="text" name="firstname" id="firstName" class="w-full px-3 py-2 border rounded-lg" required>
                    </div>
                    <div>
                        <label class="block text-gray-900 text-sm font-bold mb-1">Middle Name</label>
                        <input type="text" name="middlename" id="middleName" class="w-full px-3 py-2 border rounded-lg" >
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-900 text-sm font-bold mb-1">Course / Program</label>
                        <select name="course" class="w-full px-3 py-2 border rounded-lg" required>
                            <option value="BSIT">BS Information Technology (BSIT)</option>
                            <option value="BSCE">BS Civil Engineering (BSCE)</option>
                            <option value="BSCrim">BS Criminology (BSCrim)</option>
                            <option value="BSBA">BS Business Administration (BSBA)</option>
                            <option value="BSA">BS Accountancy (BSA)</option>
                            <option value="BSE">Bachelor of Secondary Education (BSED)</option>
                            <option value="BEE">Bachelor of Elementary Education (BEED)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-900 text-sm font-bold mb-1">Year Level</label>
                        <select name="yearlevel" class="w-full px-3 py-2 border rounded-lg" required>
                            <option value="1st Year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                            <option value="4th Year">4th Year</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-900 text-sm font-bold mb-1">Student Address</label>
                    <input type="text" name="s_address" class="w-full px-3 py-2 border rounded-lg" required>
                </div>

                <div>
                    <label class="block text-gray-900 text-sm font-bold mb-1">Student Contact Number (11 digits)</label>
                    <input type="text" name="s_number" maxlength="11" id="mobileNumber" class="w-full px-3 py-2 border rounded-lg" required>
                </div>

                <h1 class="text-lg font-bold text-blue-900 pt-4 border-t">Parent / Guardian Information</h1>
                
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-1">Parent Full Name</label>
                    <input type="text" name="p_fullname" id="fullName" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div>
                    <label class="block text-gray-900 text-sm font-bold mb-1">Parent Address</label>
                    <input type="text" name="p_address" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-900 text-sm font-bold mb-1">Parent Contact Number</label>
                        <input type="text" name="p_number" id="pmobileNumber" maxlength="11" class="w-full px-3 py-2 border rounded-lg" required>
                    </div>
                    <div>
                        <label class="block text-gray-900 text-sm font-bold mb-1">Parent Email</label>
                        <input type="email" name="p_email" id="pemailAddress" class="w-full px-3 py-2 border rounded-lg" required>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <button type="submit" class="w-full bg-blue-900 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-900 transition mt-6">Submit</button>
                    </div>
                    <div>
                        <button type="reset" class="w-full bg-white text-blur font-bold py-3 px-4 rounded-lg border border-blue-900 hover:border-red-900 hover:bg-red-900 hover:text-white transition mt-6">Clear</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
    <script src="assets/js/uservalidation.js"></script>
</body>
<?php 
include("UI/footer.php");
?>
</html>