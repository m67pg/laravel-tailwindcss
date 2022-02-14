<?php

namespace App\Services;

use App\Repositories\ProjectDetailRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * プロジェクト詳細サービス
 */
class ProjectDetailService implements BaseServiceInterface
{
    private $projectDetailRepository;

    /**
     * 新しいインスタンスの生成
     *
     * @param  App\Repositories\ProjectDetailRepository  $projectDetailRepository
     * @return void
     */
    public function __construct(ProjectDetailRepository $projectDetailRepository)
    {
        Log::debug('ProjectDetailService::__construct()');

        $this->projectDetailRepository = $projectDetailRepository;
    }

    /**
     * プロジェクト詳細一覧の取得
     *
     * @param  array  $params
     * @return array
     */
    public function index($params = [])
    {
        Log::debug('ProjectDetailService::index()');

        $project_id = $params[0];

        $projectDetailInfo = array();
        $projectDetailInfo['project_id'] = $project_id;
        $projectDetailInfo['project_details'] = $this->projectDetailRepository->get(['project_id' => $project_id]);
        return $projectDetailInfo;
    }

    /**
     * プロジェクト詳細の作成・編集
     *
     * @param  array  $params
     * @return array
     */
    public function createOrEdit($params = [])
    {
        Log::debug('ProjectDetailService::createOrEdit()');

        $project_id = $params[0];
        $id = array_key_exists(1, $params) ? $params[1] : 0;

        $projectDetailInfo = array();
        $projectDetailInfo['project_id'] = $project_id;
        if ($id > 0) {
            $projectDetailInfo['project_detail'] = $this->projectDetailRepository->find($id);
        }
        return $projectDetailInfo;
    }

    /**
     * プロジェクト詳細の保存・更新
     *
     * @param  array  $params
     */
    public function storeOrUpdate($params = [])
    {
        Log::debug('ProjectDetailService::storeOrUpdate()');

        DB::transaction(function () use ($params) {
            $request = $params[0];
            $id = array_key_exists(1, $params) ? $params[1] : 0;

            if ($request->has('delete_button')) {
                $projectDetail = $this->projectDetailRepository->find($id);
                $file_name = $projectDetail->id . '-' . $projectDetail->upload_file;
                $projectDetail->upload_file = null;
                $projectDetail->save();

                Storage::delete('public/' . $file_name);
            } else {
                $projectDetail = $this->projectDetailRepository->save($request->all(), $id);
                if ($request->file('upload_file')) {
                    $projectDetail->upload_file = $request->file('upload_file')->getClientOriginalName();
                    $projectDetail->save();

                    $request->file('upload_file')->storeAs('public', $projectDetail->id . '-' . $projectDetail->upload_file);
                }
            }
        });
    }
}
