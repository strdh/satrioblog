<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    public function index()
    {
        return view('writer.index');
    }
}
