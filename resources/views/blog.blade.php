<!DOCTYPE html>
<html lang="ja" class="html" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
</head>
<body class="body">
    <div class="back"></div>
    <article>
        <div class="side">
        <div class="circle"><img src="{{Storage::url('/images/trip3.png')}}" width="140px"></div>
        <img class="image" src="{{Storage::url('/images/back.svg')}}" width="30px"><a  class="btn_07"  href="/">戻る<span></span></a>
        </div>
        <div class="blog">
         <div class="main">
            @if($trip['pics1'] != "")
            <div class="sub">
                <img class="img"  src="{{Storage::url( $trip->pics1)}}">
            </div>
            @endif
            @if($trip['pics2'] != "")    
            <div class="sub">
                <img class="img"   src="{{Storage::url( $trip->pics2)}}">
            </div>
            @endif
            @if($trip['pics3'] != "") 
            <div class="sub" >
                <img class="img"  src="{{Storage::url( $trip->pics3)}}">
            </div>
            @if($trip['pics4'] == "")   
            <div class="sub">
             <p style="margin-left:16px;"><font size="20"></font>No Image</p>
            </div>
            @endif
            @endif
            @if($trip['pics4'] != "")   
            <div class="sub">
                <img class="img" src="{{Storage::url( $trip->pics4)}}">
            </div>
            @endif
        </div>
            <p class="title">@isset($trip['title']){{$trip['title']}}@endisset</p>
            <p class="contents">@isset($trip['contents']) {{$trip['contents']}} @endisset</p>

            <table>
                    @error('comment')
                                <tr>
                                    <th><div class="alert alert-danger" role="alert">エラー</div></th>
                                    <td><div class="alert alert-danger" role="alert">{{$message}}</diV></td>
                                </tr>
                                @enderror
                                <tr>
                </table>
            <ul >
            @foreach ($trip->comments as $comment)
            <li>
                <form action="/comments" method="post" >
                @csrf
               <p>ユーザー名：{{\App\Models\User::find($comment->name_id)->name}}<p>
               <p>{{$comment->comment}}</p>
               @auth
                <input type="hidden" name="id" value="{{$comment->id}}">
                <input type="hidden" name="trip_id" value="{{$trip->id}}">
                <button type="submit" class="btn btn-primary"  style="margin-left: 782px;margin-top: -66px" >削除</button>
                @endauth 
                </form>  
            </li>
            @endforeach
        </ul>
        @auth
        <div class="contender">
            <form class="form"  action="/articles" method="post" >
                    @csrf
                    <p><textarea placeholder="コメント"  cols="78" rows="3" name="comment" style="margin-left: 103px;"></textarea></p>
                    <input type="hidden" name="trip_id" value="{{$trip->id}}">
                    <button type="submit" class="btn btn-primary" style="margin-left:70px; margin-top:10px">送信</button>   
            </form> 
        </div>
        @endauth
        </div>
    </article>
</body>
</html>