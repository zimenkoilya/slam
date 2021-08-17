@extends('standard.layout')

@section('content')


<div id="content" class="main-content">
    @if ($message = Session::get('destroy'))
        <div class="alert alert-success alert-dismissible fade show">
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
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing" id="cancel-row">
                    <div class="col-xl-12 col-lg-12 col-smf-12  layout-spacing skills">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <div id="multi-column-ordering_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="multi-column-ordering" class="table table-hover dataTable" style="width: 100%;" role="grid" aria-describedby="multi-column-ordering_info">
                                                <h3>User Data</h3>
                                                <br>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 text-md-right">
                                                        {{-- <a href="{{route('admin.create')}}" class="btn btn-primary" style="width:10%;">Create User</a> --}}
                                                    </div>
                                                </div>
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc" tabindex="0" aria-controls="multi-column-ordering" rowspan="1" colspan="1" aria-sort="ascending">Phone</th>
                                                        <th class="sorting" tabindex="0" aria-controls="multi-column-ordering" rowspan="1" colspan="1">Email</th>
                                                        <th class="sorting" tabindex="0" aria-controls="multi-column-ordering" rowspan="1" colspan="1">Affiliation count</th>
                                                        <th class="sorting" tabindex="0" aria-controls="multi-column-ordering" rowspan="1" colspan="1">Exchage Amount</th>
                                                        <th class="sorting" tabindex="0" aria-controls="multi-column-ordering" rowspan="1" colspan="1">Send</th>
                                                        <th class="sorting" tabindex="0" aria-controls="multi-column-ordering" rowspan="1" colspan="1">Profile</th>
                                                        <th class="sorting" tabindex="0" aria-controls="multi-column-ordering" rowspan="1" colspan="1">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($users as $temp)
                                                    <tr role="row">
                                                        <td>{{$temp->phone}}</td>
                                                        <td>{{$temp->email}}</td>
                                                        <td>{{$temp->refer($temp->id)}}</td>
                                                        <td>
                                                                {{$temp->exchange($temp->id)}}SLM
                                                            <!-- <a href="#popupBottom{{$temp->id}}" title="" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Some content">
                                                            </a> -->
                                                            <!-- <div id="popupBottom{{$temp->id}}" class="popover modalPopover">
                                                                <div class="arrow"></div>
                                                                <div class="popover-content">
                                                                    <span><strong>Force Swap</strong></span>
                                                                    <a href="#" class="btn btn-success">Yes</a>
                                                                    <a href="#" class="btn btn-danger">No</a>
                                                                </div>
                                                            </div> -->
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#send{{$temp->id}}">Send</button>
                                                        </td>
                                                        <td>
                                                            <a href="{{route('admin.profile', $temp->id)}}" class="btn btn-info mb-2">View</a>
                                                        </td>

                                                        <td>
                                                            @if($temp->deleted_at)
                                                            <a href="{{route('admin.retrieve', $temp->id)}}" onClick="if(!confirm('Do you really retrieve?')) return false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-success"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                                                            @else
                                                            <a href="{{route('admin.destroy', $temp->id)}}" onClick="if(!confirm('Do you really delete?')) return false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                                                            @endif
                                                        </td>
                                                        
                                                    </tr>
                                                    <div id="send{{$temp->id}}" class="modal animated slideInUp custo-slideInUp" role="dialog">
                                                        <div class="modal-dialog">
                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <form action="{{ route('admin.bonus')}}" method="post">
                                                                @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Send</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Please enter sending amount for {{$temp->email}}
                                                                        <div class="input-group mb-4">
                                                                            <input type="number" class="form-control" min="0" step="0.00001" placeholder="Send Amount" name="bonus" required>
                                                                            <input type="hidden" class="form-control" name="user_id" value="{{$temp->id}}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer md-button">
                                                                        <button class="btn" type="button" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                                                                        <button  type="submit" class="btn btn-primary">Send</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
@section('script')
<script>
$(function () {
    // $('.helloWorld').click(function () {
    //     alert('hello world');
    // });
    // prettyPrint();

    // $('.modalPopover').modalPopover({target:'#methodTarget', placement:'left'});
});
<script>
@endsection