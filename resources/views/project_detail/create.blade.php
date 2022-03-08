<x-app-layout>
    <div class="mt-10 sm:mt-0 w-5/6">
        <div class="mt-5">
            <div class="px-4 sm:px-0">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight py-4">
                    {{ __('プロジェクト詳細新規追加') }}
                </h2>
            </div>

            <form action="{{ route('project_detail.store', ['project_id' => $projectDetailInfo['project_id']]) }}" method="POST" enctype="multipart/form-data">
                <x-validation-errors :errors="$errors" />

                @csrf

                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <x-label for="name" :value="__('名前')" />
                                <x-input-project class="w-full" type="text" name="name" id="name" value="{{ old('name') }}" autofocus="autofocus" />
                            </div>
                            <div class="col-span-3 sm:col-span-3">
                                <x-label for="message" :value="__('メッセージ')" />
                                <x-textarea-project name="message" id="message" rows="20" :label="old('message')" />
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <x-label for="upload_file" :value="__('アップロードファイル')" />
                                <x-input-project class="w-full" type="file" name="upload_file" id="upload_file" />
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <x-label for="sort_order" :value="__('並び順')" />
                                <x-input-project class="w-16"  type="text" name="sort_order" id="sort_order" value="{{ old('sort_order', '9') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <x-back-button href="{{ route('project_detail.index', ['project_id' => $projectDetailInfo['project_id']]) }}" />
                        <x-save-button />
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
