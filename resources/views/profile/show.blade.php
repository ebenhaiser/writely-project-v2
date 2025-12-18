<x-layout.main>
    <x-slot:title>{{ $title }}</x-slot:title>
    <livewire:profile.show :userId="$userId" />
</x-layout.main>