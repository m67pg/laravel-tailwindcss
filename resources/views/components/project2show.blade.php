@props(['even' => false,'label' => ''])

@if(!$even)
<div class="{{ $even ? 'bg-white' : 'bg-gray-50' }} px-4 py-5 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
@endif
    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-2">
        <div class="text-sm font-medium" style="color:blue">{{ $label }}</div>
        <br>
        {{ $slot }}
    </dd>
@if($even)
</div>
@endif
