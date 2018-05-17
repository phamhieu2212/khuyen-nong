@extends('pages.admin.metronic.layout.application',['menu' => 'dashboard'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
@stop

@section('title')
    {{ config('site.name') }} | Admin | Dashboard
@stop

@section('header')
    Dashboard
@stop

@section('breadcrumb')
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item">
        <a href="" class="m-nav__link">
            <span class="m-nav__link-text">
                Dashboard
            </span>
        </a>
    </li>
@stop

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Basic Example
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                            <span>
                                <i class="la la-plus"></i>
                                <span>
                                    New record
                                </span>
                            </span>
                        </a>
                    </li>
                    <li class="m-portlet__nav-item"></li>
                    <li class="m-portlet__nav-item">
                        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                            <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                                <i class="la la-ellipsis-h m--font-brand"></i>
                            </a>
                            <div class="m-dropdown__wrapper">
                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                <div class="m-dropdown__inner">
                                    <div class="m-dropdown__body">
                                        <div class="m-dropdown__content">
                                            <ul class="m-nav">
                                                <li class="m-nav__section m-nav__section--first">
                                                    <span class="m-nav__section-text">
                                                        Quick Actions
                                                    </span>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-share"></i>
                                                            <span class="m-nav__link-text">
                                                                Create Post
                                                            </span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                            <span class="m-nav__link-text">
                                                                Send Messages
                                                            </span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-multimedia-2"></i>
                                                        <span class="m-nav__link-text">
                                                            Upload File
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__section">
                                                    <span class="m-nav__section-text">
                                                        Useful Links
                                                    </span>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-info"></i>
                                                            <span class="m-nav__link-text">
                                                                FAQ
                                                            </span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                            <span class="m-nav__link-text">
                                                                Support
                                                            </span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__separator m-nav__separator--fit m--hide"></li>
                                                <li class="m-nav__item m--hide">
                                                    <a href="#"
                                                       class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
                                                        Submit
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="m-portlet__body" style="padding-top: 20px;">
            <div class="dataTables_wrapper">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        Total: 100 results
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div id="m_table_1_filter" class="dataTables_filter" style="margin-bottom: 15px;">
                            <form action="#">
                                <div class="m-input-icon m-input-icon--left m-input-icon--right">
                                    <input type="text" class="form-control m-input m-input--pill" placeholder="Tìm kiếm" style="width: 100%; margin: 0;">
                                    <span class="m-input-icon__icon m-input-icon__icon--left">
                                        <span>
                                            <i class="la la-search"></i>
                                        </span>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12" style="overflow-x: scroll;">
                        <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                            <thead>
                            <tr>
                                <th>
                                    RecordID
                                </th>
                                <th>
                                    OrderID
                                </th>
                                <th>
                                    Country
                                </th>
                                <th>
                                    ShipCity
                                </th>
                                <th>
                                    ShipAddress
                                </th>
                                <th>
                                    CompanyAgent
                                </th>
                                <th>
                                    ShipDate
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Type
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>
                                    61715-075
                                </td>
                                <td>
                                    China
                                </td>
                                <td>
                                    Tieba
                                </td>
                                <td>
                                    746 Pine View Junction
                                </td>
                                <td>
                                    Nixie Sailor
                                </td>
                                <td>
                                    2/12/2018
                                </td>
                                <td>
                                    3
                                </td>
                                <td>
                                    2
                                </td>
                                <td nowrap></td>
                            </tr>
                            <tr>
                                <td>
                                    2
                                </td>
                                <td>
                                    63629-4697
                                </td>
                                <td>
                                    Indonesia
                                </td>
                                <td>
                                    Cihaur
                                </td>
                                <td>
                                    01652 Fulton Trail
                                </td>
                                <td>
                                    Emelita Giraldez
                                </td>
                                <td>
                                    8/6/2017
                                </td>
                                <td>
                                    6
                                </td>
                                <td>
                                    3
                                </td>
                                <td nowrap></td>
                            </tr>
                            <tr>
                                <td>
                                    3
                                </td>
                                <td>
                                    68084-123
                                </td>
                                <td>
                                    Argentina
                                </td>
                                <td>
                                    Puerto Iguazú
                                </td>
                                <td>
                                    2 Pine View Park
                                </td>
                                <td>
                                    Ula Luckin
                                </td>
                                <td>
                                    5/26/2016
                                </td>
                                <td>
                                    1
                                </td>
                                <td>
                                    2
                                </td>
                                <td nowrap></td>
                            </tr>
                            <tr>
                                <td>
                                    4
                                </td>
                                <td>
                                    67457-428
                                </td>
                                <td>
                                    Indonesia
                                </td>
                                <td>
                                    Talok
                                </td>
                                <td>
                                    3050 Buell Terrace
                                </td>
                                <td>
                                    Evangeline Cure
                                </td>
                                <td>
                                    7/2/2016
                                </td>
                                <td>
                                    1
                                </td>
                                <td>
                                    3
                                </td>
                                <td nowrap></td>
                            </tr>
                            <tr>
                                <td>
                                    5
                                </td>
                                <td>
                                    31722-529
                                </td>
                                <td>
                                    Austria
                                </td>
                                <td>
                                    Sankt Andrä-Höch
                                </td>
                                <td>
                                    3038 Trailsway Junction
                                </td>
                                <td>
                                    Tierney St. Louis
                                </td>
                                <td>
                                    5/20/2017
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    3
                                </td>
                                <td nowrap></td>
                            </tr>
                            <tr>
                                <td>
                                    6
                                </td>
                                <td>
                                    64117-168
                                </td>
                                <td>
                                    China
                                </td>
                                <td>
                                    Rongkou
                                </td>
                                <td>
                                    023 South Way
                                </td>
                                <td>
                                    Gerhard Reinhard
                                </td>
                                <td>
                                    11/26/2016
                                </td>
                                <td>
                                    5
                                </td>
                                <td>
                                    3
                                </td>
                                <td nowrap></td>
                            </tr>
                            <tr>
                                <td>
                                    7
                                </td>
                                <td>
                                    43857-0331
                                </td>
                                <td>
                                    China
                                </td>
                                <td>
                                    Baiguo
                                </td>
                                <td>
                                    56482 Fairfield Terrace
                                </td>
                                <td>
                                    Englebert Shelley
                                </td>
                                <td>
                                    6/28/2016
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    3
                                </td>
                                <td nowrap></td>
                            </tr>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>
                                    61715-075
                                </td>
                                <td>
                                    China
                                </td>
                                <td>
                                    Tieba
                                </td>
                                <td>
                                    746 Pine View Junction
                                </td>
                                <td>
                                    Nixie Sailor
                                </td>
                                <td>
                                    2/12/2018
                                </td>
                                <td>
                                    3
                                </td>
                                <td>
                                    2
                                </td>
                                <td nowrap></td>
                            </tr>
                            <tr>
                                <td>
                                    2
                                </td>
                                <td>
                                    63629-4697
                                </td>
                                <td>
                                    Indonesia
                                </td>
                                <td>
                                    Cihaur
                                </td>
                                <td>
                                    01652 Fulton Trail
                                </td>
                                <td>
                                    Emelita Giraldez
                                </td>
                                <td>
                                    8/6/2017
                                </td>
                                <td>
                                    6
                                </td>
                                <td>
                                    3
                                </td>
                                <td nowrap></td>
                            </tr>
                            <tr>
                                <td>
                                    3
                                </td>
                                <td>
                                    68084-123
                                </td>
                                <td>
                                    Argentina
                                </td>
                                <td>
                                    Puerto Iguazú
                                </td>
                                <td>
                                    2 Pine View Park
                                </td>
                                <td>
                                    Ula Luckin
                                </td>
                                <td>
                                    5/26/2016
                                </td>
                                <td>
                                    1
                                </td>
                                <td>
                                    2
                                </td>
                                <td nowrap></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row" style="padding-top: 20px;">
                    <div class="col-sm-12">
                        @include('pages.admin.metronic.shared.bottom-pagination')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
