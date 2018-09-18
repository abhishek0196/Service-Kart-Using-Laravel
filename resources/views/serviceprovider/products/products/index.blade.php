@inject('request', 'Illuminate\Http\Request')
@extends('serviceprovider.layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.products.title')</h3>
    
    <p>
        <a href="{{ route('products.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
  <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($products) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                    
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                    

                        <th>@lang('quickadmin.products.fields.name')</th>
                        <th>@lang('quickadmin.products.fields.description')</th>
                        <th>@lang('quickadmin.products.fields.price')</th>
                        <th>@lang('quickadmin.products.fields.category')</th>
                        <th>@lang('quickadmin.products.fields.tag')</th>
                        <th>@lang('quickadmin.products.fields.photo1')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                  <tbody>
                    @if (count($products) > 0)
                        @foreach ($products as $product)
                        
                                <tr data-entry-id="{{ $product->id }}">
                               
                                    <td></td>
                               

                                <td field-key='name'>{{ $product->name }}</td>
                                <td field-key='description'>{!! $product->description !!}</td>
                                <td field-key='price'>{{ $product->price }}</td>
                                <td field-key='category'>
                                    @foreach ($product->category as $singleCategory)
                                        <span class="label label-info label-many">{{ $singleCategory->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='tag'>
                                    @foreach ($product->tag as $singleTag)
                                        <span class="label label-info label-many">{{ $singleTag->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='photo1'>@if($product->photo1)<a href="{{ asset(env('UPLOAD_PATH').'/' . $product->photo1) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $product->photo1) }}"/></a>@endif</td>
                                                                <td>
                                    
                                    <a href="{{ route('products.show',[$product->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    
                                    
                                    <a href="{{ route('products.edit',[$product->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    
                                    
                                    {!! Form::open(array('style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['products.destroy', $product->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        
            window.route_mass_crud_entries_destroy = '{{ route('products.mass_destroy')}}';
  

    </script>
@endsection