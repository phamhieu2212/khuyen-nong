@extends('pages.admin.metronic.layout.application',['menu' => 'admin_users'] )

@section('metadata')
@stop

@section('styles')
    <style>
        .row {
            margin-bottom: 15px;
        }
    </style>
@stop

@section('scripts')
    <script src="{!! \URLHelper::asset('metronic/demo/default/custom/crud/forms/validation/form-controls.js', 'admin') !!}"></script>
    <script>
        $(document).ready(function () {
            $('#cover-image').change(function (event) {
                $('#cover-image-preview').attr('src', URL.createObjectURL(event.target.files[0]));
            });

            $('.datetime-picker').datetimepicker({
                todayHighlight: true,
                autoclose: true,
                pickerPosition: 'bottom-left',
                format: 'yyyy/mm/dd hh:ii'
            });
        });
    </script>
@stop

@section('title')
    AdminUser | Admin | {{ config('site.name') }}
@stop

@section('header')
    AdminUser
@stop

@section('breadcrumb')
    <li class="m-nav__separator"> / </li>
    <li class="m-nav__item">
        <a href="{!! action('Admin\AdminUserController@index') !!}" class="m-nav__link">
            AdminUser
        </a>
    </li>

    @if( $isNew )
        <li class="m-nav__separator"> / </li>
        <li class="m-nav__item">
            New Record
        </li>
    @else
        <li class="m-nav__separator"> / </li>
        <li class="m-nav__item">
            {{ $adminUser->id }}
        </li>
    @endif
@stop

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Create New Record
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="{!! action('Admin\AdminUserController@index') !!}" class="btn m-btn--pill m-btn--air btn-secondary btn-sm" style="width: 120px;">
                            @lang('admin.pages.common.buttons.back')
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="m-portlet__body">
            <!--begin::Form-->
            <form class="m-form m-form--fit m-form--label-align-right " action="@if($isNew){!! action('Admin\AdminUserController@store') !!}@else{!! action('Admin\AdminUserController@update', [$adminUser->id]) !!}@endif" method="POST">
                @if( !$isNew ) <input type="hidden" name="_method" value="PUT"> @endif
                {!! csrf_field() !!}
                <div class="m-portlet__body">
                    {{--<div class="form-group m-form__group m--margin-top-10">--}}
                        {{--<div class="alert m-alert m-alert--default" role="alert">--}}
                            {{--The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="form-group m-form__group">
                        <label for="exampleInputName1">Tên</label>
                        <input name="name" type="name" class="form-control m-input" id="exampleInputName1" placeholder="Enter name" value="{{ old('name') ? old('name') : @$adminUser->name }}">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Email</label>
                        <input name="email" type="email" class="form-control m-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="{{ old('email') ? old('email') : @$adminUser->email }}">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleInputPassword1">Mật khẩu</label>
                        <input name="password" type="password" class="form-control m-input" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="example-tel-input">Số điện thoại</label>
                        <input name="phone" class="form-control m-input" type="tel" id="example-tel-input" value="{{ old('phone') ? old('phone') : @$adminUser->phone }}">
                    </div>

                    <div class="form-group m-form__group">
                        <label for="exampleSelect1">Vai trò</label>
                        <select name="role[]" class="form-control m-input" id="exampleSelect1">
                            <option value="super_user">Super admin</option>
                            <option value="admin">Quản lý</option>
                            <option value="htx">Hợp tác xã</option>
                            <option value="farmer">Nông dân</option>
                        </select>
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleSelect1">Chứng chỉ</label>
                        <select name="certificate_id[]" class="form-control m-input" id="exampleSelect1">
                            @foreach($certificates as $certificate)
                            <option value="{{$certificate->id}}">{{$certificate->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleSelect1">Đơn vị quản lý</label>
                        <select name="htx_id" class="form-control m-input" id="exampleSelect1">
                            <option>Không có</option>
                            @foreach($htxes as $htx)
                            <option value="{{$htx->id}}">{{$htx->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <div class="row">
                            <div class="col-lg-9 ml-lg-auto">
                                <a href="{!! action('Admin\AdminUserController@index') !!}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-accent" style="width: 120px;">
                                    @lang('admin.pages.common.buttons.cancel')
                                </a>
                                <button type="submit" class="btn m-btn--pill m-btn--air btn-primary m-btn m-btn--custom" style="width: 120px;">
                                    @lang('admin.pages.common.buttons.save')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
@stop
