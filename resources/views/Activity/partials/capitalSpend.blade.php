@if(!empty(getVal($activityDataList, ['capital_spend'], [])))
    <div class="activity-element-wrapper">
        <div class="activity-element-list">
            <div class="activity-element-label col-md-4">@lang('element.capital_spend') @if(array_key_exists('Capital Spend',$errors)) <i class='imported-from-xml'>icon</i>@endif </div>
            <div class="activity-element-info">
                {{ getVal($activityDataList, ['capital_spend'], []).'%' }}
            </div>
        </div>
        <a href="{{route('activity.capital-spend.index', $id)}}" class="edit-element">@lang('global.edit')</a>
        <a href="{{route('activity.delete-element', [$id, 'capital_spend'])}}" class="delete pull-right">@lang('global.remove')</a>
    </div>
@endif
