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
        <form action="{{route('order.update', $model->id)}}" method="post">
          @method('PUT')
          @else
          <form action="{{route('order.store')}}" method="post">
            @endif
            @csrf
            <div class="box-body">
              <div class="row">
                <div class="form-group col-md-6">
                  <label>Nomor Order</label>
                  <input type="text" class="form-control" name="number" value="{{isset($model) ? $model->number : old('number')}}">
                </div>
                <div class="form-group col-md-6">
                  <label>Distributor</label>
                  <input type="text" class="form-control" name="distributor" value="{{isset($model) ? $model->distributor : old('distributor')}}">
                </div>
                <div class="form-group col-md-6">
                  <label>Tanggal Order</label>
                  <input type="text" class="form-control pull-right" id="datepicker" name="order_date" value="{{isset($model) ? $model->order_date : old('order_date')}}">
                </div>
              </div>
              @if (!isset($model))
              <input type="submit" class="btn btn-primary btn-submit" value="submit" />
              @endif
          </form>
          @if (isset($model))
          <button class="btn btn-primary btn-modal" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i>&emsp;Tambah Item</button>
          @endif
      </div>
      <div class="box-body">
        <table class="table table-bordered" id="table-data" width="100%">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Nama Obat</th>
              <th>Harga</th>
              <th>Jumlah</th>
              <th width="10%">Tanggal Kadaluarsa</th>
              <th>Nomor Batch</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach($details as $key => $detail)
            <tr>
              <td>{{$key + 1}}</td>
              <td>{{$detail->item->name}}</td>
              <td>{{$detail->price}}</td>
              <td>{{$detail->qty}}</td>
              <td>{{$detail->expired_date}}</td>
              <td>{{$detail->batch_number}}</td>
              <td>{{$detail->total}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<style>
  .table-bordered th {
    font-size: 13px;
  }

  .table-bordered td {
    font-size: 12px;
  }
</style>
@endsection
@include('pages.purchase-order.modal-order')
@section('script')
<script>
  $(".itemId").select2({
    ajax: {
      url: "{{route('order.list-item')}}", // Replace with your actual endpoint URL
      dataType: 'json',
      delay: 250,
      data: function(params) {
        return {
          query: params.term, // Search term
        };
      },
      processResults: function(data, params) {
        return {
          results: data,
        };
      },
      cache: true
    },
    templateSelection: function(data, container) {
      // Add custom attributes to the <option> tag for the selected option
      $(data.element).attr('data-price', data.price);
      return data.text;
    },
    placeholder: 'Ketik nama obat',
    minimumInputLength: 3
  })

  $(".itemId").on('change', function() {
    let price = $(this).find(':selected').data('price')
    $(".price-item ").val(price)
  })

  $(".qty-item").on('keyup', function() {
    let total = $(".price-item").val() * $(this).val()
    $(".total-item").val(total)
  })

  $(".btn-modal").click(function(e) {
    e.preventDefault();
  })

  $('#modal-default').on('hidden.bs.modal', function() {
    $(".price-item").val('')
    $(".total-item").val('')
    $(".qty-item").val('')
    $(".batch-item").val('')
    $(".expired-item").val('')
    $(".itemId").select2('val', '')
  })
</script>
@endsection