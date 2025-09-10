<aside class="bg-white w-[350px] min-h-screen border-r border-gray-200 shadow">
    <div class="text-2xl font-extrabold text-center text-black py-5 border-b border-gray-200">{{ __('messages.administration') }}</div>

    <ul class="text-lg">
        <x-admin.sidebar-item route="admin.dashboard" icon="fa-solid fa-gauge" text="messages.dashboard" active="admin.dashboard" />
        <x-admin.sidebar-item route="admin.users.index" icon="fa-solid fa-users" text="messages.users" active="admin.users.*" />
        <x-admin.sidebar-item route="admin.categories.index" icon="fa-solid fa-layer-group" text="messages.categories" active="admin.categories.*" />
        <x-admin.sidebar-item route="admin.courses.index" icon="fa-solid fa-graduation-cap" text="messages.courses" active="admin.courses.*" />
    </ul>
</aside>