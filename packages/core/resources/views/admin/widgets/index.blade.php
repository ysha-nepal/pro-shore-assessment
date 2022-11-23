<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xxl-3">
   @foreach($widgets as $widget => $permission)
       @can($permission)
            @include("$package::admin.widgets.$widget")
        @endcan
   @endforeach
</div>
