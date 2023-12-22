<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">Forget Password</h1>

            <form method="POST" action="/forgot-password" class="mt-10">
                @csrf {{-- Cross-site request forgery --}}

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="email">Email</label>
                    <input class="border border-gray-400 p-2 w-full" type="email" name="email" id="email" required value="{{ old('email') }}">
                    @error('email')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Add OTP Input Field and Submit Button -->
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="otp">OTP</label>
                    <input class="border border-gray-400 p-2 w-full" type="text" name="otp" id="otp" required>
                    @error('otp')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">Submit</button>
                </div>

                <div class="mb-6 text-center">
                    <p class="text-gray-600">Remember your password? <a href="/login" class="text-blue-500">Login here</a></p>
                </div>

            </form>
        </main>
    </section>
</x-layout>
