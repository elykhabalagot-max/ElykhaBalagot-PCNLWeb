<?php
$fullName = $_SESSION['fullname'] ?? 'User';
$role     = $_SESSION['role'] ?? 'user';
?>

<nav class="fixed top-0 left-0 w-full h-20 bg-blue-900 text-white px-3 sm:px-6 py-3 flex items-center justify-between shadow-lg z-30">
    <div class="flex items-center space-x-2 sm:space-x-4 min-w-0 pr-2">
        <button onclick="toggleSidebar()" type="button" class="md:hidden text-white hover:text-blue-200 p-1.5 focus:outline-none focus:ring-2 focus:ring-white rounded-lg flex-shrink-0" aria-label="Toggle navigation">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <img src="UI/pcnllogo.png" alt="PCNL Logo" class="object-contain w-8 h-8 sm:w-12 sm:h-12 flex-shrink-0">

        <div class="flex flex-col min-w-0">
            <h1 class="text-xs sm:text-base md:text-xl lg:text-2xl font-extrabold leading-tight truncate">
                PHILIPPINE COLLEGE OF NORTHWESTERN LUZON
            </h1>
            <p class="text-[10px] sm:text-xs md:text-sm font-medium text-blue-100 truncate">
                San Antonio, Agoo, La Union
            </p>
        </div>
    </div>
   <div class="flex items-center shrink-0 ml-4 text-xs sm:text-sm">
        <span class="mr-4 truncate max-w-[150px] sm:max-w-xs">Hello, <?= htmlspecialchars($fullName) ?> (<?= ucfirst($role) ?>)</span>
        <a href="logout.php" class="bg-red-500 px-3 py-1 rounded text-sm hover:bg-red-600 font-semibold transition-colors">Logout</a>
    </div>
</nav>