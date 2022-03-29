
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
                <div class="circle"><img src="{{Storage::url('/images/trip3.png')}}" width="140px"></div>
         <a class="btn_07"   href="https://www.flypeach.com/"><img src="{{Storage::url('/images/airplane.svg')}}" width="30px">飛行機<span></span></a>
            <img src="{{Storage::url('/images/train.svg')}}" width="30px"><a class="btn_07"  href="https://www.jr-odekake.net/railroad/">電車<span></span></a>
            <img src="{{Storage::url('/images/bus.svg')}}" width="30px"><a class="btn_07" href="https://www.kousokubus.net/BusRsv/ja/">高速バス<span></span></a>
        </div>
      @endguest
      @auth
            <div class="side">
            <div class="circle"><img src="{{Storage::url('/images/trip3.png')}}" width="140px"></div>
              <img src="{{Storage::url('/images/post.svg')}}"style="display:flex;"  width="30px"><a  class="btn_07" href="/new">投稿<span></span></a>
              <img src="{{Storage::url('/images/my.svg')}}" style="display: flex;"  width="30px"><a class="btn_07"  href="/mypage">マイページ<span></span></a>
              <img src="{{Storage::url('/images/airplane.svg')}}" style="display:flex;" flex; width="30px"><a class="btn_07" href="https://www.flypeach.com/">飛行機<span></span></a>
              <img src="{{Storage::url('/images/train.svg')}}" style="display:flex;"  width="30px"><a class="btn_07" href="https://www.jr-odekake.net/railroad/">電車<span></span></a>
              <img src="{{Storage::url('/images/bus.svg')}}" style="display:flex;"    width="30px"><a class="btn_07"   href="https://www.kousokubus.net/BusRsv/ja/">高速バス<span></span></a>
              <img src="{{Storage::url('/images/Withdrawal.svg')}}" width="30px"><a class="btn_07" href="/users.delete_confirm">退会<span></span></a>
           </div>
      @endauth
      <ul class="ul">
        <form  class='search' method="get" action="/search" >
          <div class="display">
              <input class="text" type="text" name="search">
              <input  style="width:25px"  type="image" src="{{Storage::url('/images/虫眼鏡の無料アイコン8.svg')}}" name="submit" >
          </diV>
        </form>
      </ul>
        <div class="gard">
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
                  <p class="card-text">{{ $trip->contents }} </p>
                  <p class="card-date">{{$trip->created_at->format('Y/m/d')}}</p>
                </div>
        </div>
            <a href="/good?trip_id={{$trip->id}}">{{$trip->good()->count()}}<img src="{{Storage::url('/images/goods.svg')}}" width="30px"></a>
            <a href="https://twitter.com/intent/tweet?text={{ $trip->title}}{{ $trip->contents }}"><img src="{{Storage::url('/images/twitter.svg')}}" width="30px"></a>
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