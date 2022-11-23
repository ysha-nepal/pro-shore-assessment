<table class="table align-middle mb-0">
    <thead class="table-light">
        <tr>
            <th>{{__($package.'::table.sn')}}</th>
            @foreach($ui->columns as $col)
                <th>{{ __($package.'::table.'.$col) }}</th>
            @endforeach
            @if(count($ui->getActions()) > 0)
                <th style="width: 70px;" class="text-right">{{__($package.'::table.action')}}</th>
            @endif
        </tr>
    </thead>
    <tbody>
    @forelse ($records as $record)
        <tr>
            <th scope=row>{{ $records->firstItem() + $loop->index }}</th>
            @foreach ($ui->columns as $attribute => $column)
                <td>{!! $ui->getAttribute($record,$attribute) !!}</td>
            @endforeach
            @if(count($ui->getActions()) > 0)
                <td>
                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                    @foreach($ui->getActions() as $component => $action)
                            @can($action['permission'])
                                @includeFirst([
                                    "$package::admin.$view.actions.$component",
                                   "core::admin.layouts.components.actions.$component",
                                   "core::admin.layouts.components.actions.default"
                                ])
                            @endcan
                        @endforeach
                    </div>
                </td>
            @endif
        </tr>
    @empty
        <tr>
            <td colspan="{{ count($ui->columns) + 2 }}" class="text-center"> {{__('core::table.no_data')}}</td>
        </tr>
    @endforelse
    </tbody>
</table>
