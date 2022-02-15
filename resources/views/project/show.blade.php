<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('プロジェクト情報の表示') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <x-label for="name" style='color:blue' :value="__('【名前】')" />
                        <p class="block mt-1" name="name">{{ $projectInfo['project']['name'] }}</p>
                    </div>
                    <div class="mt-4">
                        <x-label for="crowd_sourcing_name" style='color:blue' :value="__('【クラウドソーシング】')" />
                        <p class="block mt-1" name="crowd_sourcing_name">{{ $projectInfo['project']['crowd_sourcing_name'] }}</p>
                    </div>
                    <div class="mt-4">
                        <x-label for="orderer_name" style='color:blue' :value="__('【発注者】')" />
                        <p class="block mt-1" name="orderer_name">{{ $projectInfo['project']['orderer_name'] }}</p>
                    </div>
                    <div class="mt-4">
                        <x-label for="current_progress_name" style='color:blue' :value="__('【進捗】')" />
                        <p class="block mt-1" name="current_progress_name">{{ $projectInfo['current_progress']->name }}</p>
                    </div>
                    <div class="mt-4">
                        @foreach($projectInfo['project_progresses'] as $project_progress)
                            <p class="block mt-1">{{ $project_progress->created_at }} : {{ $project_progress->name }}</p>
                        @endforeach
                    </div>
                    @foreach($projectInfo['project_details'] as $key => $project_detail)
                        <div class="mt-4">
                            <label for="project_detail" style='color:blue'>{{ '【詳細' . ($key + 1) . '】' }}</label>
                            <p class="block mt-1" style='color:green' name="project_detail">{{ $project_detail->name }}</p>
                            <p class="block mt-1">{!! Str::of($project_detail->message)->replace("\n", '<br>') !!}</p>
                        </div>
                    @endforeach
                    <div class="mt-4">
                        <a href="{{ route('project.index', session()->has('page') ? ['page' => session('page')] : []) }}" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-800">{{ __('戻る') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
