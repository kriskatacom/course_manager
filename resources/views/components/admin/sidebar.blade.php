<aside class="bg-white w-[350px] min-h-screen border-r border-gray-200 shadow">
    <div class="text-2xl font-extrabold text-center text-black py-5 border-b border-gray-200">Администрация</div>

    <ul class="text-lg">
        <li>
            <a href="{{ route('admin.dashboard') }}" class="block py-3 px-6 border-b border-gray-200 
                      hover:text-white hover:bg-primary 
                      {{ request()->routeIs('admin.dashboard') ? 'text-white bg-primary' : 'text-gray-700' }}">
                Табло
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users.index') }}" class="block py-3 px-6 border-b border-gray-200 
                      hover:text-white hover:bg-primary 
                      {{ request()->routeIs('admin.users.*') ? 'text-white bg-primary' : 'text-gray-700' }}">
                Потребители
            </a>
        </li>
    </ul>
</aside>