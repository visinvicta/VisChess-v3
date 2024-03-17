<div class="nav">
    <div class="flex justify-end space-x-4">
        <a class="navOptions" href="{{ url('/') }}">Home</a>
        @auth
        <a class="navOptions" href="{{ url('games') }}">Games</a>
        <a class="navOptions" href="{{ url('favorites') }}">Favorites</a>
        <a class="navOptions" href="{{ url('studies') }}">Studies</a>
        <a class="navOptions" href="{{ url('analysis') }}">Analysis</a>
        @endauth
        <a class="navOptions" href="{{ url('about') }}">About</a>
    </div>

    @auth
    <!-- Custom Dropdown -->
    <div class="dropdown-container">
        <button class="dropdownmenu navOptions" id="NavDropdown">
            <div class="dropdownusername">{{ Auth::user()->name }}</div>
            <div class="dropdownarrowdiv">
                <svg class="dropdownarrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </button>
        <div id="dropdownMenu" class="dropdownoptions hidden">
            <div>
                <a href="{{ route('dashboard') }}" class="dropdownItem">Dashboard</a>
                <a href="{{ route('profile.edit') }}" class="dropdownItem">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdownItem logoutButton">Log Out</button>
                </form>
            </div>
        </div>
    </div>
    @endauth

    @guest
    <div class="flex justify-end space-x-4">
        <a class="navOptions" href="{{ url('register') }}">Register</a>
        <a class="navOptions" href="{{ url('login') }}">Log In</a>
    </div>
    @endguest
</div>