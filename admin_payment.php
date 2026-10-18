<?php
session_start();
require_once 'dbconnection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$message = '';
$error= '';
$search_results = null;
$studentQuery = mysqli_query($conn, "SELECT StudentId, Firstname, Lastname FROM students");

if (!$studentQuery) {
    die("Error fetching students: " . mysqli_error($conn));
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {

        if ($_POST['action'] === 'add_payment') {
            $stmt = mysqli_prepare($conn, "INSERT INTO payments ( StudentId, Totalunits, Tuitionfee, Registrationfee,Libraryfee,MedicalDentalfee,Guidancefee, Labfee, Internetfee, Studentorgfee, Schoolpubfee,SchoolIdfee,Athleticfee,Studentactfee,Insurancefee,Culturalfee,PRISAA,Securityfee, Energyfee, Handbookfee, Crimlabfee, Totalamount, Paymentmethod, Status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            mysqli_stmt_bind_param($stmt, "iiddddddddddddddddddddss",$_POST['student_id'],$_POST['units'], $_POST['tuition'], $_POST['register'], $_POST['lib'], $_POST['med'], $_POST['guide'], $_POST['lab'], $_POST['net'], $_POST['org'], $_POST['pub'], $_POST['id'], $_POST['ath'], $_POST['act'], $_POST['ins'], $_POST['cul'], $_POST['pri'], $_POST['sec'], $_POST['energy'], $_POST['hand'], $_POST['crim'], $_POST['total'], $_POST['paym'], $_POST['status']);
           
            if (mysqli_stmt_execute($stmt)) {
            $message = "Payment record added successfully!";
            } else {
            $error = "Database Error: " . mysqli_stmt_error($stmt);
            }
        } 

        elseif ($_POST['action'] === 'update_payment') {
            $stmt = mysqli_prepare($conn, "UPDATE payments SET StudentId = ?,Totalunits = ?, Tuitionfee = ?, Registrationfee = ?, Libraryfee = ?, MedicalDentalfee = ?, Guidancefee = ?, Labfee = ?, Internetfee = ?, Studentorgfee = ?, Schoolpubfee = ?, SchoolIdfee = ?, Athleticfee = ?, Studentactfee = ?, Insurancefee = ?, Culturalfee = ?, PRISAA = ?, Securityfee = ?, Energyfee = ?, Handbookfee = ?, Crimlabfee = ?, Totalamount = ?, Paymentmethod = ?, Status = ? WHERE Id = ?");

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "iiddddddddddddddddddddssi", $_POST['student_id'],$_POST['units'], $_POST['tuition'], $_POST['register'], $_POST['lib'], $_POST['med'], $_POST['guide'], $_POST['lab'], $_POST['net'], $_POST['org'], $_POST['pub'], $_POST['id'], $_POST['ath'], $_POST['act'], $_POST['ins'], $_POST['cul'], $_POST['pri'], $_POST['sec'], $_POST['energy'], $_POST['hand'], $_POST['crim'], $_POST['total'], $_POST['paym'], $_POST['status'], $_POST['payment_id']);
                    
                    if (mysqli_stmt_execute($stmt)) {
                        if (mysqli_stmt_affected_rows($stmt) > 0) {
                            $message = "Payment record updated successfully!";
                        } else {
                            $error = "Notice: 0 rows affected (data was identical or Payment ID not found).";
                        }
                    } else {
                        $error = "Database Error: " . mysqli_stmt_error($stmt);
                    }
                } else {
                    $error = "Prepare Error: " . mysqli_error($conn);
                }
        }

        elseif ($_POST['action'] === 'delete_payment') {
            $stmt = mysqli_prepare($conn, "DELETE FROM payments WHERE Id = ?");
            mysqli_stmt_bind_param($stmt, "i", $_POST['payment_id']);
            if (mysqli_stmt_execute($stmt)) {
                $message = "Payment record deleted successfully!";
            } else {
            $error = "Database Error: " . mysqli_stmt_error($stmt);
            }
        } 
        
        elseif ($_POST['action'] === 'search_payment') {
            $keyword = "%" . $_POST['search_query'] . "%";
            $stmt = mysqli_prepare($conn, "SELECT * FROM payments WHERE Paymentmethod LIKE ? OR Id = ?");
            $sid = intval($_POST['search_query']);
            mysqli_stmt_bind_param($stmt, "si", $keyword, $sid);
            if (mysqli_stmt_execute($stmt)) {
                $message = "Payment record retrieved successfully!";
            } else {
            $error = "Database Error: " . mysqli_stmt_error($stmt);
            }
            $search_results = mysqli_stmt_get_result($stmt)->fetch_all(MYSQLI_ASSOC);
        }
    }
}

$payments = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM payments ORDER BY Id ASC"), MYSQLI_ASSOC);

include ('UI/head.php');
include ('UI/navheader.php');
include ('UI/sidenav.php');
?>

<div class="w-full px-6 md:px-10 space-y-8 pt-24 pb-24 md:ml-80 md:w-[calc(100%-20rem)]">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800">Manage Payment</h1>
    </div>

    <?php if ($message): ?>
        <div class="bg-green-900 text-white p-4 rounded shadow font-semibold"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="bg-red-900 text-white p-4 rounded shadow font-semibold"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-lg font-bold mb-3 text-gray-700">Search / Retrieve Payment Record</h1>
            <form method="POST" class="flex gap-2">
                <input type="hidden" name="action" value="search_payment">
                <input type="text" name="search_query" placeholder="Search by payment method and payment ID..." required class="w-full md:w-2/3 p-2 border rounded text-sm">
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
                                <th class="p-2 border">StudentID</th>
                                <th class="p-2 border">Total Units</th>
                                <th class="p-2 border">Tuition Fee</th>
                                <th class="p-2 border">Registration Fee</th>
                                <th class="p-2 border">Library Fee</th>
                                <th class="p-2 border">Medical Dental Fee</th>
                                <th class="p-2 border">Guidance Fee</th>
                                <th class="p-2 border">Lab Fee</th>
                                <th class="p-2 border">Internet Fee</th>
                                <th class="p-2 border">Student Org Fee</th>
                                <th class="p-2 border">Student Publication Fee</th>
                                <th class="p-2 border">School ID Fee</th>
                                <th class="p-2 border">Athletic Fee</th>
                                <th class="p-2 border">Student Activity Fee</th>
                                <th class="p-2 border">Insurance Fee</th>
                                <th class="p-2 border">Cultural Fee</th>
                                <th class="p-2 border">PRISAA</th>
                                <th class="p-2 border">Security Fee</th>
                                <th class="p-2 border">Energy Fee</th>
                                <th class="p-2 border">Handbook Fee</th>
                                <th class="p-2 border">Crim Lab Fee</th>
                                <th class="p-2 border">Total Amount</th>
                                <th class="p-2 border">Payment Method</th>
                                <th class="p-2 border">Status</th>
                            </tr>
                            <?php foreach ($search_results as $res): ?>
                            <tr>
                                <td class="p-2 border"><?= $res['Id'] ?></td>
                                <td class="p-2 border"><?= $res['StudentId'] ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Totalunits']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Tuitionfee']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Registrationfee']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Libraryfee']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['MedicalDentalfee']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Guidancefee']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Labfee']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Internetfee']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Studentorgfee']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Schoolpubfee']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['SchoolIdfee']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Athleticfee']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Studentactfee']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Insurancefee']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Culturalfee']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['PRISAA']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Securityfee']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Energyfee']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Handbookfee']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Crimlabfee']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Totalamount']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Paymentmethod']) ?></td>
                                <td class="p-2 border"><?= htmlspecialchars($res['Status']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                
                <?php else: ?>
                    <p class="text-red-600">No matching payment records found.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-bold mb-4 text-gray-700">Add New Payment Registration</h2>
        <form method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-3 text-sm" onsubmit="return validateStudent(this)";>
            <input type="hidden" name="action" value="add_payment">
            <div class="mb-3">
                <label class="block text-sm font-bold mb-1">Select Student:</label>
                <select name="student_id" id="student_id" class="w-full border rounded p-2" required>
                    <option value="">-- Choose a Student --</option>
                    <?php while ($s = mysqli_fetch_assoc($studentQuery)): ?>
                        <option value="<?= $s['StudentId'] ?>">
                            ID: <?= $s['StudentId'] ?> - <?= htmlspecialchars($s['Firstname'] . ' ' . $s['Lastname']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div>
                <label class="block font-semibold mb-1">Total Units</label>
                <input type="number" name="units" step="1" min="0" id="units" class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Tuition Fee</label>
                <input type="number" name="tuition" step="0.01" id="tuition" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Registration Fee</label>
                <input type="number" name="register" step="0.01" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Library Fee</label>
                <input type="number" name="lib" step="0.01" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Medical Dental Fee</label>
                <input type="number" name="med" step="0.01" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Guidance Fee</label>
                <input type="number" name="guide" step="0.01" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Lab Fee</label>
                <input type="number" name="lab" step="0.01" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Internet Fee</label>
                <input type="number" name="net" step="0.01" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Student Org Fee</label>
                <input type="number" name="org" step="0.01" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">School Publication Fee</label>
                <input type="number" name="pub" step="0.01" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">School ID Fee</label>
                <input type="number" name="id" step="0.01" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Athletic Fee</label>
                <input type="number" name="ath" step="0.01" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Student Activity Fee</label>
                <input type="number" name="act" step="0.01" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Insurance Fee</label>
                <input type="number" name="ins" step="0.01" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Cultural Fee</label>
                <input type="number" name="cul" step="0.01" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">PRISAA</label>
                <input type="number" name="pri" step="0.01" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Security Fee</label>
                <input type="number" name="sec" step="0.01" required class="w-full p-2 border rounded">
            </div>
                        <div>
                <label class="block font-semibold mb-1">Energy Fee</label>
                <input type="number" name="energy" step="0.01" required class="w-full p-2 border rounded">
            </div>
                        <div>
                <label class="block font-semibold mb-1">Handbook Fee</label>
                <input type="number" name="hand" step="0.01" required class="w-full p-2 border rounded">
            </div>
                        <div>
                <label class="block font-semibold mb-1">Crim Lab Fee</label>
                <input type="number" name="crim" step="0.01" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Total Amount</label>
                <input type="number" name="total" step="0.01" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Payment Method</label>
                <select name="paym" required class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-900 bg-white shadow-sm">
                    <option value="" disabled>Choose Payment Option</option>
                    <option value="Cash / Over-the-Counter">Cash / Over-the-Counter</option>
                    <option value="Credit / Debit Card">Credit / Debit Card</option>
                    <option value="GCash / Online Wallet">GCash / Online Wallet</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                </select>
            </div>
            <div>
                <label class="block font-semibold mb-1">Status</label>
                <select name="status" required class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-900 bg-white shadow-sm">
                    <option value="" disabled>Choose Status</option>
                    <option value="Paid">Paid</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>
            <button type="submit" class="md:col-span-4 bg-blue-600 text-white font-bold p-2.5 rounded hover:bg-blue-700 mt-2">Save New Payment</button>
        </form>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-bold mb-4 text-gray-700">All Payment (Update / Delete)</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <tr class="bg-gray-200 text-gray-700">
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Student ID</th>
                    <th class="p-2 border">Total Units</th>
                    <th class="p-2 border">Tuition Fee</th>
                    <th class="p-2 border">Registration Fee</th>
                    <th class="p-2 border">Library Fee</th>
                    <th class="p-2 border">Medical Dental Fee</th>
                    <th class="p-2 border">Guidance Fee</th>
                    <th class="p-2 border">Lab Fee</th>
                    <th class="p-2 border">Internet Fee</th>
                    <th class="p-2 border">Student Org Fee</th>
                    <th class="p-2 border">Student Publication Fee</th>
                    <th class="p-2 border">School ID Fee</th>
                    <th class="p-2 border">Athletic Fee</th>
                    <th class="p-2 border">Student Activity Fee</th>
                    <th class="p-2 border">Insurance Fee</th>
                    <th class="p-2 border">Cultural Fee</th>
                    <th class="p-2 border">PRISAA</th>
                    <th class="p-2 border">Security Fee</th>
                    <th class="p-2 border">Energy Fee</th>
                    <th class="p-2 border">Handbook Fee</th>
                    <th class="p-2 border">Crim Lab Fee</th>
                    <th class="p-2 border">Total Amount</th>
                    <th class="p-2 border">Payment Method</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Action</th>
                </tr>
                <?php foreach ($payments as $pay): ?>
                <tr>
                    <form method="POST">
                        <input type="hidden" name="action" value="update_payment">
                        <input type="hidden" name="payment_id" value="<?= $pay['Id'] ?>">
                        <input type="hidden" name="student_id" value="<?= $pay['StudentId'] ?>">
                        <td class="p-2 border"><?= $pay['Id'] ?></td>
                        <td class="p-2 border"><?= $pay['StudentId'] ?></td>
                        <td class="p-2 border"><input type="text" step="1" min="0" name="units" id="units-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['Totalunits']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" step="0.01" name="tuition" id="tuition-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['Tuitionfee']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" step="0.01" name="register" id="reg-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['Registrationfee']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" step="0.01" name="lib" id="lib-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['Libraryfee']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" step="0.01" name="med" id="med-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['MedicalDentalfee']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" step="0.01" name="guide" id="guide-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['Guidancefee']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" step="0.01" name="lab" id="lab-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['Labfee']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" step="0.01" name="net" id="net-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['Internetfee']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" step="0.01" name="org" id="org-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['Studentorgfee']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" step="0.01" name="pub" id="pub-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['Schoolpubfee']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" step="0.01" name="id" id="id-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['SchoolIdfee']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" step="0.01" name="ath" id="ath-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['Athleticfee']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" step="0.01" name="act" id="act-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['Studentactfee']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" step="0.01"name="ins" id="ins-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['Insurancefee']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" step="0.01"name="cul" id="cul-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['Culturalfee']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" step="0.01" name="pri" id="pri-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['PRISAA']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" step="0.01" name="sec" id="sec-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['Securityfee']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" step="0.01" name="energy" id="energy-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['Energyfee']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" step="0.01" name="hand" id="hand-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['Handbookfee']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" step="0.01" name="crim" id="crim-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['Crimlabfee']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><input type="text" step="0.01" name="total" id="total-<?= $pay['Id'] ?>" value="<?= htmlspecialchars($pay['Totalamount']) ?>" class="w-full border rounded p-1" required></td>
                        <td class="p-2 border"><select name="paym" class="w-24 border rounded p-1" required>
                            <option value="" disabled <?= empty($pay['Paymentmethod']) ? 'selected' : '' ?>>Select Payment Option</option>
                            <option value="Cash / Over-the-Counter" <?= ($pay['Paymentmethod'] ?? '') === 'Cash / Over-the-Counter' ? 'selected' : '' ?>>Cash / Over-the-Counter</option>
                            <option value="Credit / Debit Card" <?= ($pay['Paymentmethod'] ?? '') === 'Credit / Debit Card' ? 'selected' : '' ?>>Credit / Debit Card</option>
                            <option value="GCash / Online Wallet" <?= ($pay['Paymentmethod'] ?? '') === 'GCash / Online Wallet' ? 'selected' : '' ?>>GCash / Online Wallet</option>
                            <option value="Bank Transfer" <?= ($pay['Paymentmethod'] ?? '') === 'Bank Transfer' ? 'selected' : '' ?>>Bank Transfer</option>
                        </select></td>
                        <td class="p-2 border"><select name="status" class="w-24 border rounded p-1" required>
                            <option value="" disabled <?= empty($pay['Status']) ? 'selected' : '' ?>>Select Status</option>
                            <option value="Paid" <?= ($pay['Status'] ?? '') === 'Paid' ? 'selected' : '' ?>>Paid</option>
                            <option value="Pending" <?= ($pay['Status'] ?? '') === 'Pending' ? 'selected' : '' ?>>Pending</option>
                        </select></td>
                        <td class="p-2 border flex gap-1">
                            <button type="submit" onclick="return validateRow('<?= $pay['Id'] ?>')" class="bg-blue-600 text-white px-2 py-1 rounded hover:bg-green-700">Update</button>
                    </form>
                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this payment record?');">
                                <input type="hidden" name="action" value="delete_payment">
                                <input type="hidden" name="payment_id" value="<?= $pay['Id'] ?>">
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
<script src="assets/js/paymentvalid.js"></script>
</body>
<?php include ('UI/footer.php'); ?>
</html>