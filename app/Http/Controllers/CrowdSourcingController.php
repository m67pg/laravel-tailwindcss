<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrowdSourcingRequest;
use App\Services\CrowdSourcingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * クラウドソーシングコントローラー
 */
class CrowdSourcingController extends Controller
{
    private $service;

    /**
     * 新しいインスタンスの生成
     *
     * @param  App\Services\CrowdSourcingService $service
     * @return void
     */
    public function __construct(CrowdSourcingService $service)
    {
        Log::debug('CrowdSourcingController::__construct()');

        $this->service = $service;
    }

    /**
     * クラウドソーシング一覧
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Log::debug('CrowdSourcingController::index()');

        return view('crowd_sourcing.index', $this->service->index([$request]));
    }

    /**
     * クラウドソーシング作成
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Log::debug('CrowdSourcingController::create()');

        return view('crowd_sourcing.create', $this->service->createOrEdit([$request]));
    }

    /**
     * クラウドソーシング保存
     *
     * @param  App\Http\Requests\CrowdSourcingRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(CrowdSourcingRequest $request)
    {
        Log::debug('CrowdSourcingController::store()');

        return redirect()->route('crowd_sourcing.index', $this->service->storeOrUpdate([$request]))->with('success', 'クラウドソーシングの保存が完了しました。');
    }

    /**
     * クラウドソーシング編集
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        Log::debug('CrowdSourcingController::edit()');

        return view('crowd_sourcing.edit', $this->service->createOrEdit([$request, $id]));
    }

    /**
     * クラウドソーシング更新
     *
     * @param  App\Http\Requests\CrowdSourcingRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(CrowdSourcingRequest $request, $id)
    {
        Log::debug('CrowdSourcingController::update()');

        return redirect()->route('crowd_sourcing.index', $this->service->storeOrUpdate([$request, $id]))->with('success', 'クラウドソーシングの更新が完了しました。');
    }
}
