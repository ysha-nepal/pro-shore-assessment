@inject('menu_helper','Core\Helpers\MenuHelper')
<fieldset class="menu-order-ul mb-2">
    <legend>{{__('core::setting.menu.menu_order')}}</legend>
    <ul id="sortable" class="list-unstyled" data-url="{{ route('api.menus.order') }}">
        @foreach($menu_helper->getMenuOrder() as $menu)
        <li id={{"item-$menu->id" }} value={{ $menu->id }} data-parent={{ $menu->parent_id }} data-status={{
            $menu->status }} class="ui-state-default {{ $menu->parent_id != "0" ? 'sortable-child-menu ms-3' :
            'sortable-parent-menu' }}">
            <span>
                <label>
                    <input data-menu={{ "#item-$menu->id" }} type="checkbox" class="filled-in" {{ $menu->status =="1" ?
                    "checked" : "" }} />
                </label>
            </span>
            {{ __($menu->package.'::menu.sidebar.'.$menu->display_name )}}
        </li>
        @endforeach
    </ul>
</fieldset>
