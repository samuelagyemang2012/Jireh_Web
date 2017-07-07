<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Log extends Model
{
    public function insert($message, $done_by, $role)
    {
        DB::table('logs')->insert(
            ['message' => $message,
                'done_by' => $done_by,
                'role' => $role,
            ]
        );
    }

    public function get_client_logs()
    {
        return DB::table('logs')
            ->where('role', '=', 'client')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function get_admin_logs()
    {
        return DB::table('logs')
            ->where('role', '=', 'admin')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
