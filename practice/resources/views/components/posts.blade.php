<x-layout>
<main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
            <x-post-featured-card :post="$posts[0]"/>
            <div class="lg:grid lg:grid-cols-2">
                <x-post-card :post="$posts[1]"/>
                <x-post-card :post="$posts[2]"/>
            </div>
            <div class="lg:grid lg:grid-cols-3">
                <x-post-card :post="$posts[3]"/>
                <x-post-card :post="$posts[4]"/>
                <x-post-card :post="$posts[5]"/>
            </div>
</main>
</x-layout>
