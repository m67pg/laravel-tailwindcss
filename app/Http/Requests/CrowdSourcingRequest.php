<?php

namespace App\Http\Requests;

use App\Repositories\CrowdSourcingRepository;
use Illuminate\Foundation\Http\FormRequest;

/**
 * クラウドソーシングフォームリクエスト
 */
class CrowdSourcingRequest extends FormRequest
{
    private $repository;

    /**
     * 新しいインスタンスの生成
     *
     * @param  App\Repositories\CrowdSourcingRepository $repository
     * @return void
     */
    public function __construct(CrowdSourcingRepository $repository)
    {
        $this->repository = $repository;
    }

   /**
     * ユーザーがこのリクエストの権限を持っているかを判断する
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * リクエストに適用するバリデーションルールを取得
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:128|unique:crowd_sourcings,name',
            'sort_order' => 'required|integer|min:0|max:255',
        ];

        if ($this->method() === 'PUT') {
            $crowd_sourcing = $this->repository->find($this->route('crowd_sourcing'));
            if ($crowd_sourcing->name == $this->input('name')) {
                $rules['name'] = 'required|max:128';
            }
        }

        return $rules;
    }

    /**
     * バリデーションエラーのカスタム属性の取得
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => '名前',
            'sort_order' => '並び順',
        ];
    }
}
