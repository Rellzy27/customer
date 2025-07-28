<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if(session('toast_success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('toast_success') }}',
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
            });
        @endif

        @if(session('toast_error'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: '{{ session('toast_error') }}',
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
            });
        @endif

        @if($errors->any())
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Terdapat kesalahan validasi',
                html: `
                    <ul style="text-align: left; list-style-position: inside; padding-left: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
            });
        @endif
    });
</script>
