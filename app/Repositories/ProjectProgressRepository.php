<?php

namespace App\Repositories;

use App\Models\ProjectProgress;
use Illuminate\Support\Facades\Log;

/**
 * プロジェクト進捗リポジトリ
 */
class ProjectProgressRepository
{
    /**
     * 現在のプロジェクト進捗を取得
     *
     * @param  int  $project_id
     * @return int
     */
    public function current($project_id)
    {
        Log::debug('ProjectProgressRepository::current()');

        $project_progress = ProjectProgress::select('project_progresses.*')
                                           ->join('progresses', 'project_progresses.progress_id', '=', 'progresses.id')
                                           ->where('project_progresses.project_id', $project_id)
                                           ->where('progresses.display', 1)
                                           ->orderByDesc('project_progresses.created_at')
                                           ->limit(1)
                                           ->get();
        return $project_progress->count() == 0 ? 0 : $project_progress[0]->progress_id;
    }

    /**
     * プロジェクト進捗一覧の取得
     *
     * @param  int  $project_id
     * @return array
     */
    public function all($project_id)
    {
        Log::debug('ProjectProgressRepository::all()');

        $project_progresses = ProjectProgress::select('progresses.name', 'project_progresses.created_at')
                                           ->join('progresses', 'project_progresses.progress_id', '=', 'progresses.id')
                                           ->where('project_progresses.project_id', $project_id)
                                           ->where('progresses.display', 1)
                                           ->orderByDesc('project_progresses.created_at')
                                           ->get();
        return $project_progresses;
    }

    /**
     * プロジェクト進捗の保存
     *
     * @param  int  $progress_id
     * @param  int  $project_id
     */
    public function save($progress_id, $project_id)
    {
        Log::debug('ProjectProgressRepository::save()');

        $current_progress_id = $this->current($project_id);
        if ($current_progress_id == 0 ||
           ($current_progress_id > 0 && $current_progress_id != $progress_id)) {
            $project_progress = new ProjectProgress();
            $project_progress->project_id = $project_id;
            $project_progress->progress_id = $progress_id;
            $project_progress->save();
        }
    }
}
