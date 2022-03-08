<x-app-layout>
    <div class="mt-10 sm:mt-0 w-5/6">
        <div class="mt-5">
            <div class="px-4 sm:px-0">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight py-4">
                    {{ __('プロジェクト詳細編集') }}
                </h2>
            </div>

            <form action="{{ route('project_detail.update', ['project_id' => $projectDetailInfo['project_id'], 'id' => $projectDetailInfo['project_detail']->id])}}" method="POST" name="project_detail" enctype="multipart/form-data">
                <x-validation-errors :errors="$errors" />

                @csrf
                @method('PUT')

                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <x-label for="name" :value="__('名前')" />
                                <x-input-project class="w-full" type="text" name="name" id="name" value="{{ old('name', $projectDetailInfo['project_detail']->name) }}" autofocus="autofocus" />
                            </div>
                            <div class="col-span-3 sm:col-span-3">
                                <x-label for="message" :value="__('メッセージ')" />
                                <x-textarea-project name="message" id="message" rows="20" :label="old('message', $projectDetailInfo['project_detail']->message)" />
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <x-label for="upload_file" :value="__('アップロードファイル')" />
                            @if ($projectDetailInfo['project_detail']->upload_file)
                                <input type="hidden" id="delete_button" name="delete_button" value="0" />
                                <a href="/storage/{{ $projectDetailInfo['project_detail']->id . '-' . $projectDetailInfo['project_detail']->upload_file }}" download="{{ $projectDetailInfo['project_detail']->upload_file }}">{{ $projectDetailInfo['project_detail']->upload_file }}</a><br>
                                <button type="submit" class="modal-open text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">{{ __('削除する') }}</button>
                            @else
                                <x-input-project class="w-full" type="file" name="upload_file" id="upload_file" />
                            @endif
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <x-label for="sort_order" :value="__('並び順')" />
                                <x-input-project class="w-16" type="text" name="sort_order" id="sort_order" value="{{ old('sort_order', $projectDetailInfo['project_detail']->sort_order) }}" />
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <x-label for="display" :value="__('表示 / 非表示')" />
                                <x-input-radio name="display" value="1" :checked="old('display', $projectDetailInfo['project_detail']->display) == '1'" :label="__('表示')" />
                                <x-input-radio name="display" value="0" :checked="old('display', $projectDetailInfo['project_detail']->display) == '0'" :label="__('非表示')" />
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <x-back-button href="{{ route('project_detail.index', ['project_id' => $projectDetailInfo['project_id']]) }}" />
                        <x-save-button :label="__('編集する')" />
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--Modal-->
    <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
                <span class="text-sm">(Esc)</span>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">確認モーダル</p>
                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                    </div>
                </div>

                <!--Body-->
                <p>削除します。よろしいですか？</p>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <button class="modal-active px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">削除する</button>
                    <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">閉じる</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        var openmodal = document.querySelectorAll('.modal-open')
        for (var i = 0; i < openmodal.length; i++) {
            openmodal[i].addEventListener('click', function(event){
                event.preventDefault()
                toggleModal()
            })
        }

        const overlay = document.querySelector('.modal-overlay')
        overlay.addEventListener('click', toggleModal)

        var closemodal = document.querySelectorAll('.modal-close')
        for (var i = 0; i < closemodal.length; i++) {
            closemodal[i].addEventListener('click', toggleModal)
        }

        const activemodal = document.querySelector('.modal-active')
        activemodal.addEventListener('click', toggleActiveModal)

        document.onkeydown = function(evt) {
            evt = evt || window.event
            var isEscape = false
            if ("key" in evt) {
                isEscape = (evt.key === "Escape" || evt.key === "Esc")
            } else {
                isEscape = (evt.keyCode === 27)
            }
            if (isEscape && document.body.classList.contains('modal-active')) {
                toggleModal()
            }
        };

        function toggleActiveModal () {
            document.getElementById('delete_button').value = 1;
            document.project_detail.submit()
            toggleModal()
        }
        function toggleModal () {
            const body = document.querySelector('body')
            const modal = document.querySelector('.modal')
            modal.classList.toggle('opacity-0')
            modal.classList.toggle('pointer-events-none')
            body.classList.toggle('modal-active')
        }
    </script>
</x-app-layout>
