@extends('default')
@section('content_header')
<x-title-bar title="{{$title}}" />
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        @if (isset($model))
        <form action="{{route('item.update', $model->id)}}" method="post" enctype="multipart/form-data">
          @method('PUT')
          @else
          <form action="{{route('item.store')}}" method="post" enctype="multipart/form-data">
            @endif
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="box-body col-md-8">
                  <div class="form-group">
                    <label>Nama Obat</label>
                    <input type="text" class="form-control input-sm" name="name" value="{{isset($model) ? $model->name : old('name')}}">
                  </div>
                  <div class="form-group">
                    <label>Generik</label>
                    <input type="text" class="form-control input-sm" name="generic" value="{{isset($model) ? $model->generic : old('generic')}}">
                  </div>
                  <div class="form-group">
                    <label>Harga</label>
                    <input type="number" class="form-control input-sm" name="price" value="{{isset($model) ? $model->price : old('price')}}">
                  </div>
                  <div class="form-group">
                    <div class="radio">
                      <label style="margin-right: 20px;">
                        <input type="radio" name="status" id="optionsRadios1" value="1" {{isset($model) ? $model->status == 1 ? 'checked' : '' : 'checked'}}>
                        Aktif
                      </label>
                      <label>
                        <input type="radio" name="status" id="optionsRadios2" value="0" {{isset($model) ? $model->status == 0 ? 'checked' : '' : ''}}>
                        Non Aktif
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Satuan Obat</label>
                    <select class="form-control select2" name="med_unit_id" id="med_unit_select">
                    </select>
                  </div>
                  <input type="submit" class="btn btn-primary btn-submit" value="submit" />
                </div>
          </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
  $(document).ready(function() {
    $("#med_unit_select").select2({
      ajax: {
        url: "{{route('unit-medicine.dropdown')}}", // Replace with your actual endpoint URL
        dataType: 'json',
        delay: 250,
        data: function(params) {
          return {
            q: params.term, // Search term
            page: params.page
          };
        },
        processResults: function(data, params) {
          return {
            results: data.data,
            pagination: {
              more: (params.page * 30) < data.data.total_count
            }
          };
        },
        cache: true
      },
      placeholder: 'Cari Satuan Obat',
      minimumInputLength: 1
    })
  })
</script>
@endsection