<!-- Navbar -->
<nav class="bg-white shadow-md p-4 flex justify-between items-center">
    <div class="text-2xl font-bold">Logo <i class="fa-solid fa-store"></i></div>    
    <button id="menuButton" class="md:hidden text-gray-700 focus:outline-none">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
    </button>
    <div id="menu" class="hidden md:flex flex-col md:flex-row md:items-center md:gap-6 absolute md:static bg-white w-full md:w-auto top-16 left-0 shadow-md md:shadow-none p-4 md:p-0">
      <div class="relative">
        <button id="dropdownButton" class="flex items-center gap-1 text-gray-700 hover:text-gray-900">
          Todas as Categorias
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>
        <div id="dropdownMenu" class="hidden absolute bg-white shadow-md mt-2 rounded-md w-48">
          <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Categoria 1</a>
          <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Categoria 2</a>
          <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Categoria 3</a>
        </div>
      </div>
      <a href="#" class="text-gray-700 hover:text-gray-900">Sobre Nós</a>
      <a href="#" class="text-gray-700 hover:text-gray-900">Contato</a>
    </div>
  </nav>
