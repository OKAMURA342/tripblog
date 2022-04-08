
<!DOCTYPE html>
<html  class="html"  lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</head>
<body class="body">
  
    <div class="back"></div>
      <header class="header">  
          @guest
              <form action="/login" class='login' method="get">
                    @csrf
                      <input class="login" type="submit" value="ログイン">
              </form> 
              <form action="/register"  class="sign_up"  method="get">
                    @csrf
                      <input class="sign_up" type="submit" value="新規登録">
              </form>
          @endguest
          @auth
                   <p class="users">ユーザー名：{{Auth()->User()->name}}</p>
                 <form action="/logout" class='logout' method="post">
                    @csrf
                      <input  class="logout" type="submit" value="ログアウト">
                  
                </form> 
          @endauth
      </header> 
    </div>
      <div class="btn-trigger" id="btn03" >
        <span></span>
        <span></span>
        <span></span>
      </div>
  <article>
    @guest
        <div class="outside">
                <div class="circle"><img src="{{Storage::url('/images/human2.png')}}" width="140px"></div>
            <div><p style="font-weight: bold; color:#223ec1;" >外部サイトからチケットを購入</p></diV>
           <a  class="btn btn--orange btn--border-solid"  href="https://www.flypeach.com/"><img style="margin-right: 20px;" src="{{Storage::url('/images/airplane.svg')}}" width="30px">飛行機<span></span></a>
               </br>          
           <a  class="btn btn--orange btn--border-solid"  href="https://www.jr-odekake.net/railroad/"><img style="margin-right: 35px;"  src="{{Storage::url('/images/train.svg')}}" width="30px">電車<span></span></a>
               </br>
           <a  class="btn btn--orange btn--border-solid" href="https://www.kousokubus.net/BusRsv/ja/"> <img style="margin-right: 20px;"  src="{{Storage::url('/images/bus.svg')}}" width="30px">高速バス<span></span></a>

           <a  class="btn btn--orange btn--border-solid" href="/"  ><img style="margin-right: 45px;"  src="{{Storage::url('/images/back.svg')}}" width="30px">戻る</a>
        </div>
    
      @endguest
      @auth
            <div class="side">
            <div class="circle"><img src="{{Storage::url('/images/human2.png')}}" width="140px"></div>
                  <a  class="btn_07" href="/new">投稿<span></span></a>
                     </br>
                  <a class="btn_07"  href="/mypage">マイページ<span></span></a>
                     </br>
                     <a class="btn_07" href="/users.delete_confirm">退会<span></span></a>
                     <br>
                    <div style="margin-top:71px"><p style="font-weight: bold; color:#223ec1;" >外部サイトからチケットを購入</p></div>
                  <a  class="btn btn--orange btn--border-solid" href="https://www.flypeach.com/"> <img style="margin-right: 19px;"  src="{{Storage::url('/images/airplane.svg')}}" style="display:flex;" flex; width="30px">飛行機</a>
                      </br>
                  <a  class="btn btn--orange btn--border-solid"  href="https://www.jr-odekake.net/railroad/"><img style="margin-right: 36px; margin-top: 3px;"  src="{{Storage::url('/images/train.svg')}}" style="display:flex;"  width="30px">電車<span></span></a>
                      </br>   
                  <a  class="btn btn--orange btn--border-solid" href="https://www.kousokubus.net/BusRsv/ja/"><img style="margin-right: 19px;" src="{{Storage::url('/images/bus.svg')}}" style="display:flex;"    width="30px">高速バス<span></span></a>
               
           </div>
      @endauth
      <ul class="ul">
        
        <form  class='search'  method="get" action="/search" >
          <div class="display">
              <input class="text" value="@isset($keyword_title){{$keyword_title}}@endif"   placeholder='タイトルとキーワードで検索' type="text" name="search">
              <input  style="width:25px"  type="image" src="{{Storage::url('/images/虫眼鏡の無料アイコン8.svg')}}" name="submit" >
          </diV>
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
                  <p class="card-text" >{!!nl2br(e($trip['contents']))!!}</p>
                  <p class="card-date">{{$trip->created_at->format('Y/m/d')}}</p>
                </div>
        </div>
            <a href="/good?trip_id={{$trip->id}}">{{$trip->good()->count()}}<img src="{{Storage::url('/images/goods.svg')}}" width="30px"></a>
            <a href="https://twitter.com/intent/tweet?text={{urlencode('http://127.0.0.1:8000/blog?id=32')}}"><img src="{{Storage::url('/images/twitter.svg')}}" width="30px"></a>
            </container>
            @endforeach
      </div>
      <div class="paginate">
        {{ $trips->links() }}
      </div>
  </article>
</body>
<script src="{{ asset('js/trip.js') }}"></script>
<script src="{{ asset('js/trip2.js') }}"></script>
</html>