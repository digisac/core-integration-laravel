@extends('core-integration-laravel::layout')
@section('title', 'Dashboard')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Empresas</h1>
    <p class="mb-4">Cadastrar Nova</a>.</p>

    <div class="row">
        <div class="col-lg-12 order-lg-1">
            <div class="card shadow mb-4">
                <div class="card-body">
                    @if(Session::has('errors'))
                        <div class="alert alert-danger w-100 d-lg-block text-left">
                            <strong class="w-100 d-lg-block">Atenção ao seguinte: </strong>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('company.store')  }}" autocomplete="off">
                        {!! csrf_field() !!}
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Nome
                                            <span class="small text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="name" placeholder="Name"
                                               value="{{ old('name') }}"/>
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label">URL
                                            <span class="small text-danger">*</span>
                                        </label>

                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">https://</span>
                                            </div>
                                            <input type="text" class="form-control" name="url"
                                                   placeholder="" value="{{ old('url') }}"/>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">-api.digisac.app/v1/</span>
                                            </div>
                                        </div>
                                        @if ($errors->has('url'))
                                            <span class="text-danger">{{ $errors->first('url') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">Token
                                            <span class="small text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="token"
                                               placeholder="Token"
                                               value="{{ old('token') }}"/>
                                        @if ($errors->has('token'))
                                            <span class="text-danger">{{ $errors->first('token') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="current_password">CompanyID
                                            <span class="small text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="company_id" placeholder=""
                                               value="{{ old('company_id') }}"/>
                                        @if ($errors->has('company_id'))
                                            <span class="text-danger">{{ $errors->first('company_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="new_password">Company Agnus ID
                                            <span class="small text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="company_agnus_id"
                                               placeholder="ID Agnus" value="{{ old('company_agnus_id') }}"/>
                                        @if ($errors->has('company_agnus_id'))
                                            <span class="text-danger">{{ $errors->first('company_agnus_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group focused">
                                        <label class="form-control-label">Configurações
                                            <span class="small text-danger">*</span>
                                        </label>
                                        <textarea rows="5" class="form-control"
                                                  name="settings">{{ old('settings') }}</textarea>
                                        @if ($errors->has('settings'))
                                            <span class="text-danger">{{ $errors->first('settings') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-sm-6 float-left">
                                    <button type="reset" class="btn btn-light" style="border:1px solid #cdcdcd;">
                                        Cancelar
                                    </button>
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i>
                                        Salvar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
