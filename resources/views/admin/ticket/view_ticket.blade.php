@extends('admin.layout')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>View</strong> Ticket</h3>
            </div>

            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{ route('all.ticket') }}" class="btn btn-primary">All Tickets</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{$ticketInfo->subject??''}}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{$ticketInfo->description??''}}</p>
                        <a href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseOne" class="collapsed btn btn-primary">
                            Send your response
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                            <div class="card-body">
                                <form method="POST" action="{{ route('store.response') }}">
                                    @csrf
                                    <input type="hidden" name="ticket_id" value="{{$ticketInfo->id}}">
                                    <div class="mb-3">
                                        <label class="form-label" for="comment">Comment</label>
                                        <input type="text" class="form-control" id="comment" placeholder="Add your response" name="comment" autocomplete="off">                                   
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Ticket Responses</h5>
                    </div>
                    <div class="card-body h-100">
                        @foreach ($ticketInfo->comments as $response)
                            <div class="d-flex align-items-start">
                                <img src="{{asset('asset/backend/img/avatars/avatar-2.jpg')}}" width="36" height="36" class="rounded-circle me-2" alt="img">
                                <div class="flex-grow-1">
                                    {{-- <small class="float-end text-navy">30m ago</small> --}}
                                    <strong>{{ $response->user->name }}'s</strong> response<br>
                                    {{-- <small class="text-muted">Today 7:21 pm</small> --}}

                                    <div class="border text-sm text-muted p-2 mt-1">
                                        {{ $response->comment??'' }}
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection