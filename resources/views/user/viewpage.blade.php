@extends('ViewPage.viewpage')
@section('content')
<div class="chart_header">
    <div class="in_chart_header">
        <p><i class="fa-solid fa-sack-dollar"></i> Tổng tiền đã thu  </p>
        <p>{{ number_format($moneyIncome,0,'.','.')}} đ</p>
    </div>
    <div class="in_chart_header">
        <p><i class="fa-solid fa-truck-ramp-box"></i> Đơn hàng đã giao </p>
        <p>{{ count($orders) }}</p>
    </div>
    <div class="in_chart_header">
        <p><i class="fa-solid fa-box-open"></i> Sản phẩm đã bán</p>
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
                <p>{{ $product->name }}-SP{{ $product->id }}</p>
            </div>
        @endif
        @if($i == 6)
            @break
        @endif
    @endforeach
</div>
<div class="chart_footer">
    <p>Biểu đồ Số lượng sản phẩm đã bán</p>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#admin_ticked_chart').css('background','#006977');   
    })
</script>
@endsection