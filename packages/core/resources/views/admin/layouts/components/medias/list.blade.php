<div class="gallery">
    @foreach($records as $record)
        <div class="gallery-item" data-id={{ $record->id }}>
            @if($record->type === 'image')
                <img class="gallery-image" src="{{ $record->path }}" alt="{{ $record->name }}" data-toggle="tooltip" data-placement="top" title="{{ $record->name }}" />
            @elseif($record->type === 'doc')
                <img class="gallery-image" src="/images/doc.png" alt="{{ $record->name }}" data-toggle="tooltip" data-placement="top" title="{{ $record->name }}" />
            @elseif($record->type === 'pdf')
                <img class="gallery-image" src="/images/pdf.png" alt="{{ $record->name }}" data-toggle="tooltip" data-placement="top" title="{{ $record->name }}" />
            @endif
        </div>
    @endforeach
</div>
<div class="mt-3 media-pagination">
    @include('core::admin.layouts.components.pagination')
</div>
