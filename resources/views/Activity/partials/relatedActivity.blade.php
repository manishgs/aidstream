@if(!emptyOrHasEmptyTemplate(getVal($activityDataList, ['related_activity'], [])))
    <div class="activity-element-wrapper">
        <div class="title">@lang('element.related_activity') @if(array_key_exists('Related Activity',$errors)) <i class='imported-from-xml'>icon</i>@endif </div>
        @foreach(groupActivityElements(getVal($activityDataList, ['related_activity'], []) , 'relationship_type') as $key => $relatedActivities)
            <div class="activity-element-list">
                <div class="activity-element-label">{!! $getCode->getCodeNameOnly('RelatedActivityType' , $key) !!}</div>
                <div class="activity-element-info related-activity">
                    @foreach($relatedActivities as $relatedActivity)
                        <li>{{ getVal($relatedActivity, ['activity_identifier']) }}</li>
                    @endforeach
                </div>
            </div>
        @endforeach
        <a href="{{route('activity.related-activity.index', $id)}}" class="edit-element">@lang('global.edit')</a>
        <a href="{{route('activity.delete-element', [$id, 'related_activity'])}}" class="delete pull-right">@lang('global.remove')</a>
    </div>
@endif
