<x-layout.main>
    <x-slot name="title">{{ $title }}</x-slot>
    <livewire:post.show :slug="$slug" />
</x-layout.main>