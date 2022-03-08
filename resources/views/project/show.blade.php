<x-app-layout>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">プロジェクト情報の表示</h3>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <x-project-show :even="false" :label="__('名前')">{{ $projectInfo['project']['name'] }}</x-project-show>
                <x-project-show :even="true" :label="__('クラウドソーシング')">{{ $projectInfo['project']['crowd_sourcing_name'] }}</x-project-show>
                <x-project-show :even="false" :label="__('発注者')">{{ $projectInfo['project']['orderer_name'] }}</x-project-show>
                <x-project-show :even="true" :label="__('進捗')">
                    <p style="margin-bottom:8px;">{{ $projectInfo['current_progress']->name }}</p>
                    @foreach($projectInfo['project_progresses'] as $project_progress)
                    <p>{{ $project_progress->created_at }} : {{ $project_progress->name }}</p>
                    @endforeach
                </x-project-show>
                @foreach($projectInfo['project_details'] as $project_detail)
                <x-project-show :even="$loop->even" :label="$project_detail->name" :is_tag="true" >
                    {!! Str::of($project_detail->message)->replace("\n", '<br>') !!}
                </x-project-show>
                @endforeach
            </dl>
        </div>
        <div class="mt-4 px-2 py-4">
            <x-back-button href="{{ route('project.index', session()->has('page') ? ['page' => session('page')] : []) }}" />
        </div>
    </div>
</x-app-layout>
