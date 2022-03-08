@if ($message = Session::get('success'))
<div style="color:blue">{{ $message }}</div><br />
@endif
