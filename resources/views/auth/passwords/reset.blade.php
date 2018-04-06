@extends('common.home.auth')

@section('main')
    <main id="mainContent" class="main-content">
        <div class="page-container ptb-60">
            <div class="container">
                <section class="sign-area panel p-40">
                    <h3 class="sign-title">重置密码</h3>
                    <div class="row row-rl-0">
                        <div class="col-sm-6 col-md-7 col-left">
                            <form action="{{ route('password.request') }}" method="post" class="p-40 form-horizontal">
                                {{ csrf_field() }}

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="sr-only">用户名/邮箱</label>
                                    <input type="text" class="form-control input-lg" id="email" name="email" value="{{ $email or old('email') }}" placeholder="邮箱" required>
                                    @if ($errors->has('email'))
                                        <span class='help-block'>
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" class="form-control input-lg" id="password" name="password" placeholder="新密码" required>
                                    @if ($errors->has('password'))
                                        <span class='help-block'>
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('password_conformation') ? ' has-error' : '' }}">
                                    <label for="password_conformation" class="sr-only">Password</label>
                                    <input type="password" class="form-control input-lg" id="password_conformation" name="password_confirmation" placeholder="确定密码" required>
                                    @if ($errors->has('password_conformation'))
                                        <span class='help-block'>
                                            <strong>{{ $errors->first('password_conformation') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-block btn-lg">修改密码</button>
                            </form>
                            <span class="or">Or</span>
                        </div>
                        <div class="col-sm-6 col-md-5 col-right">
                            <div class="social-login p-40">
                                <div class="mb-20">
                                    <a href="{{ url('/auth/github') }}" class="btn btn-lg btn-block btn-social btn-facebook"><i class="fa  fa-github"></i>登录 Github</a>
                                </div>
                                <div class="mb-20">
                                    <a href="{{ url('/auth/qq') }}" class="btn btn-lg btn-block btn-social btn-twitter"><i class="fa fa-qq"></i>登录  QQ</a>
                                </div>
                                <div class="mb-20">
                                    <a href="{{ url('/auth/weibo') }}" class="btn btn-lg btn-block btn-social btn-google-plus"><i class="fa fa-weibo"></i>登录  微博</a>
                                </div>
                                <div class="text-center color-mid">
                                    <a href="{{ route('login') }}" class="color-green">登录</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection