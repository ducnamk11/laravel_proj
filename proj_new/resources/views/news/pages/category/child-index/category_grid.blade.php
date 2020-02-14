
<div class="posts">
	<div class="col-lg-12">
		<div class="row">
			@foreach($item['articles'] as $key=>$article)
			<div class="col-lg-6">
				<div class="post_item post_v_small d-flex flex-column align-items-start justify-content-start">
					@include('news.partials.article.image',['itemsFeatured'=>$article])
					@include('news.partials.article.content',['itemsFeatured'=>$article,'lengthContent'=>220,'showCategory'=>false])
				</div>
			</div>
			@endforeach
			
		</div>
		<div class="row">
			<div class="home_button mx-auto text-center"><a href="the-loai/giao-duc-2.html">Xem
			thêm</a></div>
		</div>
	</div>
</div>
</div>
