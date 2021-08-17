@extends('standard.layout')

@section('content')


<div id="content" class="main-content">
    @if ($message = Session::get('destroy'))
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>{{$message}}</strong> 
        </div>
    @endif
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>{{$message}}</strong> 
        </div>
    @endif
    @if (count($errors) > 0)
        <div class = "alert alert-danger fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing" id="cancel-row">
                    <div class="col-xl-12 col-lg-12 col-smf-12  layout-spacing skills">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <div id="multi-column-ordering_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <form action="{{ route('admin.setting.update')}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h4>Setting</h4>
                                                <div class="row">
                                                    <div class="col-md-6 mt-4">
                                                        <p>Name</p>
                                                        <input type="text" name="name" class="form-control" value="{{$user->name}}" placeholder="Name" required>
                                                    </div>
                                                    <div class="col-md-6 mt-4">
                                                        <p>Slam Username</p>
                                                        <input type="text" name="slam_name" class="form-control" value="{{$user->slam_name}}" placeholder="Slam Username" required>
                                                    </div>
                                                    
                                                    <div class="col-md-6 mt-4">
                                                        <p>Email</p>
                                                        <input type="email" name="email" class="form-control" value="{{$user->email}}" placeholder="Email" required>
                                                    </div>

                                                    <div class="col-md-6 mt-4">
                                                        <p>Telegram Username</p>
                                                        <input type="text" name="tg_name" class="form-control" value="{{$user->tg_name}}" placeholder="Telegram Username" required>
                                                    </div>
                                                    <div class="col-md-6 mt-4">
                                                        <p>Phone number</p>
                                                        <input type="text" name="phone" class="form-control" value="{{$user->phone}}" placeholder="Phone" required>
                                                    </div>
                                                    
                                                    <div class="col-md-6 mt-4">
                                                        <p>New password</p>
                                                        <input type="password" name="npass" class="form-control"  placeholder="New password">
                                                    </div>

                                                    <div class="col-md-6 mt-4">
                                                        <p>Wallet address</p>
                                                        <input type="text" name="address" class="form-control" value="{{$user->address}}" placeholder="Wallet address" required>
                                                    </div>
                                                    
                                                    <div class="col-md-6 mt-4">
                                                        <p>Confirm password</p>
                                                        <input type="password" name="cpass" class="form-control" placeholder="Confirm password">
                                                    </div>
                                                    
                                                    <div class="col-md-12 mt-4" style="text-align: right;">
                                                        <button class="btn btn-primary" type="submit">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    
                </div>
                <div class="footer-section f-section-2">
                
                </div>
            </div>
        </div>


@endsection