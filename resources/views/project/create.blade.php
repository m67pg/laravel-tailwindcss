<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('プロジェクト新規追加') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('project.store') }}" method="POST">
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
                        <div>
                            <x-label for="name" :value="__('名前')" />
                            <x-input class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus />
                        </div>
                        <div class="mt-4">
                            <x-label for="crowd_sourcing_id" :value="__('クラウドソーシング')" />
                            <select class="block mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="crowd_sourcing_id">
                                <option value=""{{ old('crowd_sourcing_id') == '' ? ' selected' : '' }}></option>
                            @foreach($projectInfo['crowd_sourcings'] as $crowd_sourcing)
                                <option value="{{ $crowd_sourcing->id }}"{{ old('crowd_sourcing_id') == $crowd_sourcing->id ? ' selected' : '' }}>{{ $crowd_sourcing->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <x-label for="orderer_id" :value="__('発注者')" />
                            <select class="block mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="orderer_id">
                                <option value=""{{ old('orderer_id') == '' ? ' selected' : '' }}></option>
                            @foreach($projectInfo['orderers'] as $orderer)
                                <option value="{{ $orderer->id }}"{{ old('orderer_id') == $orderer->id ? ' selected' : '' }}>{{ $orderer->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <x-label for="progress_id" :value="__('進捗')" />
                            <select class="block mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="progress_id">
                                <option value=""{{ old('progress_id') == '' ? ' selected' : '' }}></option>
                            @foreach($projectInfo['progresses'] as $progress)
                                <option value="{{ $progress->id }}"{{ old('progress_id') == $progress->id ? ' selected' : '' }}>{{ $progress->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <x-label for="publication_on" :value="__('掲載日')" />
                            <input class="block mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="date" name="publication_on" value="{{ old('publication_on') }}" />
                        </div>
                        <div class="mt-4">
                            <x-label for="application_deadline_on" :value="__('応募期限')" />
                            <input class="block mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="date" name="application_deadline_on" value="{{ old('application_deadline_on') }}" />
                        </div>
                        <div class="mt-4">
                            <x-label for="contract_amount_excluding_tax" :value="__('契約金額(税抜)')" />
                            <x-input class="block mt-1" type="text" name="contract_amount_excluding_tax" :value="old('contract_amount_excluding_tax')" />
                        </div>
                        <div class="mt-4">
                            <x-label for="display" :value="__('表示 / 非表示')" />
                            <input type="radio" name="display" value="1"{{ old('display', '1') == '1' ? ' checked' : '' }}>表示
                            <input type="radio" name="display" value="0"{{ old('display') == '0' ? ' checked' : '' }}>非表示
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('project.index', session()->has('page') ? ['page' => session('page')] : []) }}" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-800">{{ __('戻る') }}</a>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('登録する') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
