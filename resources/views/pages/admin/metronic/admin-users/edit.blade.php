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
            <form class="m-form m-form--fit m-form--label-align-right">
                <div class="m-portlet__body">
                    {{--<div class="form-group m-form__group m--margin-top-10">--}}
                        {{--<div class="alert m-alert m-alert--default" role="alert">--}}
                            {{--The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="form-group m-form__group">
                        <label for="exampleInputName1">Name</label>
                        <input name="name" type="name" class="form-control m-input" id="exampleInputName1" placeholder="Enter name">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input name="email" type="email" class="form-control m-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <span class="m-form__help">We'll never share your email with anyone else.</span>
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleInputPassword1">Password</label>
                        <input name="password" type="password" class="form-control m-input" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="example-tel-input">Telephone</label>
                        <input name="phone" class="form-control m-input" type="tel" id="example-tel-input">
                    </div>

                    <div class="form-group m-form__group">
                        <label for="exampleSelect1">Example select</label>
                        <select class="form-control m-input" id="exampleSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleSelect2">Example multiple select</label>
                        <select multiple="" class="form-control m-input" id="exampleSelect2">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleTextarea">Example textarea</label>
                        <textarea class="form-control m-input" id="exampleTextarea" rows="3"></textarea>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <button type="reset" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
@stop
