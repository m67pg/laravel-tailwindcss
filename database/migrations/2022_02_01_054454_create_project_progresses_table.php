<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * プロジェクト進捗テーブル
 */
class CreateProjectProgressesTable extends Migration
{
    /**
     * マイグレーションの実行
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_progresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id')->comment('プロジェクトID');
            $table->unsignedBigInteger('progress_id')->comment('進捗ID');
            $table->timestamps();
        });
    }

    /**
     * マイグレーションを戻す
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_progresses');
    }
}
