<div>
    <script src="https://cdn.tiny.cloud/1/{{ env('NO_API_KEY') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: 'textarea#content',
        plugins: 'code table lists',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
        styleFormats: [
            {
                title: 'Paragraph with mt-32',
                selector: 'p',
                classes: 'mt-32'
            }
        ]
      });
    </script>
</div>
