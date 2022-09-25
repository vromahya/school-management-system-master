<!-- Master page  -->
@extends('backend.layouts.register_layout')

<!-- Page title -->
@section('pageTitle') Register College @endsection
<!-- End block -->

<!-- Page body extra class -->
@section('bodyCssClass') login-page @endsection
<!-- End block -->

<!-- BEGIN PAGE CONTENT-->
@section('pageContent')

    @if (Session::has('success') || Session::has('error') || Session::has('warning'))
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="alert @if (Session::has('success')) alert-success @elseif(Session::has('error')) alert-danger @else alert-warning @endif alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    @if (Session::has('success'))
                        <h5><i class="icon fa fa-check"></i>{{ Session::get('success') }}</h5>
                    @elseif(Session::has('error'))
                        <h5><i class="icon fa fa-ban"></i>{{ Session::get('error') }}</h5>
                    @else
                        <h5><i class="icon fa fa-warning"></i>{{ Session::get('warning') }}</h5>
                        @endif
                        </h5>
                </div>
            </div>
        </div>
    @endif
    <div class="login-box">
        <div class="login-logo">
            <a href="/">
                <img src="@if(isset($appSettings['institute_settings']['logo'])) {{asset('storage/logo/'.$appSettings['institute_settings']['logo'])}} @else {{ asset('images/logo-lg.png') }} @endif" alt="">
            </a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg text-danger">Register College</p>
            <form novalidate id="loginForm" action="{{route('store-college')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group has-feedback">
                    <input autofocus type="text" class="form-control" name="college_name" placeholder="college name" required minlength="5" maxlength="255">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <span class="text-danger">{{ $errors->first('college-name') }}</span>
                </div>
                <div class="form-group has-feedback">
                    <input autofocus type="text" class="form-control" name="college_shorthand" placeholder="College shorthand to be used in domain" required minlength="3" maxlength="255">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <span class="text-danger">{{ $errors->first('college-shorthand') }}</span>
                </div>                              
                <br>
                <button type="submit" class="btn btn-lg btn-block btn-flat login-button">REGISTER</button>
            </form>


        </div>
        <!-- /.login-box-body -->
    </div>
@endsection
<!-- END PAGE CONTENT-->

<!-- BEGIN PAGE JS-->
@section('extraScript')
    <script type="text/javascript">
        $(document).ready(function () {
            Login.init();
        });

    </script>
@endsection
<!-- END PAGE JS-->
