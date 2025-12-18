<x-layout.main>
        <x-slot:title>{{ $title }}</x-slot:title>
        <livewire:page.category :category_slug="$category_slug" />
</x-layout.main>