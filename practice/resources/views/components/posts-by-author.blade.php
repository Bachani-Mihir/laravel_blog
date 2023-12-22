<x-layout :categories="$categories">
    @foreach ($posts as $post)
        <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
                    <div class="lg:grid lg:grid-cols-1">
                        <x-post-card :post="$post"/>
                    </div>
        </main>
    @endforeach
</x-layout>
