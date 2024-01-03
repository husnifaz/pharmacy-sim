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
        <form action="{{route('prescription.update', $model->id)}}" id="form-order" method="post">
          @method('PUT')
          @else
          <form action="{{route('prescription.store')}}" method="post">
            @endif
            @csrf
            <div class="row">
              <div class="form-group col-md-4">
                <label>Tanggal Order</label>
                <input type="date" class="form-control pull-right" name="order_date" value="{{isset($model) ? $model->order_date : old('order_date')}}" {{isset($model) ? 'disabled' : ''}}>
              </div>
              @if (isset($model))
              <div class="form-group col-md-4">
                <label style="margin-bottom: 15px;">Nomor Penjualan</label>
                <br>
                <p>{{$model->number}}</p>
              </div>
              <div class="form-group col-md-4">
                <label style="margin-bottom: 15px;">Status</label>
                <br>
                <p class="label {{$model->status_bg}}" style="font-size: 14px;">{{$model->status_label}}</p>
              </div>
              @endif
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label>Remarks</label>
                <textarea class="form-control" name="remarks" rows="5" {{isset($model) ? 'disabled' : ''}}>{{isset($model) ? $model->remarks : old('remarks')}}</textarea>
              </div>
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
                <td>{{$detail->quantity}}</td>
                <td>{{$detail->expired_date}}</td>
                <td>{{$detail->batch_number}}</td>
                <td>{{$detail->total}}</td>
                <td class="text-center">
                  <form action="{{route('prescription.delete-child', ['id' => $detail->id])}}" method="post" style="margin-bottom: 0;">
                    @csrf
                    <button class="btn btn-danger btn-sm delete-child"><i class="fa fa-trash"></i></button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @if (isset($model))
          <form action="{{route('prescription.finish-prescription', ['id' => $model->id])}}" method="post">
            @csrf
            <button class="btn btn-primary pull-right btn-submit" id="finish-order"><i class="fa fa-check"></i>&emsp;Selesaikan Order</button>
          </form>
          @endif
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
  @include('pages.prescription.modal-order')
  @section('script')
  <script>
    $(".select-item").select2({
      ajax: {
        url: "{{route('prescription.list-item')}}", // Replace with your actual endpoint URL
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
      minimumInputLength: 1
    })

    $(".select-item").on('change', function() {
      let price = $(this).find(':selected').data('price')
      let itemId = $(this).find(':selected').val()

      $(".price-item ").val(price)
      $(".select-expired").prop('disabled', false)

      $(".select-expired").select2({
        ajax: {
          url: "{{route('prescription.list-item-stock')}}", // Replace with your actual endpoint URL
          dataType: 'json',
          data: function(params) {
            return {
              item_id: itemId, // Search term
            };
          },
          processResults: function(data, params) {
            return {
              results: $.map(data, function(item) {
                return {
                  id: item.expired_date, // Use custom_id as the id
                  text: item.expired_date // Use custom_text as the text
                };
              })
            };
          },
          cache: true
        }
      })
    })

    $(".select-expired").on('change', function() {
      let ed = $(this).find(':selected').val()
      $(".select-batch").prop('disabled', false)
      $(".select-batch").select2({
        ajax: {
          url: "{{route('prescription.list-item-stock')}}", // Replace with your actual endpoint URL
          dataType: 'json',
          data: function(params) {
            return {
              item_id: $('.select-item').find(':selected').val(), // Search term
              expired_date: ed
            };
          },
          processResults: function(data, params) {
            return {
              results: $.map(data, function(item) {
                return {
                  id: item.id, // Use custom_id as the id
                  text: item.batch_number,
                };
              })
            };
          },
          cache: true
        }
      })
    })

    $(".select-batch").on('change', function() {
      let stockId = $(this).find(':selected').val()
      $("#stock_id").val(stockId)
    })

    $(".select-medicine-uses").select2({
      ajax: {
        url: "{{route('prescription.list-medicine-uses')}}", // Replace with your actual endpoint URL
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
      }
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
      $(".select-item").val('').trigger('change')
      $(".select-expired").val('').trigger('change')
      $(".select-batch").val('').trigger('change')
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