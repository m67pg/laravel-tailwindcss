<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 進捗テーブル
 */
class CreateProgressesTable extends Migration
{
    /**
     * マイグレーションの実行
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progresses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->comment('名前');
            $table->tinyInteger('sort_order')->unsigned()->comment('並び順');
            $table->boolean('display')->default(1)->comment('表示 / 非表示');
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
        Schema::dropIfExists('progresses');
    }
}
