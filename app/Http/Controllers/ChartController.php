<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\User;
use App\Models\Bill;
use Illuminate\Http\Request;
use DB;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function revenue(){
      $revenues=Order::select(Order::raw('extract(month from "created_at") as month'),Order::raw('SUM(price) as sum'))
      ->whereYear('created_at', date('Y'))
      ->where('type',3)
      ->groupBy('month')->get(); 
      $revenuePerMonth=[0,0,0,0,0,0,0,0,0,0,0,0];
      foreach($revenues as $revenue){
      for($i=1;$i<=12;$i++){
        if($i==$revenue["month"]){
          $revenuePerMonth[$i-1]=$revenue["sum"];
        }
      } 
      }   
      return $revenuePerMonth;
}
    public function index(Request $request)
    {
            $post=Order::select(Order::raw('extract(month from "created_at") as month'),Order::raw('COUNT(id) as sum'))
            ->whereYear('created_at', date('Y'))
            ->where('type',1)
            ->orWhere('type',2)
            ->orWhere('type',3)
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
public function getYear($year){
    return $year-now()->year;
}
    public function getLineUser(Request $request){
            $user=User::select(User::raw('extract(month from "created_at") as month'),User::raw('COUNT(id) as sum'))
            ->whereYear('created_at', date('Y'))
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
