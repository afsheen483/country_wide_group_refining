<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        try {
            return view('admin.dashboard');

        } catch (\Exception $e) {
            //throw $th;
             return $e->getMessage();
        }catch (\Throwable $ex) {
            return $ex->getMessage();
         }
    }
}
