<?php

namespace App\Repositories;

use App\Models\ProjectProgress;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * プロジェクトリポジトリ
 */
class ProjectRepository extends BaseRepository
{
    /**
     * プロジェクトモデルの取得
     */
    protected function getModel()
    {
        Log::debug('ProjectRepository::getModel()');

        $this->model = app(Project::class);
    }

    /**
     * 一覧の取得
     *
     * @param  array  $input
     * @return array
     */
    public function get($input = [])
    {
        Log::debug('ProjectRepository::get()');

        $list = $this->model
                     ->where('projects.display', 1)
                     ->where('crowd_sourcings.display', 1)
                     ->where('orderers.display', 1);

        if (array_key_exists('keyword', $input) && $input['keyword']) {
            $keyword = '%' . $input['keyword'] . '%';

            $subQuery = ProjectProgress::select('project_progresses.project_id',
                                                'progresses.name',
                                                DB::raw('row_number() over (partition by project_progresses.project_id order by project_progresses.created_at desc) as num'))
                                       ->from('project_progresses')
                                       ->join('progresses', 'project_progresses.progress_id', '=', 'progresses.id')
                                       ->where('progresses.display', ':display')
                                       ->groupBy('project_progresses.project_id')
                                       ->groupBy('progresses.name')
                                       ->toSql();

            $list->where(function($query) use ($keyword, $subQuery) {
                            $query->where('projects.name', 'like', $keyword)
                                  ->orWhereIn('projects.id', function($query) use ($keyword, $subQuery) {
                                                 $query->select('progress_info.project_id')
                                                       ->from(DB::raw('(' . $subQuery . ') as progress_info'))
                                                       ->setBindings([':display' => 1])
                                                       ->where('progress_info.name', 'like', $keyword)
                                                       ->where('progress_info.num', '<=', 1);
                                             })
                                  ->orWhereIn('projects.id', function($query) use ($keyword) {
                                                 $query->select('project_id')
                                                       ->from('project_details')
                                                       ->where('name', 'like', $keyword)
                                                       ->where('display', 1);
                                             })
                                  ->orWhereIn('projects.id', function($query) use ($keyword) {
                                                 $query->select('project_id')
                                                       ->from('project_details')
                                                       ->where('message', 'like', $keyword)
                                                       ->where('display', 1);
                                             });
                        });
        }

        if (array_key_exists('crowd_sourcing_id', $input) && $input['crowd_sourcing_id']) {
            $list->where('projects.crowd_sourcing_id', $input['crowd_sourcing_id']);
        }

        if (array_key_exists('orderer_id', $input) && $input['orderer_id']) {
            $list->where('projects.orderer_id', $input['orderer_id']);
        }

        if (array_key_exists('progress_id', $input) && $input['progress_id']) {
            $subQuery = ProjectProgress::select('project_progresses.project_id',
                                                'project_progresses.progress_id',
                                                DB::raw('row_number() over (partition by project_progresses.project_id order by project_progresses.created_at desc) as num'))
                                       ->from('project_progresses')
                                       ->join('progresses', 'project_progresses.progress_id', '=', 'progresses.id')
                                       ->where('progresses.display', ':display')
                                       ->groupBy('project_progresses.project_id')
                                       ->groupBy('project_progresses.progress_id')
                                       ->toSql();

            $list->WhereIn('projects.id', function($query) use ($input, $subQuery) {
                              $query->select('progress_info.project_id')
                                    ->from(DB::raw('(' . $subQuery . ') as progress_info'))
                                    ->setBindings([':display' => 1])
                                    ->where('progress_info.progress_id', $input['progress_id'])
                                    ->where('progress_info.num', '<=', 1);
                          });
        }

        return $list->select('projects.*', 'crowd_sourcings.name as crowd_sourcing_name', 'orderers.name as orderer_name')
                    ->leftJoin('crowd_sourcings', 'projects.crowd_sourcing_id', '=', 'crowd_sourcings.id')
                    ->leftJoin('orderers', 'projects.orderer_id', '=', 'orderers.id')
                    ->orderByDesc('projects.updated_at')
                    ->paginate(10);
    }

    /**
     * プロジェクト情報の取得
     *
     * @param  int  $id
     * @return array
     */
    public function getById($id)
    {
        Log::debug('ProjectRepository::getById()');

        return $this->model
                    ->select('projects.*', 'crowd_sourcings.name as crowd_sourcing_name', 'orderers.name as orderer_name')
                    ->leftJoin('crowd_sourcings', 'projects.crowd_sourcing_id', '=', 'crowd_sourcings.id')
                    ->leftJoin('orderers', 'projects.orderer_id', '=', 'orderers.id')
                    ->where('projects.display', 1)
                    ->where('crowd_sourcings.display', 1)
                    ->where('orderers.display', 1)
                    ->where('projects.id', $id)
                    ->get()
                    ->toArray();
    }
}
