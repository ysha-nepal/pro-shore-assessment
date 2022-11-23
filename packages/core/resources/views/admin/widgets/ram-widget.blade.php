<div class="col">
    <div class="card radius-10 border-0 border-start border-success border-3">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="">
                    <p class="mb-1">{{__('core::admin.dashboard.ram_usage')}}</p>
                    <h4 class="mb-0 text-success">{{ get_server_memory_usage() }}</h4>
                </div>
                <div class="ms-auto widget-icon bg-success text-white">
                    <i class="bi bi-memory"></i>
                </div>
            </div>
        </div>
    </div>
</div>
