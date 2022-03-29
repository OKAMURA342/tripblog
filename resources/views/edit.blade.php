<!DOCTYPE html  >
<html lang="ja"  class="html" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@next"></script>
</head>
<body>
<body class="body">
<div class="back"></div>
<article >
            <div class="side" style="width:17%;">
            <div class="circle"><img src="{{Storage::url('/images/trip3.png')}}" width="140px"></div>
            <img class="image" src="{{Storage::url('/images/back.svg')}}" width="30px"><a  class="btn_07" href="/" >戻る<span></span></a>
            </div>
    <div id="app">
            <form class="form"  action="/update" method="post" enctype="multipart/form-data">
                @csrf
     <div>   
            <div class="line">
                    <input name="pics0" type="file" ref="prev0" @change="uploadFile(0)">
                        @if($trip['pics1'] != "")
                            <img  class="size" id='pics0' src="{{Storage::url( $trip->pics1)}}">
                        @endif
                    <div v-if="file[0]">
                            <img class="size":src="file[0]">
                            <button @click="deleteFile(0)">x</button>
                        </div>

                        <input name="pics1" type="file" ref="prev1" @change="uploadFile(1)">
                        @if($trip['pics2'] != "")
                            <img   id='pics1' src="{{Storage::url( $trip->pics2)}}">
                        @endif
                        <div v-if="file[1]">
                            <img  class="size"  :src="file[1]">
                            <button @click="deleteFile(1)">x</button>
                        </div>
                        
                        <input name="pics2" type="file" ref="prev2" @change="uploadFile(2)">
                        @if($trip['pics3'] != "")
                            <img  id='pics2' src="{{Storage::url( $trip->pics3)}}">
                        @endif
                        <div v-if="file[2]">
                            <img class="size"  :src="file[2]">
                            <button @click="deleteFile(2)">x</button>
                        </div>

                        <input name="pics3" type="file" ref="prev3" @change="uploadFile(3)">
                        @if($trip['pics4'] != "")
                            <img class="size"  id='pics3' src="{{Storage::url( $trip->pics4)}}">
                        @endif
                        <div  v-if="file[3]">
                            <img class="size"   :src="file[3]">
                            <button @click="deleteFile(3)">x</button>
                        </div>
            </div>
       </div>
        <div style="margin-top:59px; margin-left: 10px;">
                        <table>
                            @error('title')
                                        <tr>
                                            <th><div class="alert alert-danger" role="alert">エラー</div></th>
                                            <td><div class="alert alert-danger" role="alert">{{$message}}</diV></td>
                                        </tr>
                                        @enderror
                                        <tr>
                                        @error('contents')
                                        <tr>
                                            <th><div class="alert alert-danger" role="alert">エラー</div></th>
                                            <td><div class="alert alert-danger" role="alert">{{$message}}</div></td>
                                        </tr>  
                                        @enderror
                        </table>
                        <input type="hidden" name="id" value="{{$trip->id}}">
                        <input type="text" name="title" value="@isset($trip['title']){{$trip['title']}}@endisset">
                        <p><textarea cols="55" placeholder="テキスト" style="margin-top:10px" rows="20" name="contents">@isset($trip['contents']) {{$trip['contents']}} @endisset</textarea></p>
                    <button type="submit"  class="btn btn-primary" style="margin-left: 397px">投稿</button>   
                    </form>
        </div> 
    </div>
 </article>
</body>
<script src="{{ asset('js/vue.js') }}"></script>
</html>