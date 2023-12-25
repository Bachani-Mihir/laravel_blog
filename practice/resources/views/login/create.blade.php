<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">Login!</h1>

            <form method="POST" action="/login" class="mt-10">
                @csrf       {{--cross site request forgery --}}


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
                           value = {{old('email')}}

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
                    <button type="submit"
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
</x-layout>
