@php
use App\Helpers\Template as Template;
$name               = $itemsFeatured['name'];
$thumb              = asset('images/article/'.$itemsFeatured['thumb']);

@endphp
<div class="post_image"><img src="{{$thumb}}" alt="{{$name}}" class="img-fluid w-100"></div>
