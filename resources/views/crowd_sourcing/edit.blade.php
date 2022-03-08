<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('クラウドソーシング編集') }}
            </h2>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ isset($page) ? route('crowd_sourcing.update', [$crowd_sourcing->id, 'page' => $page]) : route('crowd_sourcing.update', $crowd_sourcing->id) }}" method="POST">
                        <x-validation-errors :errors="$errors" />

                        @csrf
                        @method('PUT')
                        <div>
                            <x-label for="name" :value="__('名前')" />
                            <x-input class="block mt-1 w-56" type="text" name="name" :value="old('name', $crowd_sourcing->name)" autofocus />
                        </div>
                        <div class="mt-4">
                            <x-label for="sort_order" :value="__('並び順')" />
                            <x-input class="block mt-1 w-16" type="text" name="sort_order" :value="old('sort_order', $crowd_sourcing->sort_order)" />
                        </div>
                        <div class="mt-4">
                            <x-label for="display" :value="__('表示 / 非表示')" />
                            <x-input-radio name="display" value="1" :checked="old('display', $crowd_sourcing->display) == '1'" :label="__('表示')" />
                            <x-input-radio name="display" value="0" :checked="old('display', $crowd_sourcing->display) == '0'" :label="__('非表示')" />
                        </div>
                        <div class="mt-4">
                            <x-back-button href="{{ isset($page) ? route('crowd_sourcing.index', ['page' => $page]) : route('crowd_sourcing.index') }}" />
                            <x-save-button :label="__('編集する')" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
