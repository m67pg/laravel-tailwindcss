<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgressRequest;
use App\Services\ProgressService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * 進捗コントローラー
 */
class ProgressController extends Controller
{
    private $service;

    /**
     * 新しいインスタンスの生成
     *
     * @param  App\Services\ProgressService $service
     * @return void
     */
    public function __construct(ProgressService $service)
    {
        Log::debug('ProgressController::__construct()');

        $this->service = $service;
    }

    /**
     * 進捗一覧
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Log::debug('ProgressController::index()');

        return view('progress.index', $this->service->index([$request]));
    }

    /**
     * 進捗作成
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Log::debug('ProgressController::create()');

        return view('progress.create', $this->service->createOrEdit([$request]));
    }

    /**
     * 進捗保存
     *
     * @param  App\Http\Requests\ProgressRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(ProgressRequest $request)
    {
        Log::debug('ProgressController::store()');

        return redirect()->route('progress.index', $this->service->storeOrUpdate([$request]))->with('success', '進捗の保存が完了しました。');
    }

    /**
     * 進捗編集
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        Log::debug('ProgressController::edit()');

        return view('progress.edit', $this->service->createOrEdit([$request, $id]));
    }

    /**
     * 進捗更新
     *
     * @param  App\Http\Requests\ProgressRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(ProgressRequest $request, $id)
    {
        Log::debug('ProgressController::update()');

        return redirect()->route('progress.index', $this->service->storeOrUpdate([$request, $id]))->with('success', '進捗の更新が完了しました。');
    }
}
