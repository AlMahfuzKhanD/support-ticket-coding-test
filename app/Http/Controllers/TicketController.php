<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Ticket;
use App\Mail\TicketOpenMail;
use App\Mail\TicketCloseMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TicketController extends Controller
{
    public function index(){
        $userInfo = Auth::user();
        $ticketStatus = User::where('id',$userInfo->id)->first()->has_open_ticket;
        $tickets = [];
        if($userInfo->role == 'admin'){
            $tickets = Ticket::all();
        }else{            
            $tickets = Ticket::where('created_by',$userInfo->id)->get();
        }
        return view('admin.ticket.all_ticket',compact('tickets','ticketStatus','userInfo'));
    }
    public function createTicket(){
        if(Auth::user()->role != 'admin'){
            return view('admin.ticket.create_ticket');
        }else{
            $notification = array(
                'message' => 'Only Customer Can Create Ticket!!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        
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
                $userInfo = Auth::user();
                User::where('id',$userInfo->id)->update([
                    'has_open_ticket' => '1'
                ]);
                $receiverEmail = User::where('role','admin')->first()->email;
                $mailData = [
                    'subject' => $request->subject,
                    'description' => $request->description,
                    'ticket_open_by' => $userInfo->name
                ];
                
                Mail::to($receiverEmail)->send(new TicketOpenMail($mailData));
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

    public function closeTicket($id){
        $notification = array(
            'message' => 'Something Went Wrong!!',
            'alert-type' => 'warning'
        );
       
        DB::beginTransaction();
        try {
            $ticket = Ticket::where('id',$id)->first();
            $ticket->update([
                'status' => 'closed'
            ]);
            $userInfo = User::where('id',$ticket->created_by)->first();
            $userInfo->update([
                'has_open_ticket' => '0'
            ]);
            
            $receiverEmail = $userInfo->email;
            $mailData = [
                'subject' => $ticket->subject,
                'description' => $ticket->description,
                'ticket_close_by' => Auth::user()->name
            ];
                
            Mail::to($receiverEmail)->send(new TicketCloseMail($mailData));
            

            $notification = array(
                'message' => 'Ticket Closed Successfully!!',
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
