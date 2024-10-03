@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-35">Category</h3>
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="rs-select2--light rs-select2--md">
                            <select class="js-select2" name="property">
                                <option selected="selected">All Properties</option>
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <div class="rs-select2--light rs-select2--sm">
                            <select class="js-select2" name="time">
                                <option selected="selected">Today</option>
                                <option value="">3 Days</option>
                                <option value="">1 Week</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <button class="au-btn-filter">
                            <i class="zmdi zmdi-filter-list"></i>filters</button>
                    </div>
                    <form class="au-form-icon" action="{{route('admin.category.index')}}" method="GET">
                        <input class="au-input--w300 au-input--style2" name="search" value="{{ request('search')}}" type="text"
                            placeholder="Search for datas &amp; reports..." />
                        <button class="au-btn--submit2" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                    <div class="table-data__tool-right">
                       <a href="{{route('admin.category.create')}}">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>Create</button>
                       </a>
                       
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listcategory as $index => $item)
                            <tr class="tr-shadow">
                                <td>{{$index + 1}}</td>
                                <td>
                                    <img src="{{asset('storage/'.$item->image)}}" alt="" width="100px">
                                </td>
                                <td class="desc">{{$item->name}}</td>
                                <td>
                                    <div class="table-data-feature">
                                       
                                       <a href="{{route('admin.category.edit', $item->id)}}"> <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button></a>
                                       <form action="{{route('admin.category.destroy', $item->id)}}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                       </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
