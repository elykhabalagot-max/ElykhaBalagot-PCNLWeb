<?php
session_start();
require_once 'dbconnection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$message = '';
$error = '';
$search_results = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {

        if ($_POST['action'] === 'add_student') {
            $stmt = mysqli_prepare($conn, "INSERT INTO students (UserId, StudentType, Iotstudent, Semester, SchoolYear,Summer, Sex, Lastname, Firstname, Middlename, Course, Yearlevel, SAddress, SNumber, SEmail, PFullname, PAddress, PNumber, PEmail) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?,?)");
            mysqli_stmt_bind_param($stmt, "issssssssssssssssss",$_SESSION['user_id'],$_POST['type'], $_POST['iotstudent'], $_POST['semester'], $_POST['schoolyear'], $_POST['summer'], $_POST['sex'], $_POST['lastname'], $_POST['firstname'], $_POST['middlename'], $_POST['course'], $_POST['yearlevel'], $_POST['address'], $_POST['mobile'], $_POST['email'], $_POST['pfull'], $_POST['padd'], $_POST['pnum'], $_POST['pemail']);
           if (mysqli_stmt_execute($stmt)) {
                $message = "Student record added successfully!";
            } else {
                $error = "Database Error: " . mysqli_stmt_error($stmt);
            }
            
        } 
       elseif ($_POST['action'] === 'update_student') {
            $stmt = mysqli_prepare($conn, "UPDATE students SET UserId = ?, StudentType = ?, Iotstudent = ?, Semester = ?, SchoolYear = ?, Summer = ?, Sex = ?, Lastname = ?, Firstname = ?, Middlename = ?, Course = ?, Yearlevel = ?, SAddress = ?, SNumber = ?, SEmail = ?, PFullname = ?, PAddress = ?, PNumber = ?, PEmail = ? WHERE StudentId = ?");
            
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "issssssssssssssssssi",$_SESSION['user_id'],$_POST['type'], $_POST['iotstudent'], $_POST['semester'], $_POST['schoolyear'], $_POST['summer'], $_POST['sex'], $_POST['lastname'], $_POST['firstname'], $_POST['middlename'], $_POST['course'], $_POST['yearlevel'], $_POST['address'], $_POST['mobile'], $_POST['email'], $_POST['pfull'], $_POST['padd'], $_POST['pnum'], $_POST['pemail'], $_POST['student_id']);
                
                if (mysqli_stmt_execute($stmt)) {
                    if (mysqli_stmt_affected_rows($stmt) > 0) {
                        $message = "Student updated successfully!";
                    } else {
                        $error= "Notice: 0 rows affected (data was identical or Student ID not found).";
                    }
                } else {
                    $error = "Database Error: " . mysqli_stmt_error($stmt);
                }
            } else {
                $error = "Prepare Error: " . mysqli_error($conn);
            }
        }

        elseif ($_POST['action'] === 'delete_student') {
            $stmt = mysqli_prepare($conn, "DELETE FROM students WHERE StudentId = ?");
            mysqli_stmt_bind_param($stmt, "i", $_POST['student_id']);
           if (mysqli_stmt_execute($stmt)) {
                $message = "Student record deleted successfully!";
            } else {
                $error = "Database Error: " . mysqli_stmt_error($stmt);
            }
        } 
        elseif ($_POST['action'] === 'search_student') {
            $keyword = "%" . $_POST['search_query'] . "%";
            $stmt = mysqli_prepare($conn, "SELECT * FROM students WHERE Firstname LIKE ? OR Lastname LIKE ? OR Course LIKE ? OR StudentId = ?");
            $sid = intval($_POST['search_query']);
            mysqli_stmt_bind_param($stmt, "sssi", $keyword, $keyword, $keyword, $sid);
            if (mysqli_stmt_execute($stmt)) {
                $message = "Student record retrieved successfully!";
            } else {
                $error = "Database Error: " . mysqli_stmt_error($stmt);
            }
            $search_results = mysqli_stmt_get_result($stmt)->fetch_all(MYSQLI_ASSOC);
        }
    }
}

$students = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM students ORDER BY TimeEnrolled DESC"), MYSQLI_ASSOC);

include ('UI/head.php');
include ('UI/navheader.php');
include ('UI/sidenav.php');
?>

<div class="w-full px-6 md:px-10 space-y-8 pt-24 pb-24 md:ml-80 md:w-[calc(100%-20rem)]">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800">Manage Student Registrations</h1>
    </div>

    <?php if ($message): ?>
        <div class="bg-green-900 text-white p-4 rounded shadow font-semibold"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="bg-red-900 text-white p-4 rounded shadow font-semibold"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-lg font-bold mb-3 text-gray-700">Search / Retrieve Student Record</h1>
        <form method="POST" class="flex gap-2">
            <input type="hidden" name="action" value="search_student">
            <input type="text" name="search_query" placeholder="Search by name, course, or student ID..." required class="w-full md:w-2/3 p-2 border rounded text-sm">
            <button type="submit" class="bg-indigo-600 text-white px-5 py-2 rounded text-sm font-bold hover:bg-indigo-700">Search</button>
            <button type="reset" class="bg-indigo-600 text-white px-5 py-2 rounded text-sm font-bold hover:bg-indigo-700">X</button>
        </form>

        <?php if ($search_results !== null): ?>
            <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded text-sm">
                <p class="font-bold text-blue-900 mb-2">Search Results:</p>
                <?php if (count($search_results) > 0): ?>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse bg-white">
                            <tr class="bg-blue-100 text-blue-900">
                                <th class="p-2 border">Student ID</th>
                                <th class="p-2 border">UserID</th>
                                <th class="p-2 border">Student Status</th>
                                <th class="p-2 border">Student Type</th>
                                <th class="p-2 border">Semester</th>
                                <th class="p-2 border">School Year</th>
                                <th class="p-2 border">Summer</th>
                                <th class="p-2 border">Sex</th>
                                <th class="p-2 border">Last Name</th>
                                <th class="p-2 border">First Name</th>
                                <th class="p-2 border">Middle Name</th>
                                <th class="p-2 border">Course</th>
                                <th class="p-2 border">Year Level</th>
                                <th class="p-2 border">Student Address</th>
                                <th class="p-2 border">Student Mobile Number</th>
                                <th class="p-2 border">Student Email</th>
                                <th class="p-2 border">Parents Full Name</th>
                                <th class="p-2 border">Parents Address</th>
                                <th class="p-2 border">Parents Mobile Number</th>
                                <th class="p-2 border">Parents Email</th>
                            </tr>
                            <?php foreach ($search_results as $res): ?>
                            <tr>
                                <td class="p-2 border"><?= $res['StudentId'] ?></td>
                                <td class="p-2 border"><?= $res['UserId'] ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['StudentType']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Iotstudent']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Semester']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['SchoolYear'] ) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Summer']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Sex']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Lastname']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Middlename'] ) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Firstname']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Middlename']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Yearlevel']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['SAddress'] ) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['SNumber']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['SEmail']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['PFullname']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['PAddress'] ) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['PNumber']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['PEmail'] ) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-red-600">No matching student records found.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-bold mb-4 text-gray-700">Add New Student Registration</h2>
        <form method="POST" id="userForm" class="grid grid-cols-1 md:grid-cols-4 gap-3 text-sm">
            <input type="hidden" name="action" value="add_student">
            <div>
                <label class="block font-semibold mb-1">Student Status</label>
                <select name="type" class="w-full px-3 py-2 border rounded-lg" required>
                            <option value="Regular">Regular</option>
                            <option value="Irregular">Irregular</option>
                        </select>
            </div>
            <div>
                <label class="block font-semibold mb-1">Student Type</label>
                <select name="iotstudent" class="w-full px-3 py-2 border rounded-lg" required>
                            <option value="Incoming Freshman">Incoming Freshman</option>
                            <option value="Old Student">Old Student</option>
                            <option value="Transferee">Transferee</option>
                        </select>
            </div>
            <div>
                <label class="block font-semibold mb-1">Semester</label>
                <select name="semester" class="w-full px-3 py-2 border rounded-lg" required>
                            <option value="1st Semester">1st Semester</option>
                            <option value="2nd Semester">2nd Semester</option>
                        </select>
            </div>
            <div>
                <label class="block font-semibold mb-1">School Year</label>
                <select name="schoolyear" class="w-full px-3 py-2 border rounded-lg">
                    <option value="2025-2026">2025-2026</option>
                    <option value="2026-2027">2026-2027</option>
                    <option value="2025-2026">2027-2028</option>
                    <option value="2026-2027">2028-2029</option>
                    <option value="2025-2026">2029-2030</option>
                    <option value="2026-2027">2031-2032</option>
                </select>
            </div>
            <div>
                <label class="block font-semibold mb-1">Summer</label>
                <select name="summer" class="w-full px-3 py-2 border rounded-lg">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
            </div>
            <div>
                <label class="block font-semibold mb-1">Sex</label>
                <select name="sex" class="w-full px-3 py-2 border rounded-lg" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
            </div>
            <div>
                <label class="block font-semibold mb-1">Last Name</label>
                <input type="text" name="lastname" id="lastName" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">First Name</label>
                <input type="text" name="firstname" id="firstName" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Middle Name</label>
                <input type="text" name="middlename" id="middleName" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Course</label>
                <select name="course" class="w-full px-3 py-2 border rounded-lg" required>
                            <option value="BSIT">BS Information Technology (BSIT)</option>
                            <option value="BSCE">BS Civil Engineering (BSCE)</option>
                            <option value="BSCrim">BS Criminology (BSCrim)</option>
                            <option value="BSBA">BS Business Administration (BSBA)</option>
                            <option value="BSA">BS Accountancy (BSA)</option>
                            <option value="BSE">Bachelor of Secondary Education (BSE)</option>
                            <option value="BEE">Bachelor of Elementary Education (BEE)</option>
                        </select>
            </div>
            <div>
                <label class="block font-semibold mb-1">Year Level</label>
                <select name="yearlevel" class="w-full px-3 py-2 border rounded-lg" required>
                            <option value="1st Year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                            <option value="4th Year">4th Year</option>
                        </select>
            </div>
            <div>
                <label class="block font-semibold mb-1">Student Address</label>
                <input type="text" name="address" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Student Mobile Number</label>
                <input type="text" name="mobile" id="mobileNumber" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Student Email</label>
                <input type="text" name="email" id="emailAddress" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Parents Full Name</label>
                <input type="text" name="pfull" id="fullName" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Parents Address</label>
                <input type="text" name="padd" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Parents Mobile Number</label>
                <input type="text" name="pnum" id="pmobileNumber" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Parents Email</label>
                <input type="text" name="pemail" id="pemailAddress" required class="w-full p-2 border rounded">
            </div>
            <button type="submit" class="md:col-span-4 bg-blue-600 text-white font-bold p-2.5 rounded hover:bg-blue-700 mt-2">Save New Student Registration</button>
        </form>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-bold mb-4 text-gray-700">All Student Records (Update / Delete)</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <tr class="bg-gray-200 text-gray-700">
                    <th class="p-2 border">Student ID</th>
                    <th class="p-2 border">UserID</th>
                    <th class="p-2 border">Student Status</th>
                    <th class="p-2 border">Student Type</th>
                    <th class="p-2 border">Semester</th>
                    <th class="p-2 border">School Year</th>
                    <th class="p-2 border">Summer</th>
                    <th class="p-2 border">Sex</th>
                    <th class="p-2 border">Last Name</th>
                    <th class="p-2 border">First Name</th>
                    <th class="p-2 border">Middle Name</th>
                    <th class="p-2 border">Course</th>
                    <th class="p-2 border">Year Level</th>
                    <th class="p-2 border">Student Address</th>
                    <th class="p-2 border">Student Mobile Number</th>
                    <th class="p-2 border">Student Email</th>
                    <th class="p-2 border">Parents Full Name</th>
                    <th class="p-2 border">Parents Address</th>
                    <th class="p-2 border">Parents Mobile Number</th>
                    <th class="p-2 border">Parents Email</th>
                    <th class="p-2 border">Action</th>
                </tr>
                <?php foreach ($students as $stu): ?>
                <tr>
                    <form method="POST" id="userFormB" id="form-<?= $stu['StudentId'] ?>">
                        <input type="hidden" name="action" value="update_student">
                        <input type="hidden" name="student_id" value="<?= $stu['StudentId'] ?>">
                        <td class="p-2 border"><?= $stu['StudentId'] ?></td>
                        <td class="p-2 border"><?= $stu['UserId'] ?></td>
                        <td class="p-2 border"><select name="type" class="w-24 border rounded p-1" required>
                            <option value="" disabled <?= empty($stu['StudentType']) ? 'selected' : '' ?>>Select Status</option>
                            <option value="Regular" <?= ($stu['StudentType'] ?? '') === 'Regular' ? 'selected' : '' ?>>Regular</option>
                            <option value="Irregular" <?= ($stu['StudentType'] ?? '') === 'Irregular' ? 'selected' : '' ?> class="">Irregular</option>
                        </select></td>
                        <td class="p-2 border"><select name="iotstudent" class="w-24 border rounded p-1" required>
                            <option value="" disabled <?= empty($stu['Iotstudent']) ? 'selected' : '' ?>>Select Type</option>
                            <option value="Incoming Freshman" <?= ($stu['Iotstudent'] ?? '') === 'Incoming Freshman' ? 'selected' : '' ?>>Incoming Freshman</option>
                            <option value="Old Student" <?= ($stu['Iotstudent'] ?? '') === 'Old Student' ? 'selected' : '' ?>>Old Student</option>
                            <option value="Transferee" <?= ($stu['Iotstudent'] ?? '') === 'Transferee' ? 'selected' : '' ?>>Transferee</option>
                        </select></td>
                        <td class="p-2 border"><select name="semester" class="w-24 border rounded p-1" required>
                            <option value="" disabled <?= empty($stu['Semester']) ? 'selected' : '' ?>>Select Semester</option>
                            <option value="1st Semester" <?= ($stu['Semester'] ?? '') === '1st Semester' ? 'selected' : '' ?>>1st Semester</option>
                            <option value="2nd Semester" <?= ($stu['Semester'] ?? '') === '2nd Semester' ? 'selected' : '' ?>>2nd Semester</option>
                        </select></td>
                        <td class="p-2 border"><select name="schoolyear" class="w-24 border rounded p-1" required>
                            <option value="" disabled <?= empty($stu['SchoolYear']) ? 'selected' : '' ?>>Select School Year</option>
                            <option value="2025-2026" <?= ($stu['SchoolYear'] ?? '') === '2025-2026' ? 'selected' : '' ?>>2025-2026</option>
                            <option value="2026-2027" <?= ($stu['SchoolYear'] ?? '') === '2026-2027' ? 'selected' : '' ?>>2026-2027</option>
                            <option value="2027-2028" <?= ($stu['SchoolYear'] ?? '') === '2027-2028' ? 'selected' : '' ?>>2027-2028</option>
                            <option value="2028-2029" <?= ($stu['SchoolYear'] ?? '') === '2028-2029' ? 'selected' : '' ?>>2028-2029</option>
                            <option value="2029-2030" <?= ($stu['SchoolYear'] ?? '') === '2029-2030' ? 'selected' : '' ?>>2029-2030</option>
                            <option value="2030-2031" <?= ($stu['SchoolYear'] ?? '') === '2030-2031' ? 'selected' : '' ?>>2030-2031</option>
                        </select></td>
                        <td class="p-2 border"><select name="summer" class="w-24 border rounded p-1" required>
                            <option value="" disabled <?= empty($stu['Summer']) ? 'selected' : '' ?>>Summer</option>
                            <option value="Yes" <?= ($stu['Summer'] ?? '') === 'Yes' ? 'selected' : '' ?>>Yes</option>
                            <option value="No" <?= ($stu['Summer'] ?? '') === 'No' ? 'selected' : '' ?>>No</option>
                        </select></td>
                        <td class="p-2 border"><select name="sex" class="w-24 border rounded p-1" required>
                            <option value="" disabled <?= empty($stu['Sex']) ? 'selected' : '' ?>>Select Sex</option>
                            <option value="Female" <?= ($stu['Sex'] ?? '') === 'Female' ? 'selected' : '' ?>>Female</option>
                            <option value="Male" <?= ($stu['Sex'] ?? '') === 'Male' ? 'selected' : '' ?>>Male</option>
                        </select></td>
                        <td class="p-2 border"><input type="text" name="lastname" id="lastName-<?= $stu['StudentId'] ?>" value="<?= htmlspecialchars($stu['Lastname']) ?>" class="w-24 border rounded p-1" required>
                        <td class="p-2 border"><input type="text" name="firstname" id="firstName-<?= $stu['StudentId'] ?>" value="<?= htmlspecialchars($stu['Firstname']) ?>" class="w-24 border rounded p-1 " required></td>
                        <td class="p-2 border"><input type="text" name="middlename" id="middleName-<?= $stu['StudentId'] ?>" value="<?= htmlspecialchars($stu['Middlename']) ?>" class="w-24 border rounded p-1" required></td>
                        <td class="p-2 border"><select name="course" class="w-24 border rounded p-1" required>
                            <option value="" disabled <?= empty($stu['Course']) ? 'selected' : '' ?>>Select Course</option>
                            <option value="BSIT" <?= ($stu['Course'] ?? '') === 'BSIT' ? 'selected' : '' ?>>BS Information Technology (BSIT)</option>
                            <option value="BSCE" <?= ($stu['Course'] ?? '') === 'BSCE' ? 'selected' : '' ?>>BS Civil Engineering (BSCE)</option>
                            <option value="BSCrim" <?= ($stu['Course'] ?? '') === 'BSCrim' ? 'selected' : '' ?>>BS Criminology (BSCrim)</option>
                            <option value="BSBA" <?= ($stu['Course'] ?? '') === 'BSBA' ? 'selected' : '' ?>>BS Business Administration (BSBA)</option>
                            <option value="BSA" <?= ($stu['Course'] ?? '') === 'BSA' ? 'selected' : '' ?>>BS Accountancy (BSA)</option>
                            <option value="BSE" <?= ($stu['Course'] ?? '') === 'BSE' ? 'selected' : '' ?>>Bachelor of Secondary Education (BSE)</option>
                            <option value="BEE" <?= ($stu['Course'] ?? '') === 'BEE' ? 'selected' : '' ?>>Bachelor of Elementary Education (BEE)</option>
                        </select></td>
                        <td class="p-2 border"><select name="yearlevel" class="w-24 border rounded p-1" required>
                            <option value="" disabled <?= empty($stu['Yearlevel']) ? 'selected' : '' ?>>Select Yearlevel</option>
                            <option value="1st Year" <?= ($stu['Yearlevel'] ?? '') === '1st Year' ? 'selected' : '' ?>>1st Year</option>
                            <option value="2nd Year" <?= ($stu['Yearlevel'] ?? '') === '2nd Year' ? 'selected' : '' ?>>2nd Year</option>
                            <option value="3rd Year" <?= ($stu['Yearlevel'] ?? '') === '3rd Year' ? 'selected' : '' ?>>3rd Year</option>
                            <option value="4th Year" <?= ($stu['Yearlevel'] ?? '') === '4th Year' ? 'selected' : '' ?>>4th Year</option>
                        </select></td>
                        <td class="p-2 border"><input type="text" name="address" value="<?= htmlspecialchars($stu['SAddress']) ?>" class="w-24 border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" name="mobile" id="mobileNumber-<?= $stu['StudentId'] ?>"  value="<?= htmlspecialchars($stu['SNumber']) ?>" class="w-24 border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" name="email" id="emailAddress-<?= $stu['StudentId'] ?>"  value="<?= htmlspecialchars($stu['SEmail']) ?>" class="w-24 border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" name="pfull" id="fullName-<?= $stu['StudentId'] ?>" value="<?= htmlspecialchars($stu['PFullname']) ?>" class="w-16 border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" name="padd" value="<?= htmlspecialchars($stu['PAddress']) ?>" class="w-20 border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" name="pnum" id="pmobileNumber-<?= $stu['StudentId'] ?>" value="<?= htmlspecialchars($stu['PNumber']) ?>" class="w-24 border rounded p-1" required></td>
                        <td class="p-2 border"><input type="email" name="pemail" id="pemailAddress-<?= $stu['StudentId'] ?>" value="<?= htmlspecialchars($stu['PEmail']) ?>" class="w-32 border rounded p-1" required></td>
                        <td class="p-2 border flex gap-1">
                        <button type="submit" onclick="return validateRow('<?= $stu['StudentId'] ?>')" class="bg-blue-500 text-white p-1 rounded">Update</button>
                    </form>
                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this subject record?');">
                                <input type="hidden" name="action" value="delete_student">
                                <input type="hidden" name="student_id" value="<?= $stu['StudentId'] ?>">
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<script src="assets/js/validation.js"></script>
</body>
<?php include ('UI/footer.php'); ?>
</html>