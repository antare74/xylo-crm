@extends('layouts.app')
@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ADD NEW AGENT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="POST" action="{{ route('customer.store') }}">
                            @csrf
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="{{ __('Name') }}" type="text" name="name" required autofocus>
                                </div>
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="{{ __('Phone') }}" type="text" name="phone" required autofocus>
                                </div>
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-user-run"></i></span>
                                    </div>
                                    <select id="inputState" class="form-control" name="agent" required autofocus>
                                        <option value="" selected disabled>Select Agent</option>
                                        @if(count($users) > 0)
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-bold-down"></i></span>
                                    </div>
                                    <select id="inputState" class="form-control" name="status" required autofocus>
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="waiting" >waiting</option>
                                        <option value="follow up">follow up</option>
                                        <option value="done">done</option>
                                    </select>
                                </div>
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-mail-bulk"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="{{ __('Email') }}" type="text" name="email" required autofocus>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">CONTACT LIST
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btnCreate btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">
                                New Contact
                            </button>
                        </h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">No</th>
                                <th scope="col" class="sort" data-sort="name">Name</th>
                                <th scope="col" class="sort" data-sort="budget">Email</th>
                                <th scope="col" class="sort" data-sort="verification">Phone</th>
                                <th scope="col" class="sort" data-sort="agent">Agent</th>
                                <th scope="col" class="sort" data-sort="status">Status</th>
                                <th scope="col" class="sort" data-sort="action">Action</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @if(count($customers) > 0)
                                @foreach($customers as $no => $customer)
                                    <tr>
                                        <td>{{ $no+1 }}</td>
                                        <td id="{{ 'name'.$customer->id }}">{{ $customer->name }}</td>
                                        <td id="{{ 'email'.$customer->id }}">{{ $customer->email }}</td>
                                        <td id="{{ 'phone'.$customer->id }}">
                                            <a href="" target="_blank">
                                                {{ $customer->phone }}
                                                <i class="fas fa-facebook-messenger"></i>
                                            </a>
                                        </td>
                                        <td>
                                            {{ $customer->status->user->name }}
                                        </td>
                                        <td>
                                            {{ $customer->status->status }}
                                        </td>
{{--                                        <td>{{ !is_null($customers->email_verified_at)?'VERIFIED':'NOT VERIFIED' }}</td>--}}
{{--                                        <td>{{ !is_null($customers->role)?strtoupper($user->role):'UNKNOWN' }}</td>--}}
                                        <td>
                                            <button id="{{ $customer->id }}" class="btn editBtn btn-sm btn-warning">EDIT</button>
                                            <a href="{{ url('customer/delete/'.$customer->id) }}"  class="btn btnDelete btn-sm btn-danger">DELETE</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer py-4">
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">
                                        <i class="fas fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('layouts.footers.auth')
    </div>

@endsection
@push('js')
    <script>
        $('.editBtn').click(function (){
            $('.btnCreate').click();
            let id = $(this).attr('id');
            var name = $("#name"+id).text();
            var phone = $("#phone"+id).text();
            var email = $("#email"+id).text();
            var updateUrl = window.location.origin + '/customer/' + id
            $('input[name=name]').val(name)
            $('input[name=phone]').val(phone)
            $('input[name=email]').val(email)
            $('form[role=form]').attr('action', updateUrl)
        })
        $(".btnDelete").click(function (){
            if(confirm("Are you sure you want to delete this?")){
                console.log('delete')
            }else{
                return false;
            }
        })
    </script>
    {{--    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>--}}
    {{--    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>--}}
@endpush
