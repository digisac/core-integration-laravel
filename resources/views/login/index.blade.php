
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>DigiSac - Skeleton | Login</title>
    <link href="/vendor/digisac/core-integration-laravel/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <img class="w-100 p-4 " src="/vendor/digisac/core-integration-laravel/img/logo-cor.png" alt="DigiSac - Plataforma Multicanal"
                                     title="DigiSac - PABX Digital">
                            </div>
                            <div class="card-body">
                                <form method="POST" action="/login">
                                    {!! csrf_field() !!}
                                    @if(Session::has('errors'))
                                        <div class="alert alert-danger w-100 d-lg-block text-left">
                                            <strong class="w-100 d-lg-block">Atenção ao seguinte: </strong>
                                        </div>
                                    @endif
                                    @if(Session::has('message_error'))
                                        <div class="alert alert-danger w-100 d-lg-block text-left">
                                            <strong class="w-100 d-lg-block">{{Session::get('message_error')}}</strong>
                                        </div>
                                        <?php   Session::remove('message_error'); ?>
                                    @endif
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Email</label>
                                        <input class="form-control py-4" name="email" type="email" placeholder="Endereço de email" />
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">Senha</label>
                                        <input class="form-control py-4" name="password" type="password" placeholder="Digite sua senha" />
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button type="submit" class="btn btn-primary" style="margin:auto;">Entrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="/vendor/digisac/core-integration-laravel/js/scripts.js"></script>
</body>
</html>
