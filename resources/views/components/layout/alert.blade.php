@if (session('successAlert'))
    <div class="alert alert-success alert-dismissible fade show session-alert" role="alert">
        {!! session('successAlert') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('errorAlert'))
    <div class="alert alert-danger alert-dismissible fade show session-alert" role="alert">
        {!! session('errorAlert') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- <script>
    document.addEventListener('livewire:navigated', () => {
        document.querySelectorAll('.session-alert').forEach(alertEl => {
            setTimeout(() => {
                bootstrap.Alert.getOrCreateInstance(alertEl).close();
            }, 3000);
        });
    });
</script> --}}


