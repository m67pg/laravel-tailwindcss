<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('プロジェクト一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($message = Session::get('success'))
                        <div style="color:blue">{{ $message }}</div><br />
                    @endif

                    <form action="{{ route('project.index') }}" method="POST">
                        @csrf
                        @method('GET')

                        <div>
                            <x-label for="keyword" :value="__('キーワード')" />
                            <x-input class="block mt-1" type="text" name="keyword" :value="session('keyword')" autofocus />
                        </div>
                        <div class="mt-4">
                            <x-label for="crowd_sourcing_id" :value="__('クラウドソーシング')" />
                            <select class="block mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="crowd_sourcing_id">
                                <option value=""{{ session('crowd_sourcing_id') == '' ? ' selected' : '' }}></option>
                            @foreach($projectInfo['crowd_sourcings'] as $crowd_sourcing)
                                <option value="{{ $crowd_sourcing->id }}"{{ session('crowd_sourcing_id') == $crowd_sourcing->id ? ' selected' : '' }}>{{ $crowd_sourcing->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <x-label for="orderer_id" :value="__('発注者')" />
                            <select class="block mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="orderer_id">
                                <option value=""{{ session('orderer_id') == '' ? ' selected' : '' }}></option>
                            @foreach($projectInfo['orderers'] as $orderer)
                                <option value="{{ $orderer->id }}"{{ session('orderer_id') == $orderer->id ? ' selected' : '' }}>{{ $orderer->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <x-label for="progress_id" :value="__('進捗')" />
                            <select class="block mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="progress_id">
                                <option value=""{{ session('progress_id') == '' ? ' selected' : '' }}></option>
                            @foreach($projectInfo['progresses'] as $progress)
                                <option value="{{ $progress->id }}"{{ session('progress_id') == $progress->id ? ' selected' : '' }}>{{ $progress->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-800" name="reset_button">{{ __('リセット') }}</button>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" name="submit_button">{{ __('検索する') }}</button>
                        </div>
                    </form>

                    <table class="table-fixed">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2" style="border:none;" align="left" colspan="2"><a href="{{ route('project.create') }}">新規追加</a></th>
                            </tr>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2" style="width:50%">名前</th>
                                <th class="border px-4 py-2">クラウドソーシング</th>
                                <th class="border px-4 py-2">発注者</th>
                                <th class="border px-4 py-2">表示</th>
                                <th class="border px-4 py-2">編集</th>
                                <th class="border px-4 py-2">詳細</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projectInfo['projects'] as $project)
                            <tr>
                                <td class="border px-4 py-2" style="word-break:break-all;">{{ $project->name }}</td>
                                <td class="border px-4 py-2">{{ $project->crowd_sourcing_name }}</td>
                                <td class="border px-4 py-2">{{ $project->orderer_name }}</td>
                                <td class="border px-4 py-2"><a href="{{ route('project.show', $project->id) }}">表示</a></td>
                                <td class="border px-4 py-2"><a href="{{ route('project.edit', $project->id) }}">編集</a></td>
                                <td class="border px-4 py-2"><a href="{{ route('project_detail.index', ['project_id' => $project->id]) }}">詳細</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    {{ $projectInfo['projects']->links() }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
