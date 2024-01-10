<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">Login!</h1>

            <form class="mt-10" id='login-form'>
                @csrf       {{--cross-site request forgery --}}

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="email"
                    >
                        Email
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="email"
                           name="email"
                           id="email"
                           required
                           value="{{ old('email') }}"
                    >
                    @error('email')
                        <p> {{$message}} </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="password"
                    >
                        Password
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="password"
                           name="password"
                           id="password"
                           required
                    >
                    @error('password')
                        <p> {{$message}} </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <button type="submit" id='login-button'
                            class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
                    >
                        Submit
                    </button>
                </div>

                <div class="mb-6 text-center">
                    <p class="text-gray-600">Not Ate Almonds Everyday! No Worries... <a href="/forgot-password" class="text-blue-500">Forget Password</a></p>
                </div>

                <div class="mb-6 text-center">
                    <p class="text-gray-600">New User? <a href="/" class="text-blue-500">Register Here</a></p>
                </div>
            </form>
        </main>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loginForm = document.getElementById('login-form');
            const loginButton = document.getElementById('login-button');

            if (loginForm && loginButton) {
                loginButton.addEventListener('click', async () => {
                    try {
                        const formData = new FormData(loginForm);
                        const response = await axios.post('/api/login', formData);

                        const token = response.data.token;
                        localStorage.setItem('token', token);
                        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

                         // Fetch user roles from the response or another source
                        const userRole = response.data.role;

                        if (userRole.includes('admin')) {
                            window.location.href = '/api/admin/admin-home';
                        } else if (userRole.includes('user')) {
                            window.location.href = '/api/home';
                        } else {
                            // Handle other roles or scenarios as needed
                            alert('Invalid user role.');
                        }

                    } catch (error) {
                        console.error('Login failed: Invalid Password');
                        const errorMessage = error.response ? error.response.data.message : 'An error occurred during login.';
                    }
                });
            }
        });
    </script>
</x-layout>
