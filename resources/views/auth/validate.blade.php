




@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show w-50" style="margin: 15px auto; padding:2px 30px;" role="alert">
<ul>
@foreach ($errors->all() as $error)
  <li>{{ $error }}</li>
@endforeach
</ul>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif
