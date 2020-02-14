 
@if($item['display']=='list')
@include('news.pages.category.child-index.category_list')
@elseif($item['display']=='grid')
@include('news.pages.category.child-index.category_grid')
@endif
<div class="posts">
	<div class="post_item post_h_large">
		<div class="row">
			<div class="col-lg-5">
				<div class="post_image"><img src="images/article/iQ1RXPioFZ.jpeg" alt="images/article/iQ1RXPioFZ.jpeg" class="img-fluid w-100"></div>
			</div>
			<div class="col-lg-7">
				<div class="post_content">
					<div class="post_category cat_technology  d-none ">
						<a href="the-loai/the-thao-1.html">Thể thao</a>
					</div>
					<div class="post_title"><a href="bai-viet/bottas-gianh-pole-chang-thu-ba-lien-tiep-5.html">Bottas
					giành pole chặng thứ ba liên tiếp</a></div>
					<div class="post_info d-flex flex-row align-items-center justify-content-start">
						<div class="post_author d-flex flex-row align-items-center justify-content-start">
							<div class="post_author_name"><a href="the-loai/the-thao-1.html#">Lưu Trường Hải Lân</a>
							</div>
						</div>
						<div class="post_date"><a href="the-loai/the-thao-1.html#">28/04/2019</a>
						</div>
					</div>
					<div class="post_text">
						<p>Tay đua Phần Lan đánh bại đồng đội Lewis Hamilton ở vòng phân hạng GP Tây Ban Nha hôm 11/5. Valtteri Bottas nhanh hơn Hamilton 0,634 giây và nhanh hơn người về thứ ba&nbsp;Sebastian Vettel 0,866 giây. Tay đua của Red Bull&nbsp;Max Verstappen nhanh thứ tư, trong khi&nbsp;Charles Leclerc về thứ...
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>