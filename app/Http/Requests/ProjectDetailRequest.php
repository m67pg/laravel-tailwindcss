<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * プロジェクト詳細リクエスト
 */
class ProjectDetailRequest extends FormRequest
{
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
        return [
            'name' => 'required|max:1024',
            'message' => 'required',
            'upload_file' => 'max:1024',
            'sort_order' => 'required|integer|min:0|max:255',
        ];
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
            'message' => 'メッセージ',
            'upload_file' => 'アップロードファイル',
            'sort_order' => '並び順',
        ];
    }
}
