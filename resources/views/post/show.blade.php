<x-layout.main>
    <x-slot:title>{{ $title }}</x-slot>
    <livewire:post.show :slug="$slug" />
</x-layout.main>