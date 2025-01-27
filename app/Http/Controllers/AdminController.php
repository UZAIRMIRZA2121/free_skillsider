<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function dashboard()
   {
    return view('admin.dashboard');
   }
   public function leaderboard()
   {
    return view('admin.leaderboard');
   }
   public function team()
   {
    return view('admin.team');
   }
   public function certificate()
   {
    return view('admin.certificate');
   }
   public function affilate_training()
   {
    return view('admin.affilate_training');
   }
   public function faq()
   {
    return view('admin.faq');
   }
   public function community()
   {
    return view('admin.community');
   }
  
  
}
