<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $post=Order::select(Order::raw('MONTH(created_at) as month'),Order::raw('COUNT(id) as sum'))
            ->whereYear('created_at', now()->year)
            ->groupBy('month')->get(); 
            $postmonth=[0,0,0,0,0,0,0,0,0,0,0,0];
            foreach($post as $post){
            for($i=1;$i<=12;$i++){
              if($i==$post["month"]){
                $postmonth[$i-1]=$post["sum"];
              }
            } 
            }   
            return $postmonth;
    }

    public function getLineUser(){
      
            $user=User::select(User::raw('MONTH(created_at) as month'),User::raw('COUNT(id) as sum'))
            ->whereYear('created_at', now()->year)
            ->where('id_role', 1)
            ->orWhere('id_role', 2)
            ->groupBy('month')->get();   
            $user_month = array(0,0,0,0,0,0,0,0,0,0,0,0);
            foreach($user as $user){
            for($i=1;$i<=12;$i++){
              if($i==$user["month"]){
                $user_month[$i-1]=$user["sum"];
              }
            } 
            }   
            return $user_month;
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
