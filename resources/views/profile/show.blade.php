<x-layout.main>
    <x-slot:title>{{ $title }}</x-slot:title>
    <livewire:profile.show :username="$username" />
</x-layout.main>