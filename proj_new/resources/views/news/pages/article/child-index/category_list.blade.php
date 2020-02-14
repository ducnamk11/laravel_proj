	<div class="posts">
		@foreach($item['articles'] as $key=>$article)
		<div class="post_item post_h_large">
			<div class="row">
				<div class="col-lg-5">
					@include('news.partials.article.image',['itemsFeatured'=>$article])
				</div>
				<div class="col-lg-7">
					<div class="post_content">            
						@include('news.partials.article.content',['itemsFeatured'=>$article,'lengthContent'=>220,'showCategory'=>false])
					</div>
				</div>
			</div>
		</div>
		@endforeach
		
		<div class="row">
			<div class="home_button mx-auto text-center"><a href="the-loai/the-thao-1.html">Xem
			thêm</a></div>
		</div>
	</div>
</div>