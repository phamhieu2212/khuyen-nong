@extends('pages.admin.metronic.layout.application',['menu' => 'products'] )

@section('metadata')
@stop

@section('styles')
    <link rel="stylesheet" href="{!! \URLHelper::asset('libs/plugins/select2/select2.min.css', 'admin') !!}">
    <style>
        .select2-container .select2-selection--single {
            height: 33px;
            border-radius: 0px;
            margin-right: 5px;
            border: solid 0.5px;
            border-color: #d2d6de;
            box-shadow: none !important;
        }
        .row {
            margin-bottom: 15px;
        }
    </style>
@stop

@section('scripts')
    <script src="{{ \URLHelper::asset('libs/moment/moment.min.js', 'admin') }}"></script>
    <script src="{{ \URLHelper::asset('libs/datetimepicker/js/bootstrap-datetimepicker.min.js', 'admin') }}"></script>
    <script src="{{ \URLHelper::asset('libs/plugins/select2/select2.full.min.js', 'admin') }}"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
        $('.datetime-picker').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left',
            format: 'yyyy/mm/dd hh:ii'
        });
    </script>
@stop

@section('title')
    Product | Admin | {{ config('site.name') }}
@stop

@section('header')
    Product
@stop

@section('breadcrumb')
    <li class="m-nav__separator"> / </li>
    <li class="m-nav__item">
        <a href="{!! action('Admin\ProductController@index') !!}" class="m-nav__link">
            Product
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
            {{ $product->id }}
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
                        <a href="{!! action('Admin\ProductController@index') !!}" class="btn m-btn--pill m-btn--air btn-secondary btn-sm" style="width: 120px;">
                            @lang('admin.pages.common.buttons.back')
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="m-portlet__body">
            <form class="m-form m-form--fit" action="@if($isNew){!! action('Admin\ProductController@store') !!}@else{!! action('Admin\ProductController@update', [$product->id]) !!}@endif" method="POST">
                @if( !$isNew ) <input type="hidden" name="_method" value="PUT"> @endif
                {!! csrf_field() !!}

                <div class="m-portlet__body" style="padding-top: 0;">
                    <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group m-form__group row">
                                        <label for="name">@lang('admin.pages.products.columns.name')</label>
                                        <input type="text" class="form-control m-input" name="name" id="name" required placeholder="@lang('admin.pages.products.columns.name')" value="{{ old('name') ? old('name') : @$product->name }}">
                                    </div>
                                </div>
                            </div>
                    <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group m-form__group row">
                                        <label for="exampleSelect1">Danh mục</label>
                                        <select name="category_id" class="form-control m-input" id="exampleSelect1">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                    </div>
                    <div class="row">
                                {{--<div class="col-md-12">--}}
                                    {{--<div class="form-group m-form__group row" style="max-width: 500px;">--}}
                                        {{--@if( !empty($product->present()->coverImage()) )--}}
                                        {{--<img id="cover-image-preview" style="max-width: 100%;" src="{!! $product->present()->coverImage()->present()->url !!}" alt="" class="margin"/>--}}
                                        {{--@else--}}
                                        {{--<img id="cover-image-preview" style="max-width: 100%;" src="{!! \URLHelper::asset('img/no_image.jpg', 'common') !!}" alt="" class="margin"/>--}}
                                        {{--@endif--}}
                                        {{--<input type="file" style="display: none;" id="cover-image" name="cover-image">--}}
                                        {{--<p class="help-block" style="font-weight: bolder; display: block; width: 100%; text-align: center;">--}}
                                            {{--@lang('admin.pages.products.columns.cover_image_id')--}}
                                            {{--<label for="cover-image" style="font-weight: 100; color: #549cca; margin-left: 10px; cursor: pointer;">@lang('admin.pages.common.buttons.edit')</label>--}}
                                        {{--</p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group m-form__group row">
                                <label class="col-form-label">Đơn vị</label>
                                <select class="form-control js-example-basic-multiple" id="m_select2_3" name="unit_id[]" multiple="multiple">
                                    @foreach($units as $unit)
                                        <option value="{{$unit->id}}">{{$unit->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group m-form__group row">
                                <label class="col-form-label">Hành động</label>
                                <select class="form-control js-example-basic-multiple" id="m_select2_4" name="action_id[]" multiple="multiple">
                                    @foreach($actions as $action)
                                        <option value="{{$action->id}}">{{$action->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions">
                        <div class="row">
                            <div class="col-lg-9 ml-lg-auto">
                                <a href="{!! action('Admin\ProductController@index') !!}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-accent" style="width: 120px;">
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
