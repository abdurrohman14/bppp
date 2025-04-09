<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function admin() {
        return view('partials.adminDashboard');
    }
    public function petugasKolam() {
        return view('partials.petugasKolamDashboard');
    }
    public function manajer() {
        return view('partials.manajerDashboard');
    }
}
