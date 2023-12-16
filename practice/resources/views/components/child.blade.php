<!-- resources/views/components/ChildComponent.blade.php -->

<div>
    <h1>Hello, {{ $name }}!</h1>
    <p>You are {{ $age }} years old.</p>
</div>

@props(['name', 'age'])
