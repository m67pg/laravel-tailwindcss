@props(['id' => '', 'selected' => '', 'options' => []])

<select id="{{ $id }}" name="{{ $id }}" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    <option value=""{{ $selected == '' ? ' selected' : '' }}></option>
@foreach($options as $option)
    <option value="{{ $option->id }}"{{ $selected == $option->id ? ' selected' : '' }}>{{ $option->name }}</option>
@endforeach
</select>
