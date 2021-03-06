@extends('common.home.auth')

@section('main')
    <main id="mainContent" class="main-content">
        <div class="page-container ptb-60">
            <div class="container">
                @if (session()->has('status'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session('status') }}
                    </div>
                @endif
                <section class="sign-area panel p-40">
                    <h3 class="sign-title">注册 <small>Or <a href="{{ route('login') }}" class="color-green">登录</a></small></h3>
                    <div class="row row-rl-0">
                        <div class="col-sm-6 col-md-7 col-left">
                            <form action="{{ route('register') }}" id="register_form" method="post" class="p-40">
                                {{ csrf_field() }}

                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="sr-only">用户名</label>
                                    <input type="text" class="form-control input-lg" placeholder="用户名" name="name" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="sr-only">邮箱</label>
                                    <input type="email" class="form-control input-lg" name="email" value="{{ old('email') }}" placeholder="邮箱" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group custom-radio {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="sr-only">性别</label>
                                    <div style="display: inline-block;">
                                        <input type="radio" id="sex_man" name="sex" value="1" checked>
                                        <label for="sex_man" class="color-mid">男</label>
                                    </div>
                                    <div style="display: inline-block; padding-left: 30px;">
                                        <input type="radio" id="sex_human" value="0" name="sex">
                                        <label for="sex_human" class="color-mid">女</label>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label class="sr-only">密码</label>
                                    <input type="password" class="form-control input-lg" name="password" placeholder="密码" required>
                                    @if ($errors->has('password'))
                                        <span class='help-block'>
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="sr-only">确定密码</label>
                                    <input type="password" class="form-control input-lg" placeholder="确认密码" name="password_confirmation" required>
                                </div>

                                <div class="form-group {{ $errors->has('captcha') ? ' has-error' : '' }}">
                                    <label class="sr-only">验证码</label>
                                    <div style="position: relative;">
                                        <input width="50px" id="text" maxlength="4" type="text" class="form-control input-lg" id="captcha" name="captcha" placeholder="验证码" required>
                                        <img id="captcha" style="position: absolute;top: 0;right: 0;cursor: pointer;" src="{{ captcha_src() }}" onclick="this.src='{{ url("captcha/default") }}?' + Math.random()" alt="验证码">
                                    </div>

                                    @if ($errors->has('captcha'))
                                        <div class="has-error">
                                            <span class='help-block'>
                                                <strong>{{ $errors->first('captcha') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="custom-checkbox mb-20">
                                    <input type="checkbox" id="agree-terms">
                                    <label for="agree-terms" class="color-mid">
                                        我同意
                                        <a href="#" class="color-green" target="_blank">Shop隐私声明</a>
                                    </label>
                                    <span class="has-error">
                                        <strong id="checkbox_text" class="help-block"></strong>
                                    </span>
                                </div>
                                <button type="submit" class="btn btn-block btn-lg">注  册</button>
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
                                    已经有账号 ? <a href="{{ route('login') }}" class="color-green">登录</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        $('#register_form').submit(function() {
          if (! $('#agree-terms').is(':checked')) {
            $('#checkbox_text').text('请同意Shop隐私声明');

            setTimeout(function() {
              $('#checkbox_text').text('');
            }, 3000)

            return false;
          }
          return true;
        })
    </script>
@endsection