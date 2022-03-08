<x-app-layout>
    <div class="mt-10 sm:mt-0">
        <div class="mt-5">
            <div class="px-4 sm:px-0">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight py-4">
                    {{ __('プロジェクト新規追加') }}
                </h2>
            </div>

            <form action="{{ route('project.store') }}" method="POST">
                <x-validation-errors :errors="$errors" />

                @csrf

                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-3">
                                <x-label for="name" :value="__('名前')" />
                                <x-input-project class="w-full" type="text" name="name" id="name" value="{{ old('name') }}" autofocus="autofocus" />
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <x-label for="crowd_sourcing_id" :value="__('クラウドソーシング')" />
                                <x-select-option :id="__('crowd_sourcing_id')" :selected="old('crowd_sourcing_id')" :options="$projectInfo['crowd_sourcings']" />
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <x-label for="orderer_id" :value="__('発注者')" />
                                <x-select-option :id="__('orderer_id')" :selected="old('orderer_id')" :options="$projectInfo['orderers']" />
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <x-label for="progress_id" :value="__('進捗')" />
                                <x-select-option :id="__('progress_id')" :selected="old('progress_id')" :options="$projectInfo['progresses']" />
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <x-label for="publication_on" :value="__('掲載日')" />
                                <x-input-project class="w-full" type="date" name="publication_on" id="publication_on" value="{{ old('publication_on') }}" />
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <x-label for="application_deadline_on" :value="__('応募期限')" />
                                <x-input-project class="w-full" type="date" name="application_deadline_on" id="application_deadline_on" value="{{ old('application_deadline_on') }}" />
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <x-label for="contract_amount_excluding_tax" :value="__('契約金額(税抜)')" />
                                <x-input-project class="w-full" type="text" name="contract_amount_excluding_tax" id="contract_amount_excluding_tax" value="{{ old('contract_amount_excluding_tax') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <x-back-button href="{{ route('project.index', session()->has('page') ? ['page' => session('page')] : []) }}" />
                        <x-save-button />
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
