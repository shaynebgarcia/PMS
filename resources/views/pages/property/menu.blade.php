<?php $slug = Request::path() ?>
<a href="{{ route('properties.index') }}" title="">
	<button class="btn btn-navi @if($slug=='properties') active @endif">List Properties</button>
</a>
<a href="{{ route('properties.create') }}" title="">
	<button class="btn btn-navi @if($slug=='properties/create') active @endif">Add Property</button>
</a>
<a href="#" title="">
	<button class="btn btn-navi @if($slug=='units') active @endif">List Units</button>
</a>