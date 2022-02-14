<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('クラウドソーシング編集') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ isset($page) ? route('crowd_sourcing.update', [$crowd_sourcing->id, 'page' => $page]) : route('crowd_sourcing.update', $crowd_sourcing->id) }}" method="POST">
                        @if ($errors->any())
                            <div class="card-text text-left alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li style="color:red;">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br />
                        @endif

                        @csrf
                        @method('PUT')
                        <div>
                            <x-label for="name" :value="__('名前')" />
                            <x-input class="block mt-1" type="text" name="name" :value="old('name', $crowd_sourcing->name)" autofocus />
                        </div>
                        <div class="mt-4">
                            <x-label for="sort_order" :value="__('並び順')" />
                            <x-input class="block mt-1" type="text" name="sort_order" :value="old('sort_order', $crowd_sourcing->sort_order)" />
                        </div>
                        <div class="mt-4">
                            <x-label for="display" :value="__('表示 / 非表示')" />
                            <input type="radio" name="display" value="1"{{ old('display', $crowd_sourcing->display) == '1' ? ' checked' : '' }}>表示
                            <input type="radio" name="display" value="0"{{ old('display', $crowd_sourcing->display) == '0' ? ' checked' : '' }}>非表示
                        </div>
                        <div class="mt-4">
                            <a href="{{ isset($page) ? route('crowd_sourcing.index', ['page' => $page]) : route('crowd_sourcing.index') }}" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-800">{{ __('戻る') }}</a>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('編集する') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
