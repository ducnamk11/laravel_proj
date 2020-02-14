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
                    <th class="column-title">hiển thị Home</th>
                    <th class="column-title">Status</th>
                    <th class="column-title">hiển thị</th>
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Tạo mới</th>
                    <th  class="column-title">Chỉnh sửa</th>
                </tr>
            </thead>
            <tbody>

<?php 

// echo '<pre>';
//  print_r($items);
//  echo '</pre>';     ?>

             @if (count($items) >0)

                @foreach ($items as $key=>$val)
                @php
                $index           = $key+1;
                $class           = ($index%2==0) ? 'even' :'odd'; 
                $id              = $val['id'] ;
                $name            = Hightlight::show($val['name'],$params['search'],'name');
                $status          = Template::showItemsStatus($controllerName,$id,$val['status']);
                $isHome          = Template::showItemsIsHome($controllerName,$id,$val['is_home']);
                $display          = Template::showItemsSelect($controllerName,$id,$val['display'],'display');
                $createdHistory  = Template::showItemsHistory($val['created_by'],$val['created']);
                $modifiedHistory = Template::showItemsHistory($val['modified_by'],$val['modified']);
                $listBtnAction   = Template::showButtonAction($controllerName,$id);
                @endphp
                <tr class="{{$class}} pointer">
                    <td class="">{{$index}}</td>
                    <td width="15%">{!!$name!!}</td>
                    <td>{!! $isHome!!}</td> 
                    <td>{!! $status!!}</td> 
                    <td>{!! $display!!}</td> 
                    <td>{!! $createdHistory!!}</td>
                    <td>{!! $modifiedHistory!!}</td>
                    <td width="18%" class="last">{!! $listBtnAction!!}   </td>
                </tr>
                @endforeach

                @else @include('admin.templates.list_empty',['colspan'=>10])
                <!-- chỉ số colspan phụ thuộc vào số cột -->
                @endif
            </tbody>
        </table>
    </div>
</div>