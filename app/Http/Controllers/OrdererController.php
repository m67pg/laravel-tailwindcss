<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrdererRequest;
use App\Services\OrdererService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * 発注者コントローラー
 */
class OrdererController extends Controller
{
    private $service;

    /**
     * 新しいインスタンスの生成
     *
     * @param  App\Services\OrdererService $service
     * @return void
     */
    public function __construct(OrdererService $service)
    {
        Log::debug('OrdererController::__construct()');

        $this->service = $service;
    }

    /**
     * 発注者一覧
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Log::debug('OrdererController::index()');

        return view('orderer.index', $this->service->index([$request]));
    }

    /**
     * 発注者作成
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Log::debug('OrdererController::create()');

        return view('orderer.create', $this->service->createOrEdit([$request]));
    }

    /**
     * 発注者保存
     *
     * @param  App\Http\Requests\OrdererRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(OrdererRequest $request)
    {
        Log::debug('OrdererController::store()');

        return redirect()->route('orderer.index', $this->service->storeOrUpdate([$request]))->with('success', '発注者の保存が完了しました。');
    }

    /**
     * 発注者編集
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        Log::debug('OrdererController::edit()');

        return view('orderer.edit', $this->service->createOrEdit([$request, $id]));
    }

    /**
     * 発注者更新
     *
     * @param  App\Http\Requests\OrdererRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(OrdererRequest $request, $id)
    {
        Log::debug('OrdererController::update()');

        return redirect()->route('orderer.index', $this->service->storeOrUpdate([$request, $id]))->with('success', '発注者の更新が完了しました。');
    }
}
