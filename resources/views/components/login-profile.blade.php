<style>
    [x-cloak] {
        display: none !important;
    }
</style>
<div x-data="{ open: false }" 
 
class="relative ml-auto">

    <!-- FOTO (TRIGGER) -->
    <button @click.stop="open = !open" 
        class="inline-flex items-center justify-center
        rounded-full
        focus:outline-none
        focus:ring-2 focus:ring-white/80
        transition duration-300 hover:scale-105">

        <div class="w-9 h-9 rounded-full overflow-hidden shadow-md">
            <img src="img/darul musthofa.jpg" alt="Profile" class="w-full h-full object-cover">
        </div>
    </button>

    <!-- DROPDOWN -->
    <div x-show="open" x-cloak @click.outside="open = false" x-transition
        class="absolute right-0 mt-3 w-40 bg-white rounded-lg shadow-lg py-2 z-50">

        <!-- Profil -->
        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-teal-500 hover:text-white transition">
            Profil sekolah
        </a>

        <!-- Program -->
        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-teal-500 hover:text-white transition">
            Program sekolah
        </a>

        <!-- Login -->
        <a href="/login" class="block px-4 py-2 text-sm text-gray-700 hover:bg-teal-500 hover:text-white transition">
            Login
        </a>

    </div>
</div>
