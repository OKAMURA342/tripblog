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
            <div class="side" style="width:17%;height:115vh;">
                <div class="circle"><img src="{{Storage::url('/images/human2.png')}}" width="140px"></div>
                <a  class="btn_07" href="/mypage" >mypageに戻る<span></span></a>
                <a style="margin-top: 15px;"  class="btn_07" href="/" >一覧にに戻る<span></span></a>
            </div>
    <div id="app">
            <form class="form"  action="/update" method="post" enctype="multipart/form-data">
                @csrf
                <div style="margin-top: 6px;margin-left: 310px;">
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
                        <p style="font-size: 30px; margin-left: 113px;">旅の記事を編集する</p>
                        <p style="margin-left: 124px;">※写真なし文章のみ投稿も可能です</p>
                        <input type="hidden" name="id" value="{{$trip->id}}">
                        <input type="text" name="title" style="width:640px;margin-left: -45px;"   value="@isset($trip['title']){{$trip['title']}}@endisset">
                        <p><textarea cols="77" placeholder="テキスト"  style="margin-top:10px;margin-left:-45px;"  style="margin-top:10px" rows="15" name="contents">@isset($trip['contents']) {{$trip['contents']}} @endisset</textarea></p>
                        <p style="font-size:20px;margin-left: 128px">旅の写真をアップロードする</p>
                        <p style="margin-left: 163px;">最大４枚まで投稿可能です。</p>
                <div>   
                <div class="line">
                    <div style="position: relative; margin-left: -40px;border: #4f78d4 2px solid;">
                        <input name="pics0" id="pics0" style="display:none;"  type="file" ref="prev0" accept=".png, .jpeg, .jpg"  @change="uploadFile(0)">
                        <label class="label"  for="pics0" style="width:150px; height:75px; background-color:#7e83ec;"><img style="width: 150px; height: 10p; height: 75px;" src="{{Storage::url('/images/写真選択.PNG')}}" width="140px"></label>
                        @if($trip['pics1'] != "")
                            <img  class="size2"  id='pics0_' src="{{Storage::url( $trip->pics1)}}">
                            <button class="bottun-style"  id="pics0_b" type="button"   @click="deleteFileAlready(0)">x</button>
                        @endif
                        <div v-if="file[0]">
                            <img  class="size2"  :src="file[0]">
                            <button class="bottun-style"   @click="deleteFile(0)">x</button>
                        </div>
                    </div>
                    <div style="margin-left: 5px;position: relative; margin-left:5px ; border: #4f78d4 2px solid;">
                        <input name="pics1" id="pics1"   style="display:none;"  accept=".jpeg, .jpg"    type="file" ref="prev1" @change="uploadFile(1)">
                        <label class="label"  for="pics1" style="width:150px; height:75px; background-color:#7e83ec;"><img style="width: 150px; height: 10p; height: 75px;" src="{{Storage::url('/images/写真選択.PNG')}}" width="140px"></label>
                        @if($trip['pics2'] != "")
                            <img class="size2" id='pics1_'  src="{{Storage::url( $trip->pics2)}}">
                            <button class="bottun-style" id="pics1_b" type="button" @click="deleteFileAlready(1)">x</button>
                        @endif
                        <div v-if="file[1]">
                            <img   class="size2" :src="file[1]">
                            <button class="bottun-style"  @click="deleteFile(1)">x</button>
                        </div>
                    </div>
                    <div style="margin-left: 5px;position: relative; margin-left:5px ; border: #4f78d4 2px solid;">
                        <input name="pics2"   id="pics2"  style="display:none;"  accept=" .jpeg, .jpg"   type="file" ref="prev2" @change="uploadFile(2)">
                        <label class="label"  for="pics2" style="width:150px; height:75px; background-color:#7e83ec;"><img style="width: 150px; height: 10p; height: 75px;" src="{{Storage::url('/images/写真選択.PNG')}}" width="140px"></label>
                        @if($trip['pics3'] != "")
                            <img class="size2"  id='pics2_' src="{{Storage::url( $trip->pics3)}}">
                            <button class="bottun-style" id="pics2_b" type="button" @click="deleteFileAlready(2)">x</button>
                        @endif
                        <div v-if="file[2]">
                            <img class="size2"  :src="file[2]">
                            <button class="bottun-style"  @click="deleteFile(2)">x</button>
                        </div>
                    </div>
                    <div style="margin-left: 5px;position: relative; margin-left:5px ; border: #4f78d4 2px solid;">
                        <input name="pics3" id="pics3"  style="display:none;" accept=" .jpeg, .jpg"   type="file" ref="prev3" @change="uploadFile(3)">
                        <label class="label"  for="pics3" style="width:150px; height:75px; background-color:#7e83ec;"><img style="width: 150px; height: 10p; height: 75px;" src="{{Storage::url('/images/写真選択.PNG')}}" width="140px"></label>
                        @if($trip['pics4'] != "")
                            <img class="size2" id='pics3_' src="{{Storage::url( $trip->pics4)}}">
                            <button class="bottun-style" id="pics3_b" type="button" @click="deleteFileAlready(3)">x</button>
                        @endif
                        <div  v-if="file[3]">
                            <img class="size2"   :src="file[3]">
                            <button class="bottun-style"  @click="deleteFile(3)">x</button>
                        </div>
                    </div>
                </div>
                    <button type="submit"  class="btn btn-primary"  style="margin-left: 170px;width: 180px;margin-top: 10px;position: absolute;">投稿</button>   
            </form>
        </div> 
    </div>
 </article>
</body>
<script src="{{ asset('js/vue.js') }}"></script>
</html>