@props(['checked' => false, 'label' => ''])

<input type="radio" {!! $attributes !!}{{ $checked ? ' checked' : '' }}>{{ $label }}
