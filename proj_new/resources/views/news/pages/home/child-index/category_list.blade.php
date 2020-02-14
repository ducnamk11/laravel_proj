<div class="technology">
	<div class="section_title_container d-flex flex-row align-items-start justify-content-start">
		<div>
			<div class="section_title">{{$item['name']}}</div>
		</div>
		<div class="section_bar"></div>
	</div>
	<div class="technology_content">

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