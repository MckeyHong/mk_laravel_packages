<?php

namespace App\Http\Controllers;

use Brotzka\DotenvEditor\DotenvEditor;
use Brotzka\DotenvEditor\Exceptions\DotEnvException;

class EnvController extends Controller
{
    public function index()
    {
        $env = new DotenvEditor();
        //檢查是否此變數是否存在，不存在則新增
        if (!$env->keyExists("TESTKEY")) {
            $env->addData(['TESTKEY' => 'testvalue']);
        }

        //修改變數數值
        $env->changeEnv(['APP_ENV' => 'local']);

        //刪除變數數值
        $env->deleteData(['TESTKEY']);

        //取變數數值(用法同env('APP_ENV'))
        $value = $env->getValue("APP_ENV");

        return response()->json([
            'result'   => true,
            'env path' => $env->getBackupPath(),
            'APP_ENV'  => $value
        ]);
    }
}
