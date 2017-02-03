@extends('app')

@section('title', trans('title.recipient_region_budget'))

@section('content')
    <div class="container main-container">
        <div class="row">
            @include('includes.side_bar_menu')
            <div class="col-xs-9 col-md-9 col-lg-9 content-wrapper">
                @include('includes.response')
                <div class="panel-content-heading">
                    <div>@lang('element.recipient_region_budget')
                        <div class="panel-action-btn">
                            <a href="{{route('organization.show', $orgId)}}" class="btn btn-primary btn-view-it">@lang('global.view_organisation_data')
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-8 col-md-8 col-lg-8 element-content-wrapper">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="create-form">
                                {!! form($form) !!}
                            </div>
                            <div class="collection-container hidden"
                                 data-prototype="{{ form_row($form->recipient_region_budget->prototype()) }}"></div>
                        </div>
                    </div>
                </div>
                @include('includes.menu_org')
            </div>
        </div>
    </div>
@endsection
