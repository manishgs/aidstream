@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Document Link</div>

                    <div class="panel-body">
                        {!! form($form) !!}

                        <div class="collection-container hidden"
                             data-prototype="{{ form_row($form->document_link->prototype()) }}">
                        </div>
                    </div>
                </div>
            </div>
            @include('includes.menu_org')
        </div>
    </div>
@endsection
