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
@auth
  <p class="users">ユーザー名：{{Auth()->User()->name}}</p>
     <form action="/logout" class='logout' method="post">
        @csrf
        <input  class="logout" type="submit" value="ログアウト">
      </form> 
          @endauth
    <div class="back"></div>
    <article>
        <div class="side" style="width:200%;">
        <div class="circle"><img src="{{Storage::url('/images/human2.png')}}" width="140px"></div>
        <a  class="btn_07"  href="/" >一覧に戻る<span></span></a>
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
            @endif
            @if($trip['pics4'] != "")   
            <div class="sub">
                <img class="img" src="{{Storage::url( $trip->pics4)}}">
            </div>
            @elseif($trip['pics1']!="" && $trip['pics2']!="" && $trip['pics3']!="")
            <div class="sub">
            </div>
            @endif
        </div>
            <p class="title">@isset($trip['title']){{$trip['title']}}@endisset</p>
            <p class="contents"> @isset($trip['contents']) {!!nl2br(e($trip['contents']))!!} @endisset </p>

            <table>
                    @error('comment')
                                <tr>
                                    <th><div class="alert alert-danger" role="alert">エラー</div></th>
                                    <td><div class="alert alert-danger" role="alert">{{$message}}</diV></td>
                                </tr>
                                @enderror
                                <tr>
                </table>
            <ul style="list-style: none;"  >
            @foreach ($trip->comments as $comment)
            <li>
                <form action="/comments" method="post" >
                @csrf
               @if(\App\Models\User::find($comment->name_id))
               <p>ユーザー名：{{\App\Models\User::find($comment->name_id)->name}}<p>
               <p> {!!nl2br(e($comment->comment))!!}</p>
               @endif
               @auth
                <input type="hidden" name="id" value="{{$comment->id}}">
                <input type="hidden" name="trip_id" value="{{$trip->id}}">
                @if(Auth::id()==$comment->name_id)
                <button type="submit" class="btn btn-primary"  style="margin-left: 760px;margin-top: -66px" >削除</button>
                @endif
                @endauth 
                </form>  
            </li>
            @endforeach
        </ul>
        @auth
        <div class="contender">
            <form class="form" style="display: flex;"  action="/articles" method="post" >
                    @csrf
                    <p><textarea placeholder="コメント"  cols="78" rows="3" name="comment" style="margin-left: 103px;"></textarea></p>
                    <input type="hidden" name="trip_id" value="{{$trip->id}}">
                    <button type="submit" class="btn btn-primary" style="margin-left:55px; margin-top:10px">送信</button>   
            </form> 
        </div>
        @endauth
        </div>
    </article>
</body>
</html>