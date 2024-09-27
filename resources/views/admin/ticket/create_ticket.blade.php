@extends('admin.layout')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>Add New</strong> Ticket</h3>
            </div>

            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{ route('all.ticket') }}" class="btn btn-primary">All Tickets</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    <div class="card-body">
                        <form method="POST" action="{{ route('store.ticket') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="subject">Ticket Subject</label>
                                <input type="text" class="form-control" id="subject" placeholder="Add Ticket Subject" name="subject" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" placeholder="Ticket Description" name="description" rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection