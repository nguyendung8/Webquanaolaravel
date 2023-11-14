@extends('backend.master')
@section('title', 'Danh sách đơn hàng')
@section('main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .order-item {
        border: 1px solid #337AB7;
        padding: 11px;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.15) !important;
        margin-bottom: 10px;
        border-radius: 4px;
    }
    .close-btn {
        font-size: 21px;
        color: #337ab7;
        float: right;
        cursor: pointer;
    }
    .update-status {
        background: #337ab7;
        color: #fff;
        border: navajowhite;
        border-radius: 5px;
        cursor: pointer;
        padding: 0 13px;
        display: flex;
        align-items: center;
    }
    .update-status:hover {
        opacity: 0.9;
    }
    .panel-body #pagination {
        display: flex;
        justify-content: center;
    }
    .done {
        color: #0acb0a;
        font-size: 18px;
    }
</style>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Đơn hàng</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-xs-12 col-md-5 col-lg-9">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Danh sách đơn hàng
                    </div>
                    <form action="" method="post" class="panel-body">
                        @csrf
                        @foreach($orders as $order)
                        <div class="order-item">
						    <a href="{{ asset('admin/order/delete/' . $order->id) }}" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?')"><i class="fa fa-times close-btn" aria-hidden="true"></i></a>
                            <label class="customer-name">Tên khách hàng: </label>
                                {{ $order->name }}
                            <br>
                            <label class="customer-name">Email: </label>
                                {{ $order->email }}
                            <br>
                            <label class="customer-phone">Số điện thoại liên hệ: </label>
                                {{ $order->phone }}
                            <br>
                            <label class="customer-phone">Địa chỉ: </label>
                                {{ $order->address }}
                            <br>
                            <label class="customer-phone">Sản phẩm: </label>
                                {{ $order->total_products }}
                            <br>
                            <label class="customer-question">Tổng tiền: </label>
                                {{  $order->total_price }} đ
                            <br>
                            <label class="customer-phone">Ngày đặt hàng: </label>
                            {{ $order->placed_order_date }}
                            <br>
                            <label class="customer-phone">Trạng thái đơn hàng: </label>
                            <div style="display: flex; gap: 10px;">
                                @if($order->order_status == 'Hoàn thành')
                                <p class="done">Hoàn thành</p>
                                @else
                                <select style="width: fit-content;cursor: pointer;" required name="order-status" class="form-control">
                                    @if($order->order_status == 'Chờ xác nhận')<option value="Chờ xác nhận" @if($order->order_status == 'Chờ xác nhận') selected  @endif>Chờ xác nhận @endif</option>
                                    <option value="Đã xác nhận" @if($order->order_status == 'Đã xác nhận') selected  @endif>Đã xác nhận</option>
                                </select>
                                <a href="{{ asset('admin/order/update-status/' . $order->id) }}" class="update-status">Cập nhật</a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        <div id="pagination">
                            {{ $orders->links('vendor.pagination.default') }}
                        </div>
                    </form>
                </div>
			</div>
		</div>
	</div>
@stop
