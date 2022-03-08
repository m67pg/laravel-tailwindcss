<x-app-layout>
    <div class="py-2 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight py-4">
                        {{ __('プロジェクト一覧') }}
                    </h2>

                    <x-message-success />

                    <div class="mt-10 sm:mt-0">
                        <div class="md:grid md:grid-cols-2 md:gap-6">
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <form action="{{ route('project.index') }}" method="POST">
                                    @csrf
                                    @method('GET')

                                    <div class="shadow overflow-hidden sm:rounded-md">
                                        <div class="px-2 py-2 bg-white sm:p-6">
                                            <div class="grid grid-cols-12 gap-6">
                                                <div class="col-span-12 sm:col-span-3">
                                                    <x-label for="keyword" :value="__('キーワード')" />
                                                    <input type="text" name="keyword" id="keyword" autofocus="autofocus" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                                <div class="col-span-12 sm:col-span-3">
                                                    <x-label for="crowd_sourcing_id" :value="__('クラウドソーシング')" />
                                                    <x-select-option :id="__('crowd_sourcing_id')" :selected="session('crowd_sourcing_id')" :options="$projectInfo['crowd_sourcings']" />
                                                </div>

                                                <div class="col-span-12 sm:col-span-3">
                                                    <x-label for="orderer_id" :value="__('発注者')" />
                                                    <x-select-option :id="__('orderer_id')" :selected="session('orderer_id')" :options="$projectInfo['orderers']" />
                                                </div>

                                                <div class="col-span-12 sm:col-span-3">
                                                    <x-label for="progress_id" :value="__('進捗')" />
                                                    <x-select-option :id="__('progress_id')" :selected="session('progress_id')" :options="$projectInfo['progresses']" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="py-2 bg-gray-50 text-right sm:px-6">
                                            <button type="submit" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-800" name="reset_button">{{ __('リセット') }}</button>
                                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" name="submit_button">{{ __('検索する') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col py-4">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col">
                                                    <div class="px-6 py-1 text-left font-medium text-gray-900 uppercase tracking-wider">{{ __('名前') }}</div>
                                                    <div class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('発注者') }}</div>
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-900 uppercase tracking-wider">{{ __('クラウドソーシング') }}</th>
                                                <th scope="col">
                                                    <div class="px-6 py-1 text-left font-medium text-gray-900 uppercase tracking-wider">{{ __('進捗') }}</div>
                                                    <div class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('応募期限') }}</div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($projectInfo['projects'] as $project)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <a href="{{ route('project.show', $project->id) }}"><i class="far fa-file"></i></a>
                                                        <a href="{{ route('project.edit', $project->id) }}"><i class="far fa-edit"></i></a>
                                                        <a href="{{ route('project_detail.index', ['project_id' => $project->id]) }}"><i class="far fa-copy"></i></a>
                                                        {{ $project->name }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">{{ $project->orderer_name }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $project->crowd_sourcing_name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">{{ $project->progress_name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $project->application_deadline_on }}</div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="px-4 py-4">
                                                    <x-create-button href="{{ route('project.create') }}" />
                                                </td>
                                                <td colspan="2">
                                                @if ($projectInfo['projects']->lastPage() > 1)
                                                    {{ $projectInfo['projects']->links() }}
                                                @endif
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
