<!-- {{asset("admin/asset/bootstrap/dist/css/bootstrap.min.css")}}  -->
<!-- asset() sẽ đi vào folder public - >admin.... -->
@php
Use  App\Helpers\Form as FormTemplate; 
Use  App\Helpers\Template;    

$formInputAttr    = config('zvn.template.form_input');
$formLabelAttr    = config('zvn.template.form_label');
$formCkeditor     = config('zvn.template.form_ckeditor');
$inputHiddenID    = Form::hidden('id', $item['id']);
$inputHiddenThumb = Form::hidden('thumb_current', $item['thumb']);
$statusValue      = ['default'=>'Select Status','active'=>config('zvn.template.status.active.name'),'inactive'=>config('zvn.template.status.inactive.name')];
    $elements = [
    [
    'label'   =>Form::label('name', 'Name',        $formLabelAttr),
    'element' =>Form::text('name', $item['name'],   $formInputAttr),
    ], 
    [
    'label'   =>Form::label('content', 'Content', $formLabelAttr),
    'element' =>Form::textarea('content', $item['content'],$formCkeditor),
    ],
    [
    'label'   =>Form::label('status', 'Status', $formLabelAttr),
    'element' =>Form::select('status',$statusValue,$item['status'],$formInputAttr),
    ], [
    'label'   =>Form::label('category_id', 'category ID', $formLabelAttr),
    'element' =>Form::select('category_id',$itemsCategory,$item['category_id'],$formInputAttr),
    ],
    [
    'label'   =>Form::label('thumb', 'thumb',$formLabelAttr),
    'element' =>Form::file('thumb', $formInputAttr),
    'thumb' =>(!empty($item['id'])) ? Template::showItemsThumb($controllerName,$item['thumb'],$item['name']) : null, 'type'=>'thumb'
    ],
    [
    'element'   =>$inputHiddenID.$inputHiddenThumb.Form::submit('Save', ['class' => 'btn btn-success']),
    'type' =>'btn-submit'
    ]
];
echo '<pre style="color:red" hello>';
                print_r($itemsCategory);
                echo '</pre>'; 
@endphp
@extends('admin.main') @section('content')
@include('admin.templates.page_header',['pageIndex'=>false])
@include('admin.templates.error')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title',['title'=>'Form'])
            <div class="x_content">
                <br>
                <!-- cấu hÌNH LẠI FORM -->
                {!! Form::open([
                    'method'         => 'POST',
                    'url'            => route("$controllerName/save"),
                    'accept-charset' => 'UTF-8',
                    'enctype'        => 'multipart/form-data',
                    'class'            => 'form-horizontal form-lable-left',
                    'id'            => 'main-form' ]) 
                    !!}
                    {!! FormTemplate::show($elements)!!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @endsection