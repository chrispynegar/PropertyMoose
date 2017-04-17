<?php

namespace App\Controllers;

use App\Libraries\Output;
use App\Models\Opportunity;

class Opportunities extends Controller
{
    /**
     * Lookup the latest Opportunities.
     *
     * @return string
     */
    public function index()
    {
        $opportunities = Opportunity::get();
        return Output::cli()->json([
            'current_opportunities' => $opportunities
        ]);
    }
}
