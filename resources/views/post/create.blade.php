<x-layout.main>
    <x-slot:title>{{ $title }}</x-slot:title>
    <livewire:post.create :post="$post ?? null" />
</x-layout.main>
