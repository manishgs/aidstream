<div class="activity-element-wrapper">
    @if ($incoming)
        <a href="{{ route('lite.activity.transaction.edit', [$activity->id, 1]) }}"
           class="edit-element">
            <span>@lang('lite/elementForm.edit_incoming_funds')</span>
        </a>
        <div>
        </div>
        <div class="activity-element-list">
            <div class="activity-element-label">
                @lang('lite/title.incoming_funds')
            </div>
            <div class="activity-element-info">
                @foreach ($incoming as $index => $transaction)
                    <li>
                               {{ getVal($transaction, ['transaction', 'value', 0, 'amount']) }}
                               @if(getVal($transaction, ['transaction', 'value', 0, 'currency']))
                               {{ getVal($transaction, ['transaction', 'value', 0, 'currency']) }}
                               @else
                               {{ $defaultCurrency }}
                               @endif
                               @if(getVal($transaction, ['transaction', 'value', 0, 'date']))
                               [{{ getVal($transaction, ['transaction', 'value', 0, 'date']) }}]
                        @endif
                        <a data-href="{{ route('lite.activity.transaction.delete', $activity->id) }}" data-index="{{ getVal($transaction, ['id'], '') }}"
                           class="delete-lite-resource" data-toggle="modal" data-target="#delete-modal"> @lang('lite/global.delete') </a>
                    </li>
                @endforeach
            </div>
            <a href="{{ route('lite.activity.transaction.create', [$activity->id, 'IncomingFunds']) }}"
               class="add-more"><span>@lang('lite/elementForm.add_incoming_funds')</span></a>
        </div>
    @else
        <div class="activity-element-list">
            <div class="title">
                @lang('lite/title.incoming_funds')
            </div>
            <a href="{{ route('lite.activity.transaction.create', [$activity->id, 'IncomingFunds']) }}"
               class="add-more"><span>@lang('lite/elementForm.add_incoming_funds')</span></a>
        </div>
    @endif
</div>
