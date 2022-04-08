<!DOCTYPE html>
<html lang="en">
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
<body>
<body class="body">
<div class="back"></div>
<div>
 <div class="circle"><img src="{{Storage::url('/images/human2.png')}}" width="140px"></div>
  </div>
  <div class="blog2" style="width: 561px;">
      <div class="container">
                <h3>退会の確認</h3>
                 <p>退会をすると投稿も全て削除されます。</p>
                 <p>それでも退会をしますか？</p>
            <form  method="post" action="/users_delete" >
                @csrf
                  <input type="hidden" name="id" value="{{Auth::id()}}">
                  <button class="btn btn-primary" type="submit">退会</button> 
            </form>
            <a href="/">戻る</a>
      </div>
  </div>
</body>
</html>

