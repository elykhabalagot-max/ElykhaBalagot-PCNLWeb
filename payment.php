<?php
session_start();
require_once 'dbconnection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student' || !isset($_SESSION['timeenrolled'])) {
    header("Location: registrationform.php");
    exit();
}

$student_id = $_SESSION['student_id'];
$fullname = $_SESSION['fullname'];
$course = $_SESSION['course'];
$yearlevel = $_SESSION['yearlevel'];
$semester = $_SESSION['semester'];
$total_units = $_SESSION['total_units'] ?? 0;

$rate_per_unit = 450;
$tuition_fee = $total_units * $rate_per_unit;
$registration_fee = 450.00;
$library_fee = 400.00;
$medical_fee = 200.00;
$guidance_fee = 150.00;
$lab_fee = 750.00;
$internet_fee = 830.00;
$org_fee = 150.00;
$pub_fee = 120.00;
$id_fee = 130.00;
$athletic_fee = 170.00;
$act_fee = 850.00;
$insurance_fee = 110.00;
$cultural_fee = 120.00;
$prisaa_fee = 200.00;
$security_fee = 120.00;
$energy_fee = 850.00;
$handbook_fee = 200.00;
$crim_fee = 500.00;

$misc_fees_total = $registration_fee + $library_fee + $medical_fee + $guidance_fee + $lab_fee + $internet_fee + $org_fee + $pub_fee + $id_fee + $athletic_fee + $act_fee + $insurance_fee + $cultural_fee + $prisaa_fee + $security_fee + $energy_fee + $handbook_fee + $crim_fee;
$total_fees = $tuition_fee + $misc_fees_total;

$_SESSION['total_amount'] = $total_fees;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_method = $_POST['payment_method']; 

    $query = "INSERT INTO payments (StudentId, Totalunits, Tuitionfee, Registrationfee, Libraryfee, MedicalDentalfee, Guidancefee, Labfee, Internetfee, Studentorgfee, Schoolpubfee, SchoolIdfee, Athleticfee, Studentactfee, Insurancefee, Culturalfee, PRISAA, Securityfee, Energyfee, Handbookfee, Crimlabfee, Totalamount, Paymentmethod, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Paid')";
    
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt === false) {
        die("Prepare failed: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "iidddddddddddddddddddds", 
        $student_id, $total_units, 
        $tuition_fee, $registration_fee, $library_fee, $medical_fee, 
        $guidance_fee, $lab_fee, $internet_fee, $org_fee, 
        $pub_fee, $id_fee, $athletic_fee, $act_fee, 
        $insurance_fee, $cultural_fee, $prisaa_fee, $security_fee, 
        $energy_fee, $handbook_fee, $crim_fee, $total_fees, $payment_method
    );

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['payment_id'] = mysqli_insert_id($conn);
        $_SESSION['payment_method'] = $payment_method;
        $_SESSION['is_paid'] = false;

        header("Location: receipt.php");
        exit();
    } else {
        $error = "Transaction failed: " . mysqli_stmt_error($stmt);
    }
}

include ("UI/head.php");
include ("UI/navheaderuser.php");
?>
<div class="w-full px-6 md:px-10 space-y-8 pt-24 pb-24 md:w-full">
    <div class="shadow-lg rounded-lg bg-grey-900/20 border border-blue-900 px-6 md:px-10 py-6 md:py-10">
        <h1 class="font-extrabold mt-10 text-3xl text-blue-900"style="text-align: center;">Fee Assessment</h1>
        <br>
        <?php if ($error): ?>
            <div class="bg-red-900 text-white p-3 rounded mb-4 text-md"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="space-y-1 text-gray-800 text-md mb-6 font-medium">
            <p><span class="font-bold">Student Name:</span> <?= htmlspecialchars($fullname) ?></p>
            <p><span class="font-bold">Student ID:</span> 2026<?= str_pad($student_id, 4, '0', STR_PAD_LEFT) ?></p>
            <p><span class="font-bold">Program:</span> <?= htmlspecialchars($course) ?></p>
            <p><span class="font-bold">Year & Semester:</span> <?= htmlspecialchars($yearlevel) ?> (<?= htmlspecialchars($semester) ?>)</p>
            <p><span class="font-bold">Total Units:</span> <?= $total_units ?></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-blue-900 text-white p-5 rounded-2xl shadow">
                <p class="text-xs uppercase tracking-wider text-blue-200 font-semibold">Tuition Fee:</p>
                <p class="text-2xl font-extrabold mt-1">₱<?= number_format($tuition_fee, 2) ?></p>
            </div>
            <div class="bg-blue-900 text-white p-5 rounded-2xl shadow">
                <p class="text-xs uppercase tracking-wider text-blue-200 font-semibold">Miscellaneous Fees:</p>
                <p class="text-2xl font-extrabold mt-1">₱<?= number_format($misc_fees_total, 2) ?></p>
            </div>
            <div class="bg-blue-900 text-white p-5 rounded-2xl shadow">
                <p class="text-xs uppercase tracking-wider text-blue-200 font-semibold">Total Fees:</p>
                <p class="text-2xl font-extrabold mt-1">₱<?= number_format($total_fees, 2) ?></p>
            </div>
        </div>

        <h3 class="text-lg font-bold text-blue-900 mb-3">Fee Breakdown</h3>
        <div class="border rounded-xl overflow-hidden mb-8 shadow-sm">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-blue-900 text-white text-md">
                        <th class="p-3 border-b border-blue-800">Fee Description</th>
                        <th class="p-3 border-b border-blue-800 text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="text-md text-gray-700 divide-y divide-gray-200">
                    <tr>
                        <td class="p-3">Tuition Fee (<?= $rate_per_unit ?> per unit &times; <?= $total_units ?> units)</td>
                        <td class="p-3 text-right font-medium">₱<?= number_format($tuition_fee, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="p-3">Registration Fee</td>
                        <td class="p-3 text-right font-medium">₱<?= number_format($registration_fee, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="p-3">Library Fee</td>
                        <td class="p-3 text-right font-medium">₱<?= number_format($library_fee, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="p-3">Medical/Dental Fee</td>
                        <td class="p-3 text-right font-medium">₱<?= number_format($medical_fee , 2) ?></td>
                    </tr>
                    <tr>
                        <td class="p-3">Guidance Fee</td>
                        <td class="p-3 text-right font-medium">₱<?= number_format($guidance_fee, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="p-3">Laboratory Fee</td>
                        <td class="p-3 text-right font-medium">₱<?= number_format($lab_fee, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="p-3">Internet Fee</td>
                        <td class="p-3 text-right font-medium">₱<?= number_format($internet_fee, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="p-3">Student Body Org Fee</td>
                        <td class="p-3 text-right font-medium">₱<?= number_format($org_fee, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="p-3">School Publication Fee</td>
                        <td class="p-3 text-right font-medium">₱<?= number_format($pub_fee, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="p-3">School ID Fee</td>
                        <td class="p-3 text-right font-medium">₱<?= number_format($id_fee, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="p-3">Athletic Fee</td>
                        <td class="p-3 text-right font-medium">₱<?= number_format($athletic_fee, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="p-3">Student Activities Fee</td>
                        <td class="p-3 text-right font-medium">₱<?= number_format($act_fee, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="p-3">Insurance Fee</td>
                        <td class="p-3 text-right font-medium">₱<?= number_format($insurance_fee, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="p-3">Cultural Fee</td>
                        <td class="p-3 text-right font-medium">₱<?= number_format($cultural_fee, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="p-3">PRISAA</td>
                        <td class="p-3 text-right font-medium">₱<?= number_format($prisaa_fee, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="p-3">Security Fee</td>
                        <td class="p-3 text-right font-medium">₱<?= number_format($security_fee, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="p-3">Energy Fee</td>
                        <td class="p-3 text-right font-medium">₱<?= number_format($energy_fee, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="p-3">Handbook Fee</td>
                        <td class="p-3 text-right font-medium">₱<?= number_format($handbook_fee, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="p-3">Crim Lab Fee</td>
                        <td class="p-3 text-right font-medium">₱<?= number_format($crim_fee, 2) ?></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-blue-900 text-white font-bold">
                        <td class="p-3">Total Amount</td>
                        <td class="p-3 text-right text-lg">₱<?= number_format($total_fees, 2) ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <form action="payment.php" method="POST" class="space-y-6">
            <div>
                <label class="block text-gray-700 text-md font-bold mb-2">Select Payment Method</label>
                <select name="payment_method" required class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-900 bg-white shadow-sm">
                    <option value="">Choose Payment Option</option>
                    <option value="Cash / Over-the-Counter">Cash / Over-the-Counter</option>
                    <option value="Credit / Debit Card">Credit / Debit Card</option>
                    <option value="GCash / Online Wallet">GCash / Online Wallet</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                </select>
            </div>
            <div class="flex items-center justify-between pt-4 border-t">
                <a href="subject.php" class="bg-gray-500 text-white font-bold py-3 px-6 rounded-xl hover:bg-gray-600 transition">&larr; Back to Schedule</a>
                <button type="submit" class="bg-green-600 text-white font-bold py-3 px-8 rounded-xl hover:bg-green-700 transition">Confirm Payment & Generate Receipt</button>
            </div>
        </form>
    </div>
</div>
</body>
<?php
include ("UI/footer.php");
?>
</html>