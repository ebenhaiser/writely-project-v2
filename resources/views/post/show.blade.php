<x-layout.main>
    <x-slot:title>{{ $title }}</x-slot>
    <livewire:post.show :postId="$postId" />
</x-layout.main>