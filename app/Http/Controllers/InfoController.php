<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfoController extends Controller
{
    public function serverInfo() // Функция, которая возвращает пользователю данные о версии PHP
    {
        return response()->json(['php_version' => phpversion()]);
    }

    public function clientInfo(Request $request)// Функция, которая возвращает пользователю данные о клиенте
    {
        return response()->json([
            'ip' => $request->ip(),
            'user_agent' => $request->header('User-Agent')
        ]);
    }

    public function databaseInfo()// Функция, которая возвращает пользователю данные о используемой базе данных
    {
        $dbConnection = DB::connection()->getPdo();
        $dbName = $dbConnection->query('PRAGMA database_list')->fetchAll();
        return response()->json([
            'database' => $dbName
        ]);
    }
}
                 
