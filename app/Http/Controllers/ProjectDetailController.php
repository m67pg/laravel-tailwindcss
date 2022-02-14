<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectDetailRequest;
use App\Services\ProjectDetailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * プロジェクト詳細コントローラー
 */
class ProjectDetailController extends Controller
{
    private $service;

    /**
     * 新しいインスタンスの生成
     *
     * @param  App\Services\ProjectDetailService $service
     * @return void
     */
    public function __construct(ProjectDetailService $service)
    {
        Log::debug('ProjectDetailController::__construct()');

        $this->service = $service;
    }

    /**
     * プロジェクト詳細一覧
     *
     * @param  int  $project_id
     * @return Illuminate\Http\Response
     */
    public function index($project_id)
    {
        Log::debug('ProjectDetailController::index()');

        $projectDetailInfo = $this->service->index([$project_id]);
        return view('project_detail.index', compact('projectDetailInfo'));
    }

    /**
     * プロジェクト詳細作成
     *
     * @param  int  $project_id
     * @return Illuminate\Http\Response
     */
    public function create($project_id)
    {
        Log::debug('ProjectDetailController::create()');

        $projectDetailInfo = $this->service->createOrEdit([$project_id]);
        return view('project_detail.create', compact('projectDetailInfo'));
    }

    /**
     * プロジェクト詳細保存
     *
     * @param  App\Http\Requests\ProjectDetailRequest  $request
     * @param  int  $project_id
     * @return Illuminate\Http\Response
     */
    public function store(ProjectDetailRequest $request, $project_id)
    {
        Log::debug('ProjectDetailController::store()');

        $this->service->storeOrUpdate([$request->merge(['project_id' => $project_id])]);
        return redirect()->route('project_detail.index', ['project_id' => $project_id])->with('success', 'プロジェクト詳細の保存が完了しました。');
    }

    /**
     * プロジェクト詳細編集
     *
     * @param  int  $project_id
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function edit($project_id, $id)
    {
        Log::debug('ProjectDetailController::edit()');

        $projectDetailInfo = $this->service->createOrEdit([$project_id, $id]);
        return view('project_detail.edit', compact('projectDetailInfo'));
    }

    /**
     * プロジェクト詳細更新
     *
     * @param  App\Http\Requests\ProjectDetailRequest  $request
     * @param  int  $project_id
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(ProjectDetailRequest $request, $project_id, $id)
    {
        Log::debug('ProjectDetailController::update()');

        $this->service->storeOrUpdate([$request, $id]);
        return redirect()->route('project_detail.index', ['project_id' => $project_id])->with('success', 'プロジェクト詳細の更新が完了しました。');
    }
}
