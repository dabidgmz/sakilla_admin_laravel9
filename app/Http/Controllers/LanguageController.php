<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index(){
        $perPage = 5;
        $query = Language::query();
        $languages = $query->paginate($perPage);

        return view("Languages",compact("languages"));
    }
}
