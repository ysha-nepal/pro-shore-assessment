<div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="mediaModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediaModalLabel">File Manager</h5>
                <button class="btn btn-outline-danger" type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" data-url={{ route('api.medias') }} id="nav-selector-tab"
                           data-bs-toggle="tab" href="#nav-selector" role="tab" aria-controls="nav-selector"
                           aria-selected="false"></a>
                        <a class="nav-item nav-link" id="nav-uploads-tab" data-bs-toggle="tab" href="#nav-uploads"
                           role="tab" aria-controls="nav-uploads" aria-selected="true">Upload File</a>

                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane" id="nav-uploads" role="tabpanel"
                         aria-labelledby="nav-uploads-tab">
                        <div class="card">
                            <div class="card-body">
                                <div class="media-modal-message-container d-none alert border-0 bg-light-info alert-dismissible fade show py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-3 text-success"><i class="bi bi-info-circle-fill"></i>
                                        </div>
                                        <div class="ms-3">
                                            <div class="text-success media-modal-message"></div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                {{ Form::open(['id' => 'media-uploader','url' => route('api.media.upload'),'method' =>
                                'POST','files' => true]) }}
                                <div class="form-group">
                                    {{ Form::label('title','Title (*)') }}
                                    <div class="input-group mb-3">
                                        {{ Form::text('title',null,[
                                        'class'=>'form-control',
                                        'placeholder'=>'Title'
                                        ]) }}
                                    </div>
                                </div>
                                {{ Form::file('medias[]',[
                                'class' => 'form-control mb-3',
                                'id' =>'media-uploader-input'
                                ]) }}
                                <div class="form-group">
                                    {{ Form::label('description','Description') }}
                                    <div class="input-group mb-3">
                                        {{ Form::textarea('description',null,[
                                        'class'=>'form-control',
                                        ]) }}
                                    </div>

                                </div>
                                {{ Form::submit('Upload',[
                                'class' => 'btn btn-primary',
                                ]) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane  fade show active" id="nav-selector" role="tabpanel" aria-labelledby="nav-selector-tab">
                        <div class="card">
                            <div class="card-body">
                                <div class="gallery-container">

                                </div>
                                <button class="btn btn-primary pull-right" id="media-apply">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
