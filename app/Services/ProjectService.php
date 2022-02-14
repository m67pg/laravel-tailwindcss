<?php

namespace App\Services;

use App\Repositories\CrowdSourcingRepository;
use App\Repositories\OrdererRepository;
use App\Repositories\ProgressRepository;
use App\Repositories\ProjectDetailRepository;
use App\Repositories\ProjectProgressRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * プロジェクトサービス
 */
class ProjectService implements BaseServiceInterface
{
    private $crowdSourcingRepository;
    private $ordererRepository;
    private $progressRepository;
    private $projectProgressRepository;
    private $projectRepository;

    /**
     * 新しいインスタンスの生成
     *
     * @param  App\Repositories\CrowdSourcingRepository  $crowdSourcingRepository
     * @param  App\Repositories\OrdererRepository  $ordererRepository
     * @param  App\Repositories\ProgressRepository  $progressRepository
     * @param  App\Repositories\ProjectDetailRepository  $projectDetailRepository
     * @param  App\Repositories\ProjectProgressRepository  $projectProgressRepository
     * @param  App\Repositories\ProjectRepository  $projectRepository
     * @return void
     */
    public function __construct(CrowdSourcingRepository $crowdSourcingRepository,
                                OrdererRepository $ordererRepository,
                                ProgressRepository $progressRepository,
                                ProjectDetailRepository $projectDetailRepository,
                                ProjectProgressRepository $projectProgressRepository,
                                ProjectRepository $projectRepository)
    {
        Log::debug('ProjectService::__construct()');

        $this->crowdSourcingRepository = $crowdSourcingRepository;
        $this->ordererRepository = $ordererRepository;
        $this->progressRepository = $progressRepository;
        $this->projectDetailRepository = $projectDetailRepository;
        $this->projectProgressRepository = $projectProgressRepository;
        $this->projectRepository = $projectRepository;
    }

    /**
     * プロジェクト一覧の取得
     *
     * @param  array  $params
     * @return array
     */
    public function index($params = [])
    {
        Log::debug('ProjectService::index()');

        $request = $params[0];
        if ($request->has('reset_button')) {
            $request->session()->forget(['keyword', 'crowd_sourcing_id', 'orderer_id', 'progress_id', 'page']);
        } elseif ($request->has('submit_button')) {
            $request->session()->put('keyword', $request->input('keyword'));
            $request->session()->put('crowd_sourcing_id', $request->input('crowd_sourcing_id'));
            $request->session()->put('orderer_id', $request->input('orderer_id'));
            $request->session()->put('progress_id', $request->input('progress_id'));
            $request->session()->forget('page');
        } else {
            $request->session()->forget('page');
        }

        $page = $request->query('page');
        if ($page) {
            $request->session()->put('page', $page);
        }

        $projectInfo = $this->getProjectInfo();
        $projectInfo['projects'] = $this->projectRepository->get($request->session()->all());

        return $projectInfo;
    }

    /**
     * プロジェクトの作成・編集
     *
     * @param  array  $params
     * @return array
     */
    public function createOrEdit($params = [])
    {
        Log::debug('ProjectService::createOrEdit()');

        $id = array_key_exists(0, $params) ? $params[0] : 0;

        $projectInfo = $this->getProjectInfo();
        if ($id > 0) {
            $projectInfo['project'] = $this->projectRepository->find($id);
        }
        $projectInfo['current_progress_id'] = $id > 0 ? $this->projectProgressRepository->current($id) : 0;

        return $projectInfo;
    }

    /**
     * プロジェクトの保存・更新
     *
     * @param  array  $params
     */
    public function storeOrUpdate($params = [])
    {
        Log::debug('ProjectService::storeOrUpdate()');

        DB::transaction(function () use ($params) {
            $request = $params[0];
            $id = array_key_exists(1, $params) ? $params[1] : 0;

            $project = $this->projectRepository->save($request->all(), $id);
            $this->projectProgressRepository->save($request->input('progress_id', 0), $project->id);
        });
    }

    /**
     * プロジェクトの表示
     *
     * @param  array  $params
     */
    public function show($params = [])
    {
        Log::debug('ProjectService::show()');

        $id = array_key_exists(0, $params) ? $params[0] : 0;

        if ($id > 0) {
            $projectInfo['project'] = $this->projectRepository->getById($id);

            if (array_key_exists(0, $projectInfo['project'])) {
                $projectInfo['project'] = $projectInfo['project'][0];
                $current_progress_id = $this->projectProgressRepository->current($id);
                $projectInfo['current_progress'] = $this->progressRepository->find($current_progress_id);
                $projectInfo['project_progresses'] = $this->projectProgressRepository->all($id);
                $projectInfo['project_details'] = $this->projectDetailRepository->get(['project_id' => $id, 'order_by' => 'asc']);
            } else {
                unset($projectInfo['project']);
            }
        }

        return $projectInfo;
    }

    /**
     * 選択一覧の取得
     *
     * @return array
     */
    private function getProjectInfo() {
        $projectInfo = array();
        $projectInfo['crowd_sourcings'] = $this->crowdSourcingRepository->get();
        $projectInfo['orderers'] = $this->ordererRepository->get();
        $projectInfo['progresses'] = $this->progressRepository->get();

        return $projectInfo;
    }

}
