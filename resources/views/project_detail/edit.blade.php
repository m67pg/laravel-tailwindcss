<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('プロジェクト詳細編集') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('project_detail.update', ['project_id' => $projectDetailInfo['project_id'], 'id' => $projectDetailInfo['project_detail']->id])}}" method="POST" name="project_detail" enctype="multipart/form-data">
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
                        @method('PUT')
                        <div>
                            <x-label for="name" :value="__('名前')" />
                            <x-input class="block mt-1 w-full" type="text" name="name" :value="old('name', $projectDetailInfo['project_detail']->name)" autofocus />
                        </div>
                        <div class="mt-4">
                            <x-label for="message" :value="__('メッセージ')" />
                            <textarea class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="10" name="message">{{ old('message', $projectDetailInfo['project_detail']->message) }}</textarea>
                        </div>
                        <div class="mt-4">
                            <x-label for="upload_file" :value="__('アップロードファイル')" />
                            @if ($projectDetailInfo['project_detail']->upload_file)
                                <input type="hidden" id="delete_button" name="delete_button" value="0" />
                                <a href="/storage/{{ $projectDetailInfo['project_detail']->id . '-' . $projectDetailInfo['project_detail']->upload_file }}" download="{{ $projectDetailInfo['project_detail']->upload_file }}">{{ $projectDetailInfo['project_detail']->upload_file }}</a><br>
                                <button type="submit" class="modal-open text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">{{ __('削除する') }}</button>
                            @else
                                <x-input class="form-control block mt-1 w-2 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="file" name="upload_file" />
                            @endif
                        </div>
                        <div class="mt-4">
                            <x-label for="display" :value="__('表示 / 非表示')" />
                            <input type="radio" name="display" value="1"{{ old('display', $projectDetailInfo['project_detail']->display) == '1' ? ' checked' : '' }}>表示
                            <input type="radio" name="display" value="0"{{ old('display', $projectDetailInfo['project_detail']->display) == '0' ? ' checked' : '' }}>非表示
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('project_detail.index', ['project_id' => $projectDetailInfo['project_id']]) }}" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-800">{{ __('戻る') }}</a>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('編集する') }}</button>
                        </div>
                    </form>
                </div>
            </div>
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
