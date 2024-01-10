<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">Forget Password</h1>

            <form method=POST action="/api/forgot-password" class="mt-10" id ='forgot-password-form'>
                @csrf {{-- Cross-site request forgery --}}

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="email">Email</label>
                    <input class="border border-gray-400 p-2 w-full" type="email" name="email" id="email" required value="{{ old('email') }}">
                    @error('email')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6" id="forgot-password-button">
                    <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">Submit</button>
                </div>

                <div id="success-message" class="text-green-600 mb-6 hidden">
                    <!-- Success message will be displayed here -->
                </div>

                <div id="error-message" class="text-red-600 mb-6 hidden">
                    <!-- Success message will be displayed here -->
                </div>

                <div class="mb-6 text-center">
                    <p class="text-gray-600">Remember your password? <a href="/login" class="text-blue-500">Login here</a></p>
                </div>

            </form>
        </main>
    </section>

    {{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const forgotPasswordForm = document.getElementById('forgot-password-form');

            if (forgotPasswordForm) {
                const forgotPasswordButton = document.getElementById('forgot-password-button');
                forgotPasswordButton.addEventListener('click', async (event) => {
                    event.preventDefault(); // Prevent the default form submission behavior

                     // Clear previous messages
                    const successMessageElement = document.getElementById('success-message');
                    const errorMessageElement = document.getElementById('error-message');
                    successMessageElement.classList.add('hidden');
                    errorMessageElement.classList.add('hidden');

                    try {
                        const response = await axios.post('/api/forgot-password', {
                            email: forgotPasswordForm.elements.email.value,
                        });
                        console.log(response.data.message);
                       if(response.data.message === "success"){
                            const successMessageElement =   document.getElementById('success-message');
                            successMessageElement.innerHTML = 'Mail Sent Successfully! Link Will Be Expired In 10 Minutes';
                            successMessageElement.classList.remove('hidden');
                        }
                        // // Assuming the response contains a 'token' field
                        // const token = response.data.token;
                        // console.log(token);
                        // // Store the token in localStorage or sessionStorage as per your requirement
                        // localStorage.setItem('token', token);

                        // // Attach the Sanctum token to the requests
                        // axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
                        // const postsResponse = await axios.get('/api/home');
                        // const postsHtml = postsResponse.data.html;
                        // document.body.innerHTML = postsHtml;
                        // // const posts = postsResponse.data;
                        // Example: Redirect to the home page
                        //return view('components.posts', ['posts' => $posts]);

                    } catch (error) {
                        // Handle authentication errors
                        const errorMessageElement =   document.getElementById('error-message');
                        errorMessageElement.innerHTML = 'Enter Only Registered Mail-Id Please!';
                        errorMessageElement.classList.remove('hidden');
                    }
                });
            }
        });
    </script> --}}

</x-layout>
