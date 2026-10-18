<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student' || !isset($_SESSION['is_paid'])) {
    header("Location: payment.php");
    exit();
}
include("UI/head.php");
include("UI/navheaderuser.php");
?>
<div class="w-full px-6 md:px-10 space-y-8 pt-24 pb-24 md:w-full">
    <div class="shadow-lg rounded-lg bg-grey-900/20 border border-blue-900 px-6 md:px-10 py-6 md:py-10">
        <h1 class="font-extrabold mt-10 text-3xl text-blue-900"style="text-align: center;">OFFICIAL ENROLLMENT RECEIPT</h1>
        <p class="text-md text-gray-900" style="text-align: center;">Philippine College of Northwestern Luzon</p>
            <div class="space-y-2 text-md text-gray-900 mb-6">
                <div class="flex justify-between"><span>Transaction ID:</span> <span class="font-bold">#<?= htmlspecialchars($_SESSION['payment_id']) ?></span></div>
                <div class="flex justify-between"><span>Student Name:</span> <span class="font-bold"><?= htmlspecialchars($_SESSION['fullname']) ?></span></div>
                <div class="flex justify-between"><span>Course:</span> <span class="font-bold"><?= htmlspecialchars($_SESSION['course']) ?></span></div>
                <div class="flex justify-between"><span>Year Level & Semester:</span> <span class="font-bold"><?= htmlspecialchars($_SESSION['yearlevel']) ?> (<?= htmlspecialchars($_SESSION['semester']) ?>)</span></div>
                <div class="flex justify-between"><span>Total Units:</span> <span class="font-bold"><?= htmlspecialchars($_SESSION['total_units']) ?></span></div>
                <div class="flex justify-between"><span>Payment Method:</span> <span class="font-bold"><?= htmlspecialchars($_SESSION['payment_method']) ?></span></div>
                <div class="flex justify-between"><span>Total Paid:</span> <span class="font-bold text-green-600">₱<?= number_format($_SESSION['total_amount'], 2) ?></span></div>
                <div class="flex justify-between"><span>Payment Status:</span> <span class="font-bold text-yellow-600"><?= htmlspecialchars($_SESSION['payment_status'] ?? 'Pending') ?></span></div>
                <div class="flex justify-between"><span>Date:</span> <span class="font-bold"><?= date('Y-m-d H:i:s') ?></span></div>
            </div>
            <div class="flex space-x-4">
                <button onclick="window.print()" class="w-1/2 bg-blue-900 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-900 transition">Print Receipt</button>
                <a href="logout.php" class="w-1/2 text-center bg-gray-900 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-900 transition">Finish / Logout</a>
            </div>
        </div>
    </div>
</body>
<?php
include("UI/footer.php");
?>
</html>