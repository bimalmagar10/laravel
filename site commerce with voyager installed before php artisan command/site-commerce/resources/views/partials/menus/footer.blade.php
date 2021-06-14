<ul>
    @foreach($items as $menu_item)
         @if($menu_item->title == 'Follow Me')
        
          <li><a href="{{ $menu_item->link()}}" target="_blank">{{ $menu_item->title}}</a></li>
        @endif
        <li><a href="{{ $menu_item->link() }}" target="_blank"><i class="fa {{ $menu_item->title}}"></i></a></li>
    @endforeach
</ul>