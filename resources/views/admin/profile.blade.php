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
                                    <div class="containers">
                                        <div class="">
                                            <h3>
                                                User Profile
                                                @if($user_data->deleted_at)
                                                <span class="badge badge-danger">Deleted</span>
                                                @else
                                                <span class="badge badge-primary">Active</span>
                                                @endif
                                            </h3>
                                            <div class="col-sm-12 text-right">
                                                <a href="{{route('admin.index')}}" class="btn btn-info">Back</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 row">
                                            <div class="col-md-6">
                                                <ul>
                                                    <label>Name: </label><span>{{$user_data->name}}</span>
                                                </ul>
                                                <ul>
                                                    <label>Email: </label><span>{{$user_data->email}}</span>
                                                </ul>
                                                <ul>
                                                    <label>Phone number: </label><span>{{$user_data->phone}}</span>
                                                </ul>
                                                <ul>
                                                    <label>Telegram username: </label><span>{{$user_data->tg_name}}</span>
                                                </ul>
                                                <ul>
                                                    <label>Slamchat username: </label><span>{{$user_data->slam_name}}</span>
                                                </ul>
                                                <ul>
                                                    <label>Affilation count: </label><span>{{$user_data->refer($user_data->id)}}</span>
                                                </ul>
                                                <ul>
                                                    <label>Holding BNB/ETH: </label><span id="balance_output"></span>
                                                </ul>
                                                <ul>
                                                    <label>Holding $SLM: </label><span>{{$user_data->exchange($user_data->id)}}</span>
                                                </ul>
                                                <ul>
                                                    <label>Contract: </label><span>{{$user_data->address}}</span>
                                                </ul>

                                                <ul>
                                                    <a class="btn btn-warning" href="{{route('admin.forceswap', $user_data->id)}}" onClick="if(!confirm('Do you really force swap?')) return false">Force Swap</a>
                                                    @if($user_data->deleted_at)
                                                    <a class="btn btn-success" href="{{route('admin.retrieve', $user_data->id)}}" onClick="if(!confirm('Do you really retrieve?')) return false">Retrieve Account</a>
                                                    @else
                                                    <a class="btn btn-danger" href="{{route('admin.destroy', $user_data->id)}}" onClick="if(!confirm('Do you really delete?')) return false">Delete Account</a>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul>
                                                    <div class="col-md-12">
                                                        <div id="memo_toast" class="toast toast-danger fade hide" role="alert" data-delay="6000" aria-live="assertive" aria-atomic="true">
                                                            <div class="toast-header text-right">
                                                                <!-- <strong class="mr-auto">Bootstrap</strong>
                                                                <small class="meta-time">just now</small> -->
                                                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="toast-body">
                                                                <p id="memo_toast_alert"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </ul>

                                                <ul class="">
                                                    <label>Add memo:</label>
                                                    <textarea class="form-control" id="memo_text" rows="5">{{$user_data->memo}}</textarea>
                                                    <div class="text-right">
                                                        <button class="btn btn-success" onclick="validateMemo()">Save</button>
                                                    </div>
                                                </ul>

                                                <ul>
                                                    <div class="col-md-12">
                                                        <div id="password_toast" class="toast toast-danger fade hide" role="alert" data-delay="6000" aria-live="assertive" aria-atomic="true">
                                                            <div class="toast-header text-right">
                                                                <!-- <strong class="mr-auto">Bootstrap</strong>
                                                                <small class="meta-time">just now</small> -->
                                                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="toast-body">
                                                                <p id="password_toast_alert"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </ul>

                                                <ul>
                                                    <input id="password" type="password" class="form-control" placeholder="Enter new password" />
                                                </ul>
                                                <ul>
                                                    <input id="retype_password" type="password" class="form-control" placeholder="Confirm password" />
                                                </ul>

                                                <ul>
                                                    <button class="btn btn-success" onclick="validatePassword();">Save</button>
                                                </ul>
                                            </div>
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
    $('.helloWorld').click(function () {
        alert('hello world');
    });
    // prettyPrint();

    // $('.modalPopover').modalPopover({target:'#methodTarget', placement:'left'});
});

function validatePassword() {
	var password = document.getElementById("password").value;
	var retype = document.getElementById("retype_password").value;
	
    
	if (password.length <= 6) {
        document.getElementById("password_toast_alert").innerHTML = "Password should be at least 6 characters.\n";
        $('#password_toast').toast('show');
        return false;
    }
    
	if (password != retype)  {
        document.getElementById("password_toast_alert").innerHTML = "Passwords do not match.\n";
        $('#password_toast').toast('show');
        return false;
    }
		
    $.ajax({
        method: "POST",
        url: "{{route('admin.password_update')}}",
        data: {user_id: {{$user_data->id}}, password: password, password_confirmation: retype},
        success: function(res) {
            document.getElementById("password_toast_alert").innerHTML = res;
            $('#password_toast').toast('show');
        }
    });
}

function validateMemo() {
	var memo = document.getElementById("memo_text").value;
    
	if (memo.length <= 5) {
        document.getElementById("memo_toast_alert").innerHTML = "Memo should be at least 5 characters.\n";
        $('#memo_toast').toast('show');
        return false;
    }

    $.ajax({
        method: "POST",
        url: "{{route('admin.memo')}}",
        data: {user_id: {{$user_data->id}}, memo: memo},
        success: function(res) {
            document.getElementById("memo_toast_alert").innerHTML = res;
            $('#memo_toast').toast('show');
        }
    })
}
</script>
<script src="{{asset('assets/js/web3.min.js')}}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/web3js-cdn@1.3.0/web3.min.js" integrity="sha512-mYc+D+NmmyR0Gcrzyae7q5HguBCS4cBHAsIk7gGhu0/ZyGg4z2YZDjyR2YQA/IMCMTNs4mnlw3vVdERzewpekQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script type="text/javascript">
    var address, wei, balance, bnb_balance
    window.addEventListener('load', function () {
        // if (typeof web3 !== 'undefined') {
        //     console.log('Web3 Detected! ' + web3.currentProvider.constructor.name)
        //     window.web3 = new Web3(web3.currentProvider);
        // } else {
        //     console.log('No Web3 Detected... using HTTP Provider')
        // }
        window.web3 = new Web3(new Web3.providers.HttpProvider("https://mainnet.infura.io/v3/8a1115e747524e11b2928a22a19a6388"));
        window.web3_bnb = new Web3(new Web3.providers.HttpProvider('https://bsc-dataseed1.binance.org:443'));
        getBalance();
    });

    function getBalance() {
        address = "{{$user_data->address}}";
        
        try {
            bnb_balance = web3_bnb.eth.getBalance(address);
            
            web3.eth.getBalance(address, function (error, wei) {
                if (!error) {
                    balance = web3.fromWei(wei, 'ether');
                    document.getElementById("balance_output").innerHTML = bnb_balance/1000000000000000000+"/"+balance;
                }
            });
            
        } catch (err) {
            document.getElementById("balance_output").innerHTML = err;
        }

    }

</script>
@endsection