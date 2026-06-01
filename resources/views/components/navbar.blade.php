<!-- Navbar / Header -->
<div class="fixed top-0 left-0 z-50 w-full h-14 sm:h-16 bg-teal-500/40 border-b border-teal-600/40 backdrop-blur-md">

    <!-- Container -->
    <div class="relative flex items-center h-full px-4">

        <!-- Menu Kiri -->
        <div class="absolute left-1/2 -translate-x-1/2
            h-full flex items-center gap-2 sm:gap-4">

            <!-- Home -->
            <a href="{{ route('home') }}"
                class="flex flex-col items-center justify-center px-2 sm:px-4 h-full transition-colors text-white hover:border-b-2 hover:border-white
                {{ request()->routeIs('home') ? 'border-b-2 border-white' : '' }}">

                <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>

                <span class="text-2xs sm:text-xs">Home</span>
            </a>

            <!-- Daftar -->
            <a href="{{ route('students.create') }}"
                class="flex flex-col items-center justify-center px-2 sm:px-4 h-full transition-colors text-white hover:border-b-2 hover:border-white
                {{ request()->routeIs('daftar') ? 'border-b-2 border-white' : '' }}">

                <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                    </path>
                </svg>

                <span class="text-2xs sm:text-xs">Daftar</span>
            </a>

            <!-- Berita -->
            <a href="{{ route('berita') }}"
                class="flex flex-col items-center justify-center px-2 sm:px-4 h-full transition-colors text-white hover:border-b-2 hover:border-white
                {{ request()->routeIs('berita') ? 'border-b-2 border-white' : '' }}">

                <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                    </path>
                </svg>

                <span class="text-2xs sm:text-xs">Berita</span>
            </a>

            <!-- contact saya -->
            <!-- Contact Dropdown -->
            <x-contact-dropdown></x-contact-dropdown>

        </div>

        <!-- Login/Profile Kanan -->
        <x-login-profile></x-login-profile>

    </div>
</div>
