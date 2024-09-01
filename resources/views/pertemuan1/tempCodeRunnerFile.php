<?php
@section('script')
{{-- <script>
    document.getElementById('form1').addEventListener('submit', function(e) {
        e.preventDefault();
        const param1 = document.getElementById('param1').value;
        const url = `{{ url('/pertemuan1/param') }}/${param1}`;
        window.location.href = url;
    });

    document.getElementById('form2').addEventListener('submit', function(e) {
        e.preventDefault();
        const param1 = document.getElementById('param1-2').value;
        const param2 = document.getElementById('param2-2').value;
        const url = `{{ url('/pertemuan1/param') }}/${param1}/${param2}`;
        window.location.href = url; 
    });
</script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form1 = document.getElementById('form1');
        const param1Input = document.getElementById('param1');
        const preview1Span = document.getElementById('preview-1');

        const form2 = document.getElementById('form2');
        const param1Input2 = document.getElementById('param1-2');
        const param2Input2 = document.getElementById('param2-2');
        const preview2Span = document.getElementById('preview-2');

        function updatePreview1() {
            const param1 = encodeURIComponent(param1Input.value);
            const previewUrl1 = `{{ url('/pertemuan1/param') }}/${param1}`;
            preview1Span.textContent = previewUrl1;
        }

        function updatePreview2() {
            const param1 = encodeURIComponent(param1Input2.value);
            const param2 = encodeURIComponent(param2Input2.value);
            const previewUrl2 = `{{ url('/pertemuan1/param') }}/${param1}/${param2}`;
            preview2Span.textContent = previewUrl2;
        }

        param1Input.addEventListener('input', updatePreview1);
        param1Input2.addEventListener('input', updatePreview2);
        param2Input2.addEventListener('input', updatePreview2);

        form1.addEventListener('submit', function(e) {
            e.preventDefault();
            const param1 = encodeURIComponent(param1Input.value);
            const url = `{{ url('/pertemuan1/param') }}/${param1}`;
            window.location.href = url;
        });

        form2.addEventListener('submit', function(e) {
            e.preventDefault();
            const param1 = encodeURIComponent(param1Input2.value);
            const param2 = encodeURIComponent(param2Input2.value);
            const url = `{{ url('/pertemuan1/param') }}/${param1}/${param2}`;
            window.location.href = url;
        });

        updatePreview1();
        updatePreview2();
    });
</script>
@endsection