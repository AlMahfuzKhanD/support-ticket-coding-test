@extends('admin.layout')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>All</strong> Tickets</h3>
            </div>
            @if ($ticketStatus == '0' && $userInfo->role != 'admin')
            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{ route('create.ticket') }}" class="btn btn-primary">Create a New Ticket</a>
            </div> 
            @endif
            
        </div>
        <div class="row">
            <div class="col-12">
                
                <div class="card">                    
                    <div class="card-body">
                        <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->subject??''}}</td>
                                    <td>
                                        @if ($ticket->status == 'open')
                                        <span class="badge rounded-pill bg-success">Open</span>
                                        @else
                                        <span class="badge rounded-pill bg-danger">Closed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('view.ticket',$ticket->id) }}" class="btn btn-pill btn-warning" title="details"> <i data-feather="eye"></i></a>
                                        @if ($ticket->status == 'open' && Auth::user()->role == 'admin')
                                        <a href="{{ route('close.ticket',$ticket->id) }}" class="btn btn-pill btn-danger"> Close</a>
                                        @endif
                                        {{-- <a href="{{ route('delete.agent.property',$ticket) }}"  class="btn btn-inverse-danger" id="delete">Delete</a> --}}
                                    </td>
                                </tr>
                                @endforeach
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection