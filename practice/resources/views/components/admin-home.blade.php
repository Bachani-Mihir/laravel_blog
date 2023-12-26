<x-layout>
<main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
            @foreach($posts as $post)
                <div class="lg:grid lg:grid-cols-2">
                    <x-post-card :post="$post"/>
                </div>
            @endforeach
</main>
</x-layout>
