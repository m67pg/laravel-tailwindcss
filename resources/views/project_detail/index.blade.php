<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('プロジェクト詳細一覧') }}
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
                                <th class="border px-4 py-2" style="width:75%;border:none;" align="left"><a href="{{ route('project_detail.create', ['project_id' => $projectDetailInfo['project_id']]) }}">新規追加</a></th>
                                <th class="border px-4 py-2" style="border:none;" align="right" colspan="2"><a href="{{ route('project.index', session()->has('page') ? ['page' => session('page')] : []) }}">戻る</a></th>
                            </tr>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2" style="width:89%">名前</th>
                                <th class="border px-4 py-2">表示 / 非表示</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projectDetailInfo['project_details'] as $project_detail)
                            <tr>
                                <td class="border px-4 py-2" style="word-break:break-all;">
                                    <a href="{{ route('project_detail.edit', ['project_id' => $projectDetailInfo['project_id'], 'id' => $project_detail->id]) }}"><i class="far fa-edit"></i></a>
                                    {{ $project_detail->name }}
                                </td>
                                <td class="border px-4 py-2">{{ $project_detail->display == 1 ? '表示' : '非表示' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
