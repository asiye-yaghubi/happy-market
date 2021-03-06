@extends('admin.layouts.app')

@section('header-title')
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i> خانه</a></li>
        <li class="active">  کامنت ها</li>
    </ol>
</section>
@endsection

@section('content')
<section class="content">

    @if(session()->has('msg'))
    <div class="col-md-9">
        <div class="box box-info box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">پیام جدید</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            {{ session('msg')}} 
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      @endif

    <div class="col-md-9">
    <a class="btn btn-app bg-green" href="{{ Route('comment.create') }}">
        <i class="fa fa-save "></i> افزودن
    </a>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست  کامنت های وب سایت </h3>

                    <div class="box-tools">
                        <form class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="comment" class="form-control pull-right" placeholder="جستجو">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>ردیف</th>
                                <th>متن کامنت  </th>
                                <th>نام محصول/
                                عنوان مقاله</th>
                                <th>  کاربر</th>
                                <th>تاریخ کامنت</th>
                                <th>ویرایش</th>
                                <th>حذف</th>
                            </tr>
                            @foreach($comments as $comment)
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td><a  href="{{ route('comment.show',['comment'=>$comment->id]) }}">{{ $comment->comment }}</a>
                                </td>
                                <td>
                                    @foreach($comment->products as $item) 
                                    {{ $item->name }},
                                    @endforeach
                                    @foreach($comment->articles as $item) 
                                    {{ $item->title }},
                                    @endforeach
                                </td>
                                <td>
                                    {{ $comment->user->name}}
                                 </td>
                                 <td>
                                    {{ Verta::instance($comment->created_at)->format('Y/n/j') }}
                                 </td>
                              
                                <td>
                                <a class="btn bg-blue" href="{{ route('comment.edit',['comment'=>$comment->id]) }}" >
                                <i class="fa fa-edit"></i> 
                                </a>
                                </td>
                                <td>
                                <form action="{{ Route('comment.destroy',['comment'=>$comment->id]) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('delete')}}
                                <button type="submit" class="btn bg-red" >
                                    <i class="fa fa-trash"></i> 
                                </button>
                                </form>   
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $comments->links() }}
            </div>
        </div>
    </div>
    
</section>
@endsection