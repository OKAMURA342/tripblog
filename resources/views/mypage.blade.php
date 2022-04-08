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
  <body>
        <body class="body">
        <div class="back"></div>
        <article>
          <div class="side" style="width: 17%">
          <div class="circle"><img src="{{Storage::url('/images/human2.png')}}" width="140px"></div>
              <a class="btn_07" href="/new"><span></span>投稿</a>
                 </br> 
              <a  class="btn_07"  href="/" >一覧に戻る<span></span></a>
          </div>
          @auth
                   <p class="users">ユーザー名：{{Auth()->User()->name}}</p>
                 <form action="/logout" class='logout' method="post">
                    @csrf
                      <input  class="logout" type="submit" value="ログアウト">
                </form> 
          @endauth
          <ul class="ul"> 
            <form  class="form" method="get" action="/search_mypage" >
                  <input  class="text" value='@isset($keyword_title){{$keyword_title}} @else'  placeholder='タイトルとキーワードで検索@endif' style="width:370px" type="text" name="search">
                  <input  style="width:25px"  type="image" src="{{Storage::url('/images/虫眼鏡の無料アイコン8.svg')}}" name="submit" >
            </form>
          </ul>
          <div class="gard">
          <?php
              $count = count($trips);
            ?>
            @if($count == 0)
            <p  class="lost">該当するものがありませんでした</p>
            @endif
                @foreach ($trips as $trip)
              <container>
                <div class="card" >
                          @for ($i = 1; $i <= 4; $i++)
                          @if($trip['pics'.$i] != "")
                            <img src='{{Storage::url( $trip["pics".$i])}}' width="239px">
                            @break
                          @endif
                          @endfor
                    <div class="card-body">
                        <h5 class="card-title"><a href="/blog?id={{$trip->id}}">{{ $trip->title }}</a></h5>
                        <p class="card-text">{{ $trip->contents }}</p>
                        <p class="card-date">{{$trip->created_at->format('Y/m/d')}}</p>
                    </div>
                  <a href="/edit? id={{$trip->id}}"></a> 
                 
                </div>
                <div >
                    <form style="float: left;" method="GET" action="/edit"><!-- Right Side Of Navbar -->
                        <input type="hidden" name="id" value="{{$trip->id}}">
                        <button  class="button"   type="submit">編集</button>
                    </form>
                    <form style="margin-top:-13px;" method="post" action="/remove">
                        @csrf
                        <input   type="hidden" name="id" value="{{$trip->id}}">
                        <button  class="button"  class="btn-square"  type="submit">消去</button>
                    </form>
                 </div>
              </container>
                @endforeach
          </div>
          <div class="paginate">
        {{ $trips->links() }}
      </div>
        </article>
  </body>
</html>