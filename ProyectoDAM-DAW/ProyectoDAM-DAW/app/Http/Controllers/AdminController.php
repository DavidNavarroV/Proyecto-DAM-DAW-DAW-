<?php
namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.index');
    }
    public function acercade()
    {
        return view('admin.acerca-de');
    }
    public function inicio()
    {
        return view('admin.acerca-de');
    }
}
