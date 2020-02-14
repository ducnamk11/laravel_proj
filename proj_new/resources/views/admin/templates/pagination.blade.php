@php 
$totalItems = $items->total(); // $items được kéo ra từ controlerr.(kéo ra view(view có index (index có panigation.blade)))
$totalPages = $items->lastPage(); //các hàm này được laravel hỗ trợ
$totalItemsPerPage = $items->perPage(); //các hàm này được laravel hỗ trợ
@endphp
<div class="x_content">
	<div class="row">
		<div class="col-md-6">
			<p class="m-b-0">
				ItemsPerPage: <span class="label label-info label-pagination "><b> {{$totalItemsPerPage}} </b> </span>&nbsp&nbsp
				TotalItems: <span class="label label-success label-pagination"><b> {{$totalItems}} </b> </span>&nbsp&nbsp
				totalPages: <span class="label label-danger label-pagination"><b> {{$totalPages}} </b> </span>&nbsp&nbsp
			</p> 
		</div>
		<div class="col-md-6">
 			{{ $items->appends(request()->input())->links('pagination/pagination_backend') }}
			<!-- in ra pagination , được custommize o panigation_zvn -->
		</div>
	</div>
</div>