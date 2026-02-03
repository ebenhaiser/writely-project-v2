@if (session('successToast'))
    <div id="successToast"
        class="toast bs-toast toast-placement-ex m-2 fade bg-primary top-0 start-50 translate-middle-x"
        role="alert"
        aria-live="assertive"
        aria-atomic="true"
        data-bs-delay="2000"
        data-bs-autohide="true">
        <div class="toast-header">
            <div class="me-auto fw-semibold">Success</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body">
            {!! session('successToast') !!}
        </div>
    </div>
@endif

@if (session('errorToast'))
    <div id="errorToast"
        class="toast bs-toast toast-placement-ex m-2 fade bg-danger top-0 start-50 translate-middle-x"
        role="alert"
        aria-live="assertive"
        aria-atomic="true"
        data-bs-delay="3000"
        data-bs-autohide="true">
        <div class="toast-header">
            <div class="me-auto fw-semibold">Error</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body">
            {!! session('errorToast') !!}
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.toast').forEach(toastEl => {
            new bootstrap.Toast(toastEl).show();
        });
    });
</script>
