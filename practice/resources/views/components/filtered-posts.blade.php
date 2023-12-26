<x-layout :categories="$categories" :posts="$posts">
<main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">

    @php
        $total_posts = @count($posts);
        $remaining_posts = $total_posts % 3;
    @endphp

    @if($total_posts>=3)
        @for($j=0;$j<=$total_posts-3;$j+=3)
            <div class="lg:grid lg:grid-cols-3">
                <x-post-card :post="$posts[$j]"/>
                <x-post-card :post="$posts[$j+1]"/>
                <x-post-card :post="$posts[$j+2]"/>
            </div>
        @endfor
        <div class="lg:grid lg:grid-cols-{{$remaining_posts}}">
            @for($j=$total_posts-$remaining_posts;$j<=$total_posts-1;$j++)
                <x-post-card :post="$posts[$j]"/>
            @endfor
        </div>
    @else
        <div class="lg:grid lg:grid-cols-{{$remaining_posts}}">
            @for($j=$total_posts-$remaining_posts;$j<=$total_posts-1;$j++)
                <x-post-card :post="$posts[$j]"/>
            @endfor
        </div>
    @endif
</main>
</x-layout>
