<!doctype html>
<title>Laravel From Scratch Blog</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

<body style="font-family: Open Sans, sans-serif">
    <section class="px-6 py-8">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    <img src="{{ asset ('/images/logo.svg') }} " alt="Laracasts Logo" width="165" height="16">
                </a>
            </div>

            <div class="mt-8 md:mt-0 flex items-center space-x-4">

                    @can('IsAdmin')
                            <x-dropdown-item
                                href="{{ url('api/admin/posts/') }}"
                            >
                                Dashboard
                            </x-dropdown-item>

                    @endcan

                    @guest
                        <a href="{{ url('/login') }}" class="text-xs font-bold uppercase">Login</a>
                        <a href="{{ url('/api/home') }}" class="text-xs font-bold uppercase">Home Page</a>
                    @endguest

                    @if(auth()->guard('sanctum')->check())
                        @can('IsAdmin')
                            <a href="{{ url('api/admin/admin-home') }}" class="text-xs font-bold uppercase">Home Page</a>
                        @endcan

                        @can('IsUser')
                            <a href="{{ url('api/home') }}" class="text-xs font-bold uppercase">Home Page</a>
                        @endcan

                        <p class="text-sm">Welcome, {{ auth()->user()->email }}</p>
                        <p class="text-sm">
                            <button id='logout-button'> Logout </button>
                        </p>

                    @endif
                </a>

                <a href="#" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                    Subscribe for Updates
                </a>

            </div>
        </nav>

@if(auth()->check())                {{-- without login user won't have filteration access. --}}
    <x-post-header />
@endif

    {{$slot}}

    <x-post-footer />

    </section>
</body>


    {{-- javascript code to load page as per the category selected. --}}
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
const logoutButton = document.getElementById('logout-button');

    if (logoutButton) {
        logoutButton.addEventListener('click', async () => {
            try {
                // Make a request to the logout endpoint
                await axios.post('/api/logout');
                // Remove the token from localStorage
                localStorage.removeItem('token');
                // Remove the token from headers
                axios.defaults.headers.common['Authorization'] = null;
                // Redirect to the login page or home page
                window.location.href ='/login'; // Replace with your login route
            } catch (error) {
            // Check if the error has a response
            if (error.response) {
                // The request was made, but the server responded with a non-2xx status
                console.error('Logout failed with status:', error.response.status);
                console.error('Response data:', error.response.data);
            } else if (error.request) {
                // The request was made, but no response was received
                console.error('No response received from the server');
            } else {
                // Something happened in setting up the request that triggered an error
                console.error('Error setting up the request:', error.message);
            }
        }
        });
    }
</script>

