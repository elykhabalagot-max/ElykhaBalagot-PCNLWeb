<div id="sidebar" class="w-80 fixed top-20 left-0 h-[calc(100vh-10rem)] shadow-lg bg-blue-900 border-r border-blue-800 z-40 overflow-y-auto transition-transform duration-300 -translate-x-full md:translate-x-0">
    <div class="p-4">

        <button onclick="toggleSidebar()" type="button" class="md:hidden text-white float-right text-xl font-bold px-3 py-1 hover:bg-blue-800 rounded-lg">✕</button>

        <h1 class="text-center text-xl font-bold text-white leading-tight mt-6 mb-8">
            PCNL Enrollment<br>Management System
        </h1>

        <div class="flex flex-col gap-2">
            <a href="admin_student.php" class="text-center text-lg font-bold text-white border-b border-blue-800 px-4 py-3 hover:bg-white hover:text-blue-900 rounded-lg transition-colors" style="text-decoration: none;">Students</a>
            <a href="admin_subject.php" class="text-center text-lg font-bold text-white border-b border-blue-800 px-4 py-3 hover:bg-white hover:text-blue-900 rounded-lg transition-colors" style="text-decoration: none;">Subjects</a>
            <a href="admin_payment.php" class="text-center text-lg font-bold text-white border-b border-blue-800 px-4 py-3 hover:bg-white hover:text-blue-900 rounded-lg transition-colors" style="text-decoration: none;">Payments</a>
        </div>
    </div>
</div>