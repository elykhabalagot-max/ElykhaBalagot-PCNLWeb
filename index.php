<?php
session_start();
if (isset($_SESSION['Id'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin.php");
        exit();
    } elseif (isset($_SESSION['timeenrolled'])) {
        header("Location: subject.php");
        exit();
    } else {
        header("Location: registrationform.php");
        exit();
    }
}
include ("UI/head.php");
include ("UI/navheadout.php");
?>
    <div class="w-full py-24 px-4 text-center min-h-[80vh] flex flex-col items-center justify-center">
       <div class="ax-w-4xl mx-auto w-full">
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight text-blue-900 leading-[1.1] mb-6">PHILIPPINE COLLEGE OF <br> NORTHWESTERN LUZON</h1>
        <p class="text-black-900 text-base sm:text-lg max-w-xl mx-auto leading-relaxed mb-10">INVEST RIGHT TO MAKE YOUR FUTURE BRIGHT.</p>
            <a href="login.php"><button class="border border-blue-900 bg-blue-900 hover:bg-white hover:text-blue-900 text-white font-medium px-5 py-2.5 rounded-lg font-semibold transition-colors">Enroll Now</button></a>
        </div>
    </div>
</body>
<?php
include ("UI/footer.php");
?>
</html>