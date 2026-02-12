<x-layout.main>
    <x-slot:title>{{ $title }}</x-slot:title>

    <livewire:chat.layout :username="$username ?? null" />
</x-layout.main>
