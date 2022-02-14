<?php

namespace App\Services;

/**
 * ベースサービスインターフェイス
 */
interface BaseServiceInterface
{
    public function index($params = []);
    public function createOrEdit($params = []);
    public function storeOrUpdate($params = []);
}
