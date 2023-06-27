@if (session('success'))
    <script>
        Swal.fire({
            title: 'Success',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'Ok'
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            title: 'Error',
            text: "{{ session('error') }}",
            icon: 'error',
            confirmButtonText: 'Ok'
        });
    </script>
@endif

@if (session('info'))
    <script>
        Swal.fire({
            title: 'Info',
            text: "{{ session('info') }}",
            icon: 'info',
            confirmButtonText: 'Ok'
        });
    </script>
@endif

@if (session('warning'))
    <script>
        Swal.fire({
            title: 'Warning',
            text: "{{ session('warning') }}",
            icon: 'warning',
            confirmButtonText: 'Ok'
        });
    </script>
@endif
