<x-layout.main>
    <x-slot name="title">{{ $title }}</x-slot>
    <livewire:post.show :post="$post" />
</x-layout.main>