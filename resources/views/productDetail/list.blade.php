@extends('ViewPage.viewpage')
@section('content')
<div class="listmsg">
    <div class="thongbao">
        <h3>Thong bao:</h3> 
        <p class="checkadd"><i class="fa-regular fa-circle-check"></i></p>
    </div>
    <p><span class="success">{{ $msg }}</span></p>
</div>
<div class="productname_in_detail">
    <p>{{ $product->name }} + {{ $product->type }}</p>
</div>
<div class='divtablefather' id='detail_divtablefather'>
    <div class='divtable' id='detail_table'>
        <table class="list_user_table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Thumbnail</th>
                    <th>Storage</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                 $index = 1;
                ?>
                @foreach($productDetail as $item)
                <tr>
                    <td>{{ $index++ }}</td>
                    <td>{{ $item->color }}</td>
                    <td>{{ $item->size }}</td>
                    <td>{{ $item->thumbnail }}</td>
                    <td>{{ $item->storage }}</td>
                    <td>
                        <a style="color:black" onclick="return confirm('Xac nhan Sua')" href="{{ route('productDetail.update', ['id' => $item->id]) }}">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                        </a>
                    </td>
                    <td>
                        <a style="color:black" onclick="return confirm('Xac nhan xoa')" href="{{ route('productDetail.delete', ['id' => $item->id]) }}">
                            <i class="fa-regular fa-trash-can"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a id='createbut' style="color:black" href="{{ route('productDetail.create', ['id' => $product->id]) }}">
        <button class='tocreate_btn'>Create</button>
    </a>
</div>

<script>
    var message = document.querySelector('.success').innerHTML;
    if(message == ''){
     document.querySelector('.listmsg').style.display = 'none';
    }
    else{
     setInterval(function() {
     $('.listmsg').slideUp();
    },2000)
    }
</script>
@endsection