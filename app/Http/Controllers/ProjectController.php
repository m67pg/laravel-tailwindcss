<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * プロジェクトコントローラー
 */
class ProjectController extends Controller
{
    private $service;

    /**
     * 新しいインスタンスの生成
     *
     * @param  App\Repositories\ProjectService  $service
     * @return void
     */
    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }

    /**
     * プロジェクト一覧
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Log::debug('ProjectController::index()');

        $projectInfo = $this->service->index([$request]);
        return view('project.index', compact('projectInfo'));
    }

    /**
     * プロジェクト作成
     *
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        Log::debug('ProjectController::create()');

        $projectInfo = $this->service->createOrEdit();
        return view('project.create', compact('projectInfo'));
    }

    /**
     * プロジェクト保存
     *
     * @param  App\Http\Requests\ProjectRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        Log::debug('ProjectController::store()');

        $this->service->storeOrUpdate([$request]);

        $page = $request->session()->has('page') ? ['page' => $request->session()->get('page')] : [];
        return redirect()->route('project.index', $page)->with('success', 'プロジェクトの保存が完了しました。');
    }

    /**
     * プロジェクト編集
     *
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function edit($id)
    {
        Log::debug('ProjectController::edit()');

        $projectInfo = $this->service->createOrEdit([$id]);
        return view('project.edit', compact('projectInfo'));
    }

    /**
     * プロジェクト更新
     *
     * @param  App\Http\Requests\ProjectRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        Log::debug('ProjectController::update()');

        $this->service->storeOrUpdate([$request, $id]);

        $page = $request->session()->has('page') ? ['page' => $request->session()->get('page')] : [];
        return redirect()->route('project.index', $page)->with('success', 'プロジェクトの更新が完了しました。');
    }

    /**
     * プロジェクト情報の表示
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        Log::debug('ProjectController::show()');

        $projectInfo = $this->service->show([$id]);

        if (array_key_exists('project', $projectInfo)) {
            return view('project.show', compact('projectInfo'));
        } else {
            $page = $request->session()->has('page') ? ['page' => $request->session()->get('page')] : [];
            return redirect()->route('project.index', $page);
        }
    }
}
