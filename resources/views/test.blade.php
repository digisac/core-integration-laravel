<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>DigiSac - Skeleton | Login</title>
    <link href="/vendor/digisac/core-integration-laravel/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="card " style="margin-top: 55px;margin-right: 10px;">
    <div class="card-header" style="border:0;margin-bottom:-18px;">
        <img class="w-100 p-4 " src="https://www.rdstation.com/wp-content/uploads/2017/02/rd_station_cor.png"
             alt="DigiSac - Plataforma Multicanal"
             title="DigiSac - PABX Digital" style="margin-bottom:-25px;">
        <center><h4>Integração</h4></center>
    </div>
    <div class="card-body">
        <center style="font-size: 12px;">Preencha seu login e senha do RD Station CRM</center><hr/>
        <form method="POST" action="/login">
            <strong>ContactID: {{$id}}</strong><hr/>
            <div class="form-group">
                <label class="small mb-1" for="inputEmailAddress">Email</label>
                <input class="form-control py-4" name="email" type="email"
                       placeholder="Endereço de email"/>


            </div>
            <div class="form-group">
                <label class="small mb-1" for="inputPassword">Senha</label>
                <input class="form-control py-4" name="password" type="password"
                       placeholder="Digite sua senha"/>


            </div>
            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                <button type="submit" class="btn btn-primary" style="margin:auto;">Entrar
                </button>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="/vendor/digisac/core-integration-laravel/js/scripts.js"></script>
</body>
</html>
