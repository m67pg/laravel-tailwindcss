@props(['errors'])

@if ($errors->any())
<div class="card-text text-left alert alert-danger">
    <ul class="mb-0">
    @foreach($errors->all() as $error)
        <li style="color:red;">{{ $error }}</li>
    @endforeach
    </ul>
</div><br />
@endif
