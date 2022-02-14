<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * マスターサービス
 */
abstract class MasterService implements BaseServiceInterface
{
    protected $repository;

    /**
     * 新しいインスタンスの生成
     */
    public function __construct()
    {
        Log::debug('MasterService::__construct()');

        $this->getRepository();
    }

    /**
     * リポジトリの取得
     */
    abstract protected function getRepository();

    /**
     * VIEWへ渡す変数にPAGEを追加
     *
     * @param  Illuminate\Http\Request  $request
     * @param  array  $view_with
     * @return array
     */
    private function addPage(Request $request, $view_with = [])
    {
        Log::debug('MasterService::addPage()');

        $page = $request->query('page');
        if ($page &&
           ($request->isMethod('get') ||
           ($request->isMethod('put') && $request->input('display') == '1'))) {
            $view_with['page'] = $page;
        }

        return $view_with;
    }

    /**
     * マスター一覧の取得
     *
     * @param  array  $params
     * @return array
     */
    public function index($params = [])
    {
        Log::debug('MasterService::index()');

        $request = $params[0];

        return $this->addPage($request, [$this->repository->getTableName() => $this->repository->get(['listType' => 'page'])]);
    }

    /**
     * マスターの作成・編集
     *
     * @param  array  $params
     * @return array
     */
    public function createOrEdit($params = [])
    {
        Log::debug('MasterService::createOrEdit()');

        $request = $params[0];
        $id = array_key_exists(1, $params) ? $params[1] : 0;

        if ($id > 0) {
            $master = $this->repository->find($id);
        }

        return $this->addPage($request, isset($master) ? [$this->repository->getModelName() => $master] : []);
    }

    /**
     * マスターの保存・更新
     *
     * @param  array  $params
     * @return array
     */
    public function storeOrUpdate($params = [])
    {
        Log::debug('MasterService::storeOrUpdate()');

        $request = $params[0];
        $id = array_key_exists(1, $params) ? $params[1] : 0;

        if ($id > 0) {
            $this->repository->save($request->all(), $id);
        } else {
            $this->repository->save($request->all());
        }

        return $this->addPage($request);
    }
}
