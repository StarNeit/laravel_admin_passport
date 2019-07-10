<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{!! csrf_token() !!}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
        </script>
        <script>
            function logIn() {
                var name = $("input[name = 'name']").val();
                var password = $("input[name = 'password']").val();
                $.ajax({
                    type:'POST',
                    url:'/api/login',
                    data:{
                      "_token": $('#token').val(),
                      name: name,
                      password: password
                    },
                    success:function(data) {
                        if( data.token ){
                            localStorage.setItem("token",data.token);
                            location.href = '/test';
                        }
                    }
                });
            }
        </script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

             <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>
                <div class="links">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <label>username</label> <input type="text" name="name">
                    <label>password</label> <input type="text" name="password">
                    <button type="button" onclick="logIn()" class="logInBt">Login</button>
                </div>
            </div>
        </div>
    </body>
</html>
