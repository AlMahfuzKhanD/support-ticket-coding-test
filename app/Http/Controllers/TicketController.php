<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(){
        return view('admin.ticket.all_ticket');
    }
    public function createTicket(){
        return view('admin.ticket.create_ticket');
    }

    public function store(Request $request){
        dd($request->all());
        $notification = array(
            'message' => 'Something Went Wrong!!',
            'alert-type' => 'warning'
        );

        DB::beginTransaction();
        try {

            Ticket::insert([
                    'title' => $request->title,
                    'description' => $request->description,
                    'created_at' =>  Carbon::now(),
                ]);

            $notification = array(
                'message' => 'Ticket Submitted Sucessfully!!',
                'alert-type' => 'success'
            );

            DB::commit();

            return redirect()->route('all.what_i_do')->with($notification);
        } catch (\Exception $e) {
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
