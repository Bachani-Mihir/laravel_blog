


<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">Change Password</h1>

            <form method="POST" action="/update-password" class="mt-10">
                @csrf {{--  Cross-site request forgery --}}
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="new_password">New Password</label>
                    <input class="border border-gray-400 p-2 w-full" type="password" name="new_password" id="new_password" required>
                    @error('new_password')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="confirm_password">Confirm Password</label>
                    <input class="border border-gray-400 p-2 w-full" type="password" name="confirm_password" id="confirm_password" required>
                    @error('confirm_password')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">Submit</button>
                </div>

                <div class="mb-6 text-center">
                    <p class="text-gray-600">Remember your password? <a href="/login" class="text-blue-500">Login here</a></p>
                </div>
                 <input type="hidden" name="email" value="{{ $email }}">
            </form>
        </main>
    </section>
</x-layout>
