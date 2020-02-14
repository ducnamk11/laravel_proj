@php
use App\Helpers\Template as Template;
use App\Helpers\URL;
$name         = $itemsFeatured['name'];
$linkCategory = '#';
$linkArticle = '#';
$created      = Template::showDateTimeFrontEnd($itemsFeatured['created']);
$content      = Template::showContent($itemsFeatured['content'],$lengthContent)
@endphp
<!-- không lấy được category[id] -->
<!-- $linkCategory =  URL::linkCategory($itemsFeatured['category_id'],$itemsFeatured['name']); -->
<!-- $linkArticle =  URL::linkArticle($item['id'],$item['category_name']); -->
<!--  -->

<div class="post_content">
  @if($showCategory)
  <div class="post_category cat_technology "> <a href="{{$linkCategory}}">{{$itemsFeatured['category_name']}}</a>    </div> 
  @endif
  <div class="post_title"><a href="{{$linkArticle}}">{{$name}}</a></div>
  <div class="post_info d-flex flex-row align-items-center justify-content-start">
    <div class="post_author d-flex flex-row align-items-center justify-content-start">
      <div class="post_author_image"><img src="{{'news/images/author_1.jpg'}}/" alt=""></div>
      <div class="post_author_name"><a href="#">Ducnamjr</a>
      </div>
    </div>
    <div class="post_date"><a href="#">{{$created}}</a></div>
  </div>
  @if($lengthContent>0)
  <div class="post_text">
    <p>{{$content}}
    </p>
  </div>
  @endif
</div>