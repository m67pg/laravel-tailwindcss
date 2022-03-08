@props(['even' => false,'label' => ''])

<div class="{{ $even ? 'bg-white' : 'bg-gray-50' }} px-4 py-5 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
    <dt class="text-sm font-medium text-gray-500">{{ $label }}</dt>
    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-3">
        {{ $slot }}
    </dd>
</div>
