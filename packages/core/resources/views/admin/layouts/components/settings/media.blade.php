<div class="row">
    <div class="col-md-12">
        <div class="mb-2 preview-container">
            @if($media)
                @if($media->type === 'image')
                    <img class="preview-image" src="{{ $media->path }}" alt="{{ $media->title }}" data-toggle="tooltip" data-placement="top" title="{{ $media->title }}"/>
                @elseif($media->type === 'doc')
                    <img class="preview-image" src="/images/doc.png" alt="{{ $media->title }}" data-toggle="tooltip" data-placement="top" title="{{ $media->title }}"/>
                @elseif($media->type === 'pdf')
                    <img class="preview-image" src="/images/pdf.png" alt="{{ $media->title }}" data-toggle="tooltip" data-placement="top" title="{{ $media->title }}"/>
                @endif
            @endif
        </div>
        <button data-multiple="{{ $options['multiple'] }}" data- type="button" class="btn btn-outline-primary  mb-2"
                data-bs-toggle="modal" data-bs-target="#mediaModal" data-type={{ $options['type'] ?? 'image' }} data-field={{ "values[" . $field . "]" }}>
            <i class="fa fa-plus"></i> {{ $options['button'] }}
        </button>
        <div class="input-container">
            <input type="hidden" name={{ "values[" . $field . "]" }} value={{  $media ? $media->id : "" }}>
        </div>
    </div>
</div>
