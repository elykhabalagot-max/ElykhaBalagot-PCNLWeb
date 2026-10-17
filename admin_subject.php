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

        if ($_POST['action'] === 'add_subject') {
            $stmt = mysqli_prepare($conn, "INSERT INTO subjects ( Course, Yearlevel, Semester, CourseCode,DescriTitle, Units, Time, Day, Room, Instructor) VALUES (?,?,?,?,?,?,?,?,?,?)");
            mysqli_stmt_bind_param($stmt, "sssssissss",$_POST['course'], $_POST['yearlevel'], $_POST['semester'], $_POST['code'], $_POST['descriptive'], $_POST['units'], $_POST['time'], $_POST['day'], $_POST['room'], $_POST['instructor']);
            
            if (mysqli_stmt_execute($stmt)) {
                $message = "Subject record added successfully!";
            } else {
            $error = "Database Error: " . mysqli_stmt_error($stmt);
            }
        } 

        elseif ($_POST['action'] === 'update_subject') {
            $stmt = mysqli_prepare($conn, "UPDATE subjects SET Course = ?, Yearlevel = ?, Semester = ?, CourseCode = ?, DescriTitle = ?, Units = ?, Time = ?, Day = ?, Room = ?, Instructor = ? WHERE Id = ?");
            
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssssissssi", $_POST['course'], $_POST['yearlevel'], $_POST['semester'], $_POST['code'], $_POST['descriptive'], $_POST['units'], $_POST['time'], $_POST['day'], $_POST['room'], $_POST['instructor'], $_POST['subject_id']);
                
                if (mysqli_stmt_execute($stmt)) {
                    if (mysqli_stmt_affected_rows($stmt) > 0) {
                        $message = "Subject updated successfully!";
                    } else {
                        $error= "Notice: 0 rows affected (data was identical or Subject ID not found).";
                    }
                } else {
                    $error = "Database Error: " . mysqli_stmt_error($stmt);
                }
            } else {
                $error = "Prepare Error: " . mysqli_error($conn);
            }
        }

        elseif ($_POST['action'] === 'delete_subject') {
            $stmt = mysqli_prepare($conn, "DELETE FROM subjects WHERE Id = ?");
            mysqli_stmt_bind_param($stmt, "i", $_POST['subject_id']);
            if (mysqli_stmt_execute($stmt)) {
                $message = "Subject record deleted successfully!";
            } else {
            $error = "Database Error: " . mysqli_stmt_error($stmt);
            }
        } 

        elseif ($_POST['action'] === 'search_subject') {
            $keyword = "%" . $_POST['search_query'] . "%";
            $stmt = mysqli_prepare($conn, "SELECT * FROM subjects WHERE Course LIKE ? OR Yearlevel LIKE ? OR CourseCode LIKE ? OR Id = ?");
            $sid = intval($_POST['search_query']);
            mysqli_stmt_bind_param($stmt, "sssi", $keyword, $keyword, $keyword, $sid);
            if (mysqli_stmt_execute($stmt)) {
                $message = "Subject record retrieved successfully!";
            } else {
            $error = "Database Error: " . mysqli_stmt_error($stmt);
            }
            $search_results = mysqli_stmt_get_result($stmt)->fetch_all(MYSQLI_ASSOC);
        }
    }
}

$subjects = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM subjects ORDER BY Id ASC"), MYSQLI_ASSOC);

include ('UI/head.php');
include ('UI/navheader.php');
include ('UI/sidenav.php');
?>
<div class="w-full px-6 md:px-10 space-y-8 pt-24 pb-24 md:ml-80 md:w-[calc(100%-20rem)]">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800">Manage Subject</h1>
    </div>

        <?php if ($message): ?>
            <div class="bg-green-900 text-white p-4 rounded shadow font-semibold"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="bg-red-900 text-white p-4 rounded shadow font-semibold"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-lg font-bold mb-3 text-gray-700">Search / Retrieve Subject Record</h1>
            <form method="POST" class="flex gap-2">
                <input type="hidden" name="action" value="search_subject">
                <input type="text" name="search_query" placeholder="Search by course, yearlevel, coursecode, or subject ID..." required class="w-full md:w-2/3 p-2 border rounded text-sm">
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
                                <th class="p-2 border">ID</th>
                                <th class="p-2 border">Course</th>
                                <th class="p-2 border">Year Level</th>
                                <th class="p-2 border">Semester</th>
                                <th class="p-2 border">Course Code</th>
                                <th class="p-2 border">Descriptive Title</th>
                                <th class="p-2 border">Units</th>
                                <th class="p-2 border">Time</th>
                                <th class="p-2 border">Day</th>
                                <th class="p-2 border">Room</th>
                                <th class="p-2 border">Instructor</th>
                            </tr>
                            <?php foreach ($search_results as $res): ?>
                            <tr>
                                <td class="p-2 border"><?= $res['Id'] ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Course']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Yearlevel']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Semester']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['CourseCode']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['DescriTitle']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Units']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Time']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Day']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Room']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Instructor']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>

                <?php else: ?>
                    <p class="text-red-900">No matching subject records found.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-bold mb-4 text-gray-700">Add New Subject Registration</h2>
        <form method="POST" id="userFormSubj" class="grid grid-cols-1 md:grid-cols-4 gap-3 text-sm">
            <input type="hidden" name="action" value="add_subject">
            <div>
                <label class="block font-semibold mb-1">Course</label>
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
                <label class="block font-semibold mb-1">Year Level</label>
                <select name="yearlevel" class="w-full px-3 py-2 border rounded-lg" required>
                    <option value="1st Year">1st Year</option>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                    <option value="4th Year">4th Year</option>
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
                <label class="block font-semibold mb-1">Course Code</label>
                <input type="text" name="code" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Descriptive Title</label>
                <input type="text" name="descriptive" id="title" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Units</label>
                <select name="units" class="w-full px-3 py-2 border rounded-lg" required>
                    <option value="2">2 </option>
                    <option value="3">3 </option>
                </select>
            </div>
            <div>
                <label class="block font-semibold mb-1">Time</label>
                <input type="text" name="time" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Day</label>
                <input type="text" name="day" id="day" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Room</label>
                <input type="text" name="room" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Instructor</label>
                <input type="text" name="instructor" id="instructor" required class="w-full p-2 border rounded">
            </div>
            <button type="submit" class="md:col-span-4 bg-blue-600 text-white font-bold p-2.5 rounded hover:bg-blue-700 mt-2">Save New Subject</button>
        </form>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-bold mb-4 text-gray-700">All Subjects (Update / Delete)</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <tr class="bg-gray-200 text-gray-700">
                    <th class="p-2 border">Id</th>
                    <th class="p-2 border">Course</th>
                    <th class="p-2 border">Year Level</th>
                    <th class="p-2 border">Semester</th>
                    <th class="p-2 border">Course Code</th>
                    <th class="p-2 border">Descriptive Title</th>
                    <th class="p-2 border">Units</th>
                    <th class="p-2 border">Time</th>
                    <th class="p-2 border">Day</th>
                    <th class="p-2 border">Room</th>
                    <th class="p-2 border">Instructor</th>
                    <th class="p-2 border">Actions</th>
                </tr>
                <?php foreach ($subjects as $sub): ?>
                <tr>
                    <form method="POST" id="form-<?= $sub['Id'] ?>">
                        <input type="hidden" name="action" value="update_subject">
                        <input type="hidden" name="subject_id" value="<?= $sub['Id'] ?>">
                        <td class="p-2 border"><?= $sub['Id'] ?></td>
                        <td class="p-2 border"><select name="course" class="w-24 border rounded p-1" required>
                            <option value="" disabled <?= empty($sub['Course']) ? 'selected' : '' ?>>Select Course</option>
                            <option value="BSIT" <?= ($sub['Course'] ?? '') === 'BSIT' ? 'selected' : '' ?>>BS Information Technology (BSIT)</option>
                            <option value="BSCE" <?= ($sub['Course'] ?? '') === 'BSCE' ? 'selected' : '' ?>>BS Civil Engineering (BSCE)</option>
                            <option value="BSCrim" <?= ($sub['Course'] ?? '') === 'BSCrim' ? 'selected' : '' ?>>BS Criminology (BSCrim)</option>
                            <option value="BSBA" <?= ($sub['Course'] ?? '') === 'BSBA' ? 'selected' : '' ?>>BS Business Administration (BSBA)</option>
                            <option value="BSA" <?= ($sub['Course'] ?? '') === 'BSA' ? 'selected' : '' ?>>BS Accountancy (BSA)</option>
                            <option value="BSE" <?= ($sub['Course'] ?? '') === 'BSE' ? 'selected' : '' ?>>Bachelor of Secondary Education (BSE)</option>
                            <option value="BEE" <?= ($sub['Course'] ?? '') === 'BEE' ? 'selected' : '' ?>>Bachelor of Elementary Education (BEE)</option>
                        </select></td>
                        <td class="p-2 border"><select name="yearlevel" class="w-24 border rounded p-1" required>
                            <option value="" disabled <?= empty($sub['Yearlevel']) ? 'selected' : '' ?>>Select Yearlevel</option>
                            <option value="1st Year" <?= ($sub['Yearlevel'] ?? '') === '1st Year' ? 'selected' : '' ?>>1st Year</option>
                            <option value="2nd Year" <?= ($sub['Yearlevel'] ?? '') === '2nd Year' ? 'selected' : '' ?>>2nd Year</option>
                            <option value="3rd Year" <?= ($sub['Yearlevel'] ?? '') === '3rd Year' ? 'selected' : '' ?>>3rd Year</option>
                            <option value="4th Year" <?= ($sub['Yearlevel'] ?? '') === '4th Year' ? 'selected' : '' ?>>4th Year</option>
                        </select></td>
                        <td class="p-2 border"><select name="semester" class="w-24 border rounded p-1" required>
                            <option value="" disabled <?= empty($sub['Semester']) ? 'selected' : '' ?>>Select Semester</option>
                            <option value="1st Semester" <?= ($sub['Semester'] ?? '') === '1st Semester' ? 'selected' : '' ?>>1st Semester</option>
                            <option value="2nd Semester" <?= ($sub['Semester'] ?? '') === '2nd Semester' ? 'selected' : '' ?>>2nd Semester</option>
                        </select></td>
                        <td class="p-2 border"><input type="text" name="code" value="<?= htmlspecialchars($sub['CourseCode']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" name="descriptive" id="Descri-<?= $sub['Id'] ?>" value="<?= htmlspecialchars($sub['DescriTitle']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><select name="units" class="w-24 border rounded p-1" required>
                            <option value="" disabled <?= empty($sub['Units']) ? 'selected' : '' ?>>Select Units</option>
                            <option value="2" <?= ($sub['Units'] ?? '') === '2' ? 'selected' : '' ?>>2</option>
                            <option value="3" <?= ($sub['Units'] ?? '') === '3' ? 'selected' : '' ?>>3</option>
                        </select></td>
                        <td class="p-2 border"><input type="text" name="units" value="<?= htmlspecialchars($sub['Units']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" name="time" value="<?= htmlspecialchars($sub['Time']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" name="day" id="Day-<?= $sub['Id'] ?>" value="<?= htmlspecialchars($sub['Day']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" name="room" value="<?= htmlspecialchars($sub['Room']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" name="instructor" id="Instruct-<?= $sub['Id'] ?>" value="<?= htmlspecialchars($sub['Instructor']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border flex gap-1">
                            <button type="submit" onclick="return validateRow('<?= $sub['Id'] ?>')" class="bg-blue-500 text-white p-1 rounded">Update</button>
                    </form>
                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this subject record?');">
                                <input type="hidden" name="action" value="delete_subject">
                                <input type="hidden" name="subject_id" value="<?= $sub['Id'] ?>">
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
<script src="assets/js/subjectvalid.js"></script>
</body>
<?php include ('UI/footer.php'); ?>
</html>