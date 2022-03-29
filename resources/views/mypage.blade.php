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
          <div class="circle"><img src="{{Storage::url('/images/trip3.png')}}" width="140px"></div>
            <div>
                <img class="image"  src="{{Storage::url('/images/post.svg')}}" width="30px"><a class="btn_07" href="/new"><span></span>投稿</a>
            </div>
            <div>
              <img class="image"   src="{{Storage::url('/images/back.svg')}}" width="30px"><a  class="btn_07"  href="/" >一覧に戻る<span></a>
            </div>
          </div>
          <ul class="ul"> 
            <form  class="form" method="get" action="/search" >
                  <input  class="text"  style="width:370px" type="text" name="search">
                  <input  style="width:25px"  type="image" src="{{Storage::url('/images/虫眼鏡の無料アイコン8.svg')}}")}}" name="submit" >
            </form>
          </ul>
          <div class="gard">
                @foreach ($trips as $trip)
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
                  <div>
                    <form style="float: left;" method="GET" action="/edit"><!-- Right Side Of Navbar -->
                        <input type="hidden" name="id" value="{{$trip->id}}">
                        <button  class="button"   type="submit">編集</button>
                    </form>
                    <form  method="post" action="/remove">
                        @csrf
                        <input type="hidden" name="id" value="{{$trip->id}}">
                        <button  class="button"  class="btn-square"  type="submit">消去</button>
                    </form>
                </diV>
                </div>
                @endforeach
                {{ $trips->links() }}
          </div>
          <div class="paginate">
            {{ $trips->links() }}
          </div>
        </article>
  </body>
</html>