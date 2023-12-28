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
        <form action="{{route('order.update', $model->id)}}" id="form-order" method="post">
          @method('PUT')
          @else
          <form action="{{route('order.store')}}" method="post">
            @endif
            @csrf
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
                <input type="text" class="form-control pull-right" id="datepicker-order" name="order_date" value="{{isset($model) ? $model->order_date : old('order_date')}}">
              </div>
              @if (isset($model))
              <div class="form-group col-md-6">
                <label style="margin-bottom: 15px;">Status</label>
                <br>
                <p class="label bg-green" style="font-size: 14px;">{{$model->status_label}}</p>
              </div>
              @endif
            </div>
            @if (!isset($model))
            <input type="submit" class="btn btn-primary btn-submit" value="submit" />
            @endif
          </form>
          @if (isset($model))
          <button class="btn btn-primary btn-modal" data-toggle="modal" data-target="#modal-default" style="margin-bottom: 2rem;"><i class="fa fa-plus"></i>&emsp;Tambah Item</button>
          @endif
          <table class="table table-bordered" style="margin-bottom: 2rem;">
            <thead>
              <tr>
                <th width="5%">No</th>
                <th>Nama Obat</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th width="10%">Tanggal Kadaluarsa</th>
                <th>Nomor Batch</th>
                <th>Total</th>
                <th width="2%">#</th>
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
                <td class="text-center">
                  <form action="{{route('order.delete-child', ['id' => $detail->id])}}" method="post" style="margin-bottom: 0;">
                    @csrf
                    <button class="btn btn-danger btn-sm delete-child"><i class="fa fa-trash"></i></button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <form action="{{route('order.finish-order', ['id' => $model->id])}}" method="post">
            @csrf
            <button class="btn btn-primary pull-right btn-submit" id="finish-order"><i class="fa fa-check"></i>&emsp;Selesaikan Order</button>
          </form>
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
        $(data.element).attr('data-price', data.order_price);
        return data.text;
      },
      placeholder: 'Ketik nama obat',
      minimumInputLength: 1
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
      $(".itemId").val('').trigger('change')
    })

    $('#datepicker-order').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
    })

    $('#datepicker-expired').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
    })

    $('.delete-child').on('click', function(e) {
      e.preventDefault()
      let idChild = $(this).data('id')
      Swal.fire({
        title: "Apakah anda yakin ?",
        text: "Data item akan dihapus dari daftar",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          this.closest("form").submit()
        }
      })
    })
  </script>
  @endsection