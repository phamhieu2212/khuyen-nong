@extends('pages.admin.metronic.layout.application',['menu' => 'certificates'] )

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
    Certificate | Admin | {{ config('site.name') }}
@stop

@section('header')
    Certificate
@stop

@section('breadcrumb')
    <li class="m-nav__separator"> / </li>
    <li class="m-nav__item">
        <a href="{!! action('Admin\CertificateController@index') !!}" class="m-nav__link">
            Certificate
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
            {{ $certificate->id }}
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
                        <a href="{!! action('Admin\CertificateController@index') !!}" class="btn m-btn--pill m-btn--air btn-secondary btn-sm" style="width: 120px;">
                            @lang('admin.pages.common.buttons.back')
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="m-portlet__body">
            <form class="m-form m-form--fit" action="@if($isNew){!! action('Admin\CertificateController@store') !!}@else{!! action('Admin\CertificateController@update', [$certificate->id]) !!}@endif" method="POST">
                @if( !$isNew ) <input type="hidden" name="_method" value="PUT"> @endif
                {!! csrf_field() !!}

                <div class="m-portlet__body" style="padding-top: 0;">
                    {{--<div class="row">--}}
                        {{--<div class="col-md-6">--}}
                            {{--<div class="form-group m-form__group row" style="max-width: 500px;">--}}
                                {{--@if( isset($certificate) and !empty($certificate->present()->coverImage()) )--}}
                                    {{--<img id="cover-image-preview" style="max-width: 100%;" src="{!! @$certificate->present()->coverImage()->present()->url !!}" alt="" class="margin"/>--}}
                                {{--@else--}}
                                    {{--<img id="cover-image-preview" style="max-width: 100%;" src="{!! \URLHelper::asset('img/no_image.jpg', 'common') !!}" alt="" class="margin"/>--}}
                                {{--@endif--}}
                                {{--<input type="file" style="display: none;" id="cover-image" name="cover-image">--}}
                                {{--<p class="help-block" style="font-weight: bolder; display: block; width: 100%; text-align: center;">--}}
                                    {{--Ảnh Logo--}}
                                    {{--<label for="cover-image" style="font-weight: 100; color: #549cca; margin-left: 10px; cursor: pointer;">@lang('admin.pages.common.buttons.edit')</label>--}}
                                {{--</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-6">--}}
                            {{--<div class="form-group m-form__group row" style="max-width: 500px;">--}}
                                {{--@if( isset($certificate) and !empty($certificate->present()->coverImage()) )--}}
                                    {{--<img id="cover-image-preview" style="max-width: 100%;" src="{!! $certificate->present()->coverImage()->present()->url !!}" alt="" class="margin"/>--}}
                                {{--@else--}}
                                    {{--<img id="cover-image-preview" style="max-width: 100%;" src="{!! \URLHelper::asset('img/no_image.jpg', 'common') !!}" alt="" class="margin"/>--}}
                                {{--@endif--}}
                                {{--<input type="file" style="display: none;" id="cover-image" name="cover-image">--}}
                                {{--<p class="help-block" style="font-weight: bolder; display: block; width: 100%; text-align: center;">--}}
                                    {{--Ảnh Cover--}}
                                    {{--<label for="cover-image" style="font-weight: 100; color: #549cca; margin-left: 10px; cursor: pointer;">@lang('admin.pages.common.buttons.edit')</label>--}}
                                {{--</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group m-form__group row">
                                        <label for="name">@lang('admin.pages.certificates.columns.name')</label>
                                        <input type="text" class="form-control m-input" name="name" id="name" required placeholder="@lang('admin.pages.certificates.columns.name')" value="{{ old('name') ? old('name') : @$certificate->name }}">
                                    </div>
                                </div>
                    </div>
                    <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group m-form__group row">
                                        <label for="exampleSelect1">Loại chứng chỉ</label>
                                        <select name="type" class="form-control m-input" id="exampleSelect1">
                                            <option value="1" {{(@$certificate->type == 1)?'selected':''}}>Chứng chỉ</option>
                                            <option value="2" {{(@$certificate->type == 2)?'selected':''}}>Tiêu chuẩn</option>
                                            <option value="3" {{(@$certificate->type == 3)?'selected':''}}>Chứng nhận</option>
                                        </select>
                                    </div>
                                </div>
                    </div>
                    <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group m-form__group row">
                                        <label for="description">@lang('admin.pages.certificates.columns.description')</label>
                                        <textarea name="description" id="description" class="form-control m-input" rows="3" placeholder="@lang('admin.pages.certificates.columns.description')">{{ old('description') ? old('description') : @$certificate->description }}</textarea>
                                    </div>
                                </div>
                    </div>
                </div>

                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions">
                        <div class="row">
                            <div class="col-lg-9 ml-lg-auto">
                                <a href="{!! action('Admin\CertificateController@index') !!}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-accent" style="width: 120px;">
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
        </div>
    </div>
@stop
