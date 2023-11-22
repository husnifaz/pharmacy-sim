@extends('default')

@section('content_header')
<x-title-bar title="{{$title}}" />
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="col-md-6 col-xs-6" style="margin-top: 10px;">
        <a href="menu/form" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span>&emsp;Tambah Data</a>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-hover" id="data1">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Nama Menu</th>
              <th>Url</th>
              <th width="5%">Order</th>
              <th>Ikon</th>
              <th width="20%">Parent Menu</th>
              <th width="10%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($model as $key => $item)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$item->name}}</td>
              <td>{{$item->url}}</td>
              <td>{{$item->order}}</td>
              <td>{{$item->icons}}</td>
              <td>{{$item->menuParent ? $item->menuParent->name : ''}}</td>
              <td class="text-center">
                <div class="btn-group">
                  <a href="menu/edit/{{$item->id}}" class="btn bg-orange btn-xs"><span class="fa fa-edit"></span></a>
                  <a class="btn btn-danger btn-xs" onClick="confirm('Apakah Anda Yakin ?')" href="menu/delete/{{$item->id}}"><span class="fa fa-trash"></span></a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
@endsection