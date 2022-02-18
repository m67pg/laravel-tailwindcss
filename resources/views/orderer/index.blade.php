<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('発注者一覧') }}
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
                                <th class="border px-4 py-2" style="border:none;" align="left" colspan="2"><a href="{{ isset($page) ? route('orderer.create', ['page' => $page]) : route('orderer.create') }}">新規追加</a></th>
                            </tr>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2" style="width:82%">名前</th>
                                <th class="border px-4 py-2">並び順</th>
                                <th class="border px-4 py-2">表示 / 非表示</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderers as $orderer)
                            <tr>
                                <td class="border px-4 py-2" style="word-break:break-all;">
                                    <a href="{{ isset($page) ? route('orderer.edit', [$orderer->id, 'page' => $page]) : route('orderer.edit', $orderer->id) }}"><i class="far fa-edit"></i></a>
                                    {{ $orderer->name }}
                                </td>
                                <td class="border px-4 py-2">{{ $orderer->sort_order }}</td>
                                <td class="border px-4 py-2">{{ $orderer->display == 1 ? '表示' : '非表示' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">
                                    {{ $orderers->links() }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
