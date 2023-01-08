@extends('ViewPage.viewpage')
@section('content')
<div class="chart_header">
    <div class="in_chart_header">
        <?php 
        $sum = 0
        ?>
        @foreach ($orders as $order)
            @foreach ($order->orderItem as $orderItem)
            <?php
            $sum += $orderItem->total_price 
            ?> 
            @endforeach
        @endforeach
        <p><i class="fa-solid fa-sack-dollar"></i> Tổng tiền đã thu  </p>
        <p>{{ number_format($sum,0,'.','.')}} đ</p>
    </div>
    <div class="in_chart_header">
        <p><i class="fa-solid fa-truck-ramp-box"></i> Tổng đơn hàng </p>
        <p>{{ count($orders) }}</p>
    </div>
    <div class="in_chart_header">
        <p><i class="fa-solid fa-box-open"></i> Số sản phẩm đã bán</p>
        <p>{{ count($products) }}</p>
    </div>
</div>
<div class="chart_body">
    <?php 
    $i = 0
    ?>
    @foreach($products as $product)
        @if($product->sold_out !== null)
            <?php 
            $i++
            ?>
            <div class="in_chart_body">
                <div style="width:{{ $product->sold_out }}00px" class="chart_product_sold"></div>
                <p>{{ $product->name }}-{{ $product->id }}</p>
            </div>
        @endif
        @if($i == 5)
            @break
        @endif
    @endforeach
</div>
<div class="chart_footer">
    <p>Biểu đồ Số lượng sản phẩm đã bán</p>
</div>
@endsection