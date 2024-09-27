<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use Mail;
use App\Mail\TicketOpenMail;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TicketController extends Controller
{
    public function index(){
        return view('admin.ticket.all_ticket');
    }
    public function createTicket(){
        return view('admin.ticket.create_ticket');
    }

    public function store(Request $request){
        
        $notification = array(
            'message' => 'Something Went Wrong!!',
            'alert-type' => 'warning'
        );
       
        DB::beginTransaction();
        try {
            $createTicket = Ticket::insert([
                'subject' => $request->subject,
                'description' => $request->description,
                'created_by'  => Auth::user()->id,
                'created_at' =>  Carbon::now(),
            ]);

            if($createTicket){
                $mailData = [
                    'subject' => $request->subject,
                    'description' => $request->description,
                    'ticket_open_by' => Auth::user()->name
                ];
                
                Mail::to('almahfuz380@gmail.com')->send(new TicketOpenMail($mailData));
            }
            

            $notification = array(
                'message' => 'Ticket Submitted Successfully!!',
                'alert-type' => 'success'
            );
            
            DB::commit();

            return redirect()->route('all.ticket')->with($notification);
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
