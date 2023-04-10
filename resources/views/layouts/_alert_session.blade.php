<body>
    @if (session('message'))
        <div class="alert alert-{{ session('type') }} alert-dismissible fade show w-75 mx-auto  " id="test1">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <script>
        setTimeout(() => {
            $('.alert').fadeOut()
        }, 3000);
   
    </script>
</body>

</html>



{{-- return redirect()->back()->with('message', 'تم الحفظ')->with('type', 'success'); --}}
