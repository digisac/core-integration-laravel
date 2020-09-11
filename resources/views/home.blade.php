@extends('core-integration-laravel::layout')
@section('title', 'Dashboard')
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12 col-xxl-12 card card-custom card-stretch gutter-b">
                <center class="p-5">
                    <h1><strong>DigiSac Skeleton Integration - <strong>{{getenv('APP_NAME')}}</strong> v1.1.3</strong></h1>
                </center>
            </div>
        </div>
    </div>
@endsection
