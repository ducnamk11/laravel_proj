
<div class="featured">
    <div class="featured_title">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title_container d-flex flex-row align-items-start justify-content-start">
                        <div>
                            <div class="section_title">Nổi bậc</div>
                        </div>
                        <div class="section_bar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured Title -->
    <div class="row">
        <div class="col-lg-8">
            <!--   bài viết lớn bên trái -->
            <div class="post_item post_v_large d-flex flex-column align-items-start justify-content-start">
                <div class="post_item post_v_small d-flex flex-column align-items-start justify-content-start">
                    @include('news.partials.article.image',['itemsFeatured'=>$itemsFeatured[0]])
                    @include('news.partials.article.content',['itemsFeatured'=>$itemsFeatured[0],'lengthContent'=>500, 'showCategory'=>false])
                </div>
            </div>
        </div>
        <!-- các bài viết nhỏ bên phải -->
        <div class="col-lg-4">
          @php unset($itemsFeatured[0]) @endphp
          @foreach($itemsFeatured as $item)
          <div>
            <div class="post_item post_v_small d-flex flex-column align-items-start justify-content-start">
                @include('news.partials.article.image',['itemsFeatured'=>$item])
                @include('news.partials.article.content',['itemsFeatured'=>$item,'lengthContent'=>0,'showCategory'=>false])
            </div>
        </div>
        @endforeach


    </div>
</div>
</div>