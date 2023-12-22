<x-layout>
@foreach ($posts as $post)
    <x-post-card :post="$post" />
@endforeach
</x-layout>
