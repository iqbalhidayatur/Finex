<div class="profile d-flex justify-content-center align-items-center gap-2">
    <div class="profile-picture d-flex justify-content-center align-items-center">
        <i class="bi bi-person"></i>
    </div>
    <div class="name d-flex justify-content-center align-items-start flex-column">
        <h3>Serenity dev.</h3>
        <p>Serenity@gmail.com</p>
    </div>
</div>

<div class="nav-links w-100 mt-4 gap-4">

    <div class="menu d-flex flex-column">
        <p>Menu</p>

        <a href="{{ route('dashboard') }}"
            class="{{ request()->is('dashboard') ? 'active' : '' }}">
            Dashboard
        </a>

        <a href="{{ url('/report') }}"
            class="{{ request()->is('report') ? 'active' : '' }}">
            Report
        </a>

        <a href="{{ url('/management') }}"
            class="{{ request()->is('management') ? 'active' : '' }}">
            Management
        </a>

        <a href="{{ url('/analytics') }}"
            class="{{ request()->is('analytics') ? 'active' : '' }}">
            Analytics
        </a>
    </div>

    <div class="menu d-flex flex-column">
        <p>General</p>
        <a href="">Setting</a>
        <a href="">Help</a>
        <a href="" class="logout">Logout</a>
    </div>
</div>