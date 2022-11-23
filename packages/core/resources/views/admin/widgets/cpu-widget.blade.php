<div class="col">
    <div class="card radius-10 border-0 border-start border-tiffany border-3">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="">
                    <p class="mb-1">{{__('core::admin.dashboard.cpu_usage')}}</p>
                    <h4 class="mb-0 text-tiffany">{{ get_server_cpu_usage() }} %</h4>
                </div>
                <div class="ms-auto widget-icon bg-tiffany text-white">
                    <i class="bi bi-cpu"></i>
                </div>
            </div>
        </div>
    </div>
</div>
