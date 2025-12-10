<x-layout.main>
    <x-slot:title>{{ '@' . $username . ' | Writely.' }}</x-slot:title>
    <livewire:profile.show :username="$username" />
</x-layout.main>