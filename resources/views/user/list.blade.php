@extends('ViewPage.viewpage')
@section('content')
    <div class="listmsg">
        <div class="thongbao">
            <h3>Thong bao:</h3> 
            <p class="checkadd"><i class="fa-regular fa-circle-check"></i></p>
        </div>
        <p><span class="success">{{ $msg }}</span></p>
    </div>
   <div class='divtablefather'>
        <div class='divtable'>
            <table class="list_user_table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Date of Birth</th>
                        <th>Role</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                     $index = 1;
                    ?>
                @foreach($user as $item)
                <tr>
                    <td>{{ $index++ }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->date_of_birth }}</td>
                    <td>{{ $item->role }}</td>
                    <td>
                        <a style="color:black" onclick="return confirm('Xac nhan Sua {{ $item->name }}')" href="{{ route('user.update', ['id' => $item->id]) }}">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                        </a>
                    </td>
                    <td>
                        <a style="color:black" onclick="return confirm('Xac nhan xoa {{ $item->name }}')" href="{{ route('user.delete', ['id' => $item->id]) }}">
                            <i class="fa-regular fa-trash-can"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <a id='createbut' style="color:black" href="create">
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
