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

                    @admin
                            <x-dropdown-item
                                href="/admin/posts"
                            >
                                Dashboard
                            </x-dropdown-item>

                    @endadmin


                    @guest
                        <a href="/login" class="text-xs font-bold uppercase">Login</a>
                        <a href="/home" class="text-xs font-bold uppercase">Home Page</a>
                    @endguest

                    @if(auth()->check())
                        @admin
                            <a href="/admin-home" class="text-xs font-bold uppercase">Home Page</a>
                        @endadmin

                        @user
                            <a href="/posts" class="text-xs font-bold uppercase">Home Page</a>
                        @enduser

                        <p class="text-sm">Welcome, {{ auth()->user()->email }}</p>
                        <p class="text-sm">
                            <a href="/logout"> Logout </a>
                        </p>

                    @endif
                </a>

                <a href="#" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                    Subscribe for Updates
                </a>

            </div>
        </nav>

@if(auth()->check())
    <x-post-header />
@endif

    {{$slot}}

    <x-post-footer />

    </section>
</body>


    {{-- javascript code to load page as per the category selected. --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var categorySelect = document.getElementById('categorySelect');

        if (categorySelect) {
            categorySelect.addEventListener('change', function() {
                // Get the selected option value
                var selectedOptionValue = categorySelect.value;

                // Your logic based on the selected value
                if (selectedOptionValue === 'category') {
                    // Do something when 'Category' is selected
                    console.log('Category option selected');
                } else {
                    // Do something else based on the selected value
                    console.log('Selected category ID:', selectedOptionValue);
                }
            });
        }else{
            @dd("hie");
        }
    });
</script>
