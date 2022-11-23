<div class="col">
    <div class="card radius-10 border-0 border-start border-pink border-3">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="">
                    <p class="mb-1">{{__('core::admin.dashboard.remaining_disk')}}</p>
                    <h4 class="mb-0 text-pink">{{ get_disk_free_space   () }}</h4>
                </div>
                <div class="ms-auto widget-icon bg-pink text-white">
                    <i class="bi bi-device-hdd"></i>
                </div>
            </div>
        </div>
    </div>
</div>
