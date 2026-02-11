<x-layout.main>
    <x-slot:title>{{ $title }}</x-slot:title>
    <livewire:profile.follow :username="$username" :follow="$follow" />
</x-layout.main>