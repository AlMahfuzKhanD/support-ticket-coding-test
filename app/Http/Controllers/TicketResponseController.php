<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TicketResponse;
use Illuminate\Support\Facades\Auth;

class TicketResponseController extends Controller
{
    public function store(Request $request){
        
        $notification = array(
            'message' => 'Something Went Wrong!!',
            'alert-type' => 'warning'
        );
       
        DB::beginTransaction();
        try {
            
            $ticketId = $request->ticket_id;
            $createComment = TicketResponse::insert([
                'comment' => $request->comment,
                'user_id'  => Auth::user()->id,
                'ticket_id'  => $ticketId,
                'created_at' =>  Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Your response Submitted Successfully!!',
                'alert-type' => 'success'
            );
            
            DB::commit();

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            $message = $e->getMessage();
            $notification = array(
                'message' => $message,
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
