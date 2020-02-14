@php
use App\Helpers\Template as Template;
use App\Helpers\Hightlight as Hightlight;
@endphp

<div class="x_content">
    <div class="table-responsive">
        <!-- $items từ slider controller - >view-->
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Name</th>
                    <th class="column-title">Thumb</th>
                    <th class="column-title">Status</th>
                    <th class="column-title">Type</th>
                    <th class="column-title">Category</th>
                    <th class="column-title">Trạng thái</th>
            <!--         <th class="column-title">Tạo mới</th>
                <th  class="column-title">Chỉnh sửa</th> -->
            </tr>
        </thead>
        <tbody> @if (count($items) >0)
           @foreach ($items as $key=>$val)
           @php
           $index         = $key+1;
           $class         = ($index%2==0) ? 'even' :'odd'; 
           $id            = $val['id'] ;
           $name          = Hightlight::show($val['name'],$params['search'],'name');
           $content       = Hightlight::show($val['content'],$params['search'],'content');
           $status        = Template::showItemsStatus($controllerName,$id,$val['status']);
           $category      = $val['category_name'];
           $type          = Template::showItemsSelect($controllerName,$id,$val['type'],'type');
           $thumb         = Template::showItemsThumb($controllerName,$val['thumb'],$val['name'])  ;
           $listBtnAction = Template::showButtonAction($controllerName,$id);
           @endphp
                <!-- 
                // $createdHistory  = Template::showItemsHistory($val['created_by'],$val['created']);
                // $modifiedHistory = Template::showItemsHistory($val['modified_by'],$val['modified']); 
               
            -->
            <tr class="{{$class}} pointer">
                <td class="">{{$index}}</td>
                <td width="25%">
                    <p><strong>Name: </strong>{!!$name!!}</p>
                    <p><strong>Content: </strong>{!!substr($content, 0,200).'...'; !!}</p>
                </td>
                <td width="15%">{!! $thumb!!}</td> 
                <td>{!! $status!!}</td> 
                <td>{!! $type!!}</td> 
                <td>{!! $category!!}</td> 
                <td width="10%" class="last">{!! $listBtnAction!!}   </td>
            </tr>
            @endforeach

            @else @include('admin.templates.list_empty',['colspan'=>10])
            <!-- chỉ số colspan phụ thuộc vào số cột -->
            @endif
        </tbody>
    </table>
</div>
</div>