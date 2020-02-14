
@extends('news.main')
@section('content')
<div class="section-category">

	<div class="content_container container_category">
		<div class="featured_title">
			<div class="container">
				<div class="row">
					<!-- Main Content -->
					<div class="col-lg-9">
						<div class="single_post">
							@include('news.pages.article.child-index.article',['item'=>$itemsArticle])
							@include('news.pages.article.child-index.related')
						</div>
					</div>
					<!-- Sidebar -->
					<div class="col-lg-3">
						<div class="sidebar">
							<!-- Latest Posts -->

							@include('news.block.latest_posts',['itemsLatest'=>$itemsLatest])

							<!-- Advertisement -->
							<!-- Extra -->
							@include('news.block.advertisement',['itemsAdvertisemnet'=>[]])

							<!-- Most Viewed -->
							@include('news.block.most_viewed',['itemsMostViewed'=>[]])

							<!-- Tags -->
							@include('news.block.tags',['itemsTags'=>[]])
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection