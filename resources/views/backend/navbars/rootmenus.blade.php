<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        @foreach($menus as $index => $menu)
        <li @if(($menu->id == "1" && !$navbar->exists) || $navbar->isSelfOrDescendantOf($menu)) class="active" @endif><a href="{!! route('admin.navbars.show', $menu) !!}">{{$menu->name}}</a></li>
        @endforeach
        <li><a href="{{ route('admin.navbars.create') }}" data-target="menu-entry"><i class="fa fa-plus-circle"></i></a></li>
    </ul>
    <div class="tab-content">
        @foreach($menus as $index => $menu)
        @if(($menu->id == "1" && !$navbar->exists) || $navbar->isSelfOrDescendantOf($menu))
        <div class="tab-pane  active" id="menu_{{$menu->id}}">
            <div class="dd" id="nestable" data-root="{{$menu->id}}">
                @include('backend.navbars.partial', ['menu' => $menu])
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>


@section('after-scripts-end')
<script>
$(document).ready(function() {
    $('.dd').nestable().on('change', function(e) {
        var list   = e.length ? e : $(e.target);
        var rootId = $(e.target).data('root');
        var children = list.nestable('serialize');
        $.ajax({
            url: '/admin/navbars/orders',
            type: 'post',
            data: {rootId: rootId, children: children},
            success: function(resp) {
                if(resp.success) {
                    toastr.success(resp.message);
                } else {
                    toastr.error(resp.message);
                }
            }
        })
    });
});
</script>
@stop