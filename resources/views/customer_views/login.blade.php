@extends('customer_layout.master')

@section('content')

    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">login &amp; register</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->



    <!-- main-content-wrap start -->
    <div class="main-content-wrap section-ptb lagin-and-register-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 m-auto">
                    <div class="login-register-wrapper">
                        <!-- login-register-tab-list start -->
                        <div class="login-register-tab-list nav">
                            <a class="active" data-bs-toggle="tab" href="#lg1">
                                <h4> login </h4>
                            </a>
                            <a data-bs-toggle="tab" href="#lg2">
                                <h4> register </h4>
                            </a>
                        </div>
                        <!-- login-register-tab-list end -->
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form v-on:submit.prevent>
                                            <div class="login-input-box">
                                                <input type="text" v-model="user.email" name="user-email" placeholder="Email Address">
                                                <input type="password" v-model="user.password" name="user-password" placeholder="Password">
                                            </div>
                                            <div class="button-box">
                                                <div class="login-toggle-btn">
                                                    <a href="#">Forgot Password?</a>
                                                </div>
                                                <div class="button-box">
                                                    <button v-on:click="loginUser()" class="login-btn btn" type="submit"><span>Login</span></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="lg2" class="tab-pane">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="#" method="post">
                                            <div class="login-input-box">
                                                <input type="text" name="user-name" placeholder="User Name">
                                                <input type="password" name="user-password" placeholder="Password">
                                                <input name="user-email" placeholder="Email" type="email">
                                            </div>
                                            <div class="button-box">
                                                <button class="register-btn btn" type="submit"><span>Register</span></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->

@endsection

@push('scripts')
    <script src="{{asset('js/vuejs/components/login.js')}}"></script>
@endpush
