<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('進捗一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($message = Session::get('success'))
                        <div style="color:blue">{{ $message }}</div><br />
                    @endif

                    <table class="table-fixed">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2" style="border:none;" align="left" colspan="2"><a href="{{ isset($page) ? route('progress.create', ['page' => $page]) : route('progress.create') }}">新規追加</a></th>
                            </tr>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2" style="width:82%">名前</th>
                                <th class="border px-4 py-2">並び順</th>
                                <th class="border px-4 py-2">表示 / 非表示</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($progresses as $progress)
                            <tr>
                                <td class="border px-4 py-2" style="word-break:break-all;">
                                    <a href="{{ isset($page) ? route('progress.edit', [$progress->id, 'page' => $page]) : route('progress.edit', $progress->id) }}"><i class="far fa-edit"></i></a>
                                    {{ $progress->name }}
                                </td>
                                <td class="border px-4 py-2">{{ $progress->sort_order }}</td>
                                <td class="border px-4 py-2">{{ $progress->display == 1 ? '表示' : '非表示' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">
                                    {{ $progresses->links() }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
