<x-app-layout>
    <div class="py-2 w-2/3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 bg-white">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight py-4">
                        {{ __('進捗一覧') }}
                    </h2>

                    <x-message-success />

                    <div class="flex flex-col py-2">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-900 uppercase tracking-wider">{{ __('名前') }}</th>
                                                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-900 uppercase tracking-wider">{{ __('並び順') }}</th>
                                                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-900 uppercase tracking-wider">{{ __('表示 / 非表示') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($progresses as $progress)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <a href="{{ isset($page) ? route('progress.edit', [$progress->id, 'page' => $page]) : route('progress.edit', $progress->id) }}"><i class="far fa-edit"></i></a>
                                                        {{ $progress->name }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $progress->sort_order }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $progress->display == 1 ? '表示' : '非表示' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="px-4 py-4" colspan="3">
                                                    <div class="py-1.5" style="float:left;">
                                                        <x-create-button href="{{ isset($page) ? route('progress.create', ['page' => $page]) : route('progress.create') }}" />
                                                    </div>
                                                    @if ($progresses->lastPage() > 1)
                                                    <div>
                                                        {{ $progresses->links() }}
                                                    </div>
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
