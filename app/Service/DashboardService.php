<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;

class DashboardService
{
    /**
     * Create a new class instance.
     */
    public function getCategoryStats($userId)
    {
        return DB::table('registrations')
          ->join('events', 'registrations.event_id', '=', 'events.event_id')
          ->join('categories', 'events.category_id', '=' ,'categories.category_id')
          ->select('categories.category_name', DB::raw('count(*) as total')
          )
          ->where('registrations.user_id', $userId)
          ->groupBy('categories.category_name')
          ->get();
    }
}
