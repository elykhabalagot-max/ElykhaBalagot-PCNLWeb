<?php
session_start();
require_once 'dbconnection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student' || !isset($_SESSION['timeenrolled'])) {
    header("Location: registrationform.php");
    exit();
}

$course = $_SESSION['course'];
$yearlevel = $_SESSION['yearlevel'];
$semester = $_SESSION['semester'];

$stmt = mysqli_prepare($conn, "SELECT * FROM subjects WHERE Course = ? AND Yearlevel = ? AND Semester = ?");
mysqli_stmt_bind_param($stmt, "sss", $course, $yearlevel, $semester);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$subjects = mysqli_fetch_all($result, MYSQLI_ASSOC);

$total_units = array_sum(array_column($subjects, 'Units'));
$_SESSION['total_units'] = $total_units;

include("UI/head.php");
include("UI/navheaderuser.php");
?>
<div class="w-full px-6 md:px-10 space-y-8 pt-24 pb-24 md:w-full">
        <div class="shadow-lg rounded-lg bg-white border border-blue-900 px-6 md:px-10 py-6 md:py-10 mx-6 md:mx-10">
            <h1 class="font-extrabold mt-10 text-3xl text-blue-900"style="text-align: center;">Subject & Schedule</h1>
            <div class="mt-10">
                <div class="mt-10 overflow-x-auto">
                <table class="w-full text-left border-collapse text-md">
                    <thead>
                        <tr class="bg-blue-900 text-white">
                            <th class="p-4 border">Course Code</th>
                            <th class="p-4 border">Descriptive Title</th>
                            <th class="p-4 border">Units</th>
                            <th class="p-4 border">Time</th>
                            <th class="p-4 border">Day</th>
                            <th class="p-4 border">Room</th>
                            <th class="p-4 border">Instructor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($subjects) > 0): ?>
                            <?php foreach ($subjects as $sub): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="p-4 border"><?= htmlspecialchars($sub['CourseCode']) ?></td>
                                <td class="p-4 border"><?= htmlspecialchars($sub['DescriTitle']) ?></td>
                                <td class="p-4 border"><?= htmlspecialchars($sub['Units']) ?></td>
                                <td class="p-4 border"><?= htmlspecialchars($sub['Time']) ?></td>
                                <td class="p-4 border"><?= htmlspecialchars($sub['Day']) ?></td>
                                <td class="p-4 border"><?= htmlspecialchars($sub['Room']) ?></td>
                                <td class="p-4 border"><?= htmlspecialchars($sub['Instructor']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="7" class="p-4 text-center text-gray-500">No subjects found for this selection. (Ask admin to add subjects for this semester!)</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                </div>
            </div>
            <div class="mt-10 font-bold text-gray-700">Total Units: <?= $total_units ?></div>
        </div>
        <div class="flex justify-end">
            <button onclick="window.print()" class="bg-gray-900 text-white font-bold py-2 px-6 rounded-lg border border-gray-900 hover:bg-white hover:text-gray-900 transition mr-3">Print Schedule</button>
            <a href="payment.php" class="bg-blue-900 text-white font-bold py-2 px-6 rounded-lg border border-blue-900 hover:bg-white hover:text-blue-900 transition">Proceed to Payment &rarr;</a>
        </div>
    </div>
</body>
<?php 
include("UI/footer.php");
?>
</html>