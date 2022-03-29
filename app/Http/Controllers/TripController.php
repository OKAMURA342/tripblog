<?php

namespace App\Http\Controllers;
use App\Models\Trip;
use App\Models\Good;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\tripRequest;
use App\Http\Requests\commentRequest;
use Carbon\Carbon;



class TripController extends Controller
{
  //一覧画面の表示
    public function index()
             {
               $trip = Trip::whereHas('User',function($q){
                $q->where('deleted_at', null);
               })->paginate(6);
               return view('trip', ['trips' => $trip]);
             }

    //新規ページ
    public function new(Request $request)
            {
              return view('post');
          }
    //投稿ページ
    public function create(tripRequest $request)
            {
                $trip= new Trip;
                $form=$request->all();
              //imagesの中に写真のデータを入れる
                $images = [
                  $request->file('pics0'),
                  $request->file('pics1'),
                  $request->file('pics2'),
                  $request->file('pics3'),
                ]; 
                // 
                unset($form['pics1']);
                unset($form['pics2']);
                unset($form['pics3']);
                //for文で画像の保存
                for ($i = 0 ; $i < count($images); $i++){
                //画像が複数ではない場合
                  if($images[$i] != null){
                    $filename = $images[$i]->getClientOriginalName();//アップロードするファイル名を取得するため、getClientOriginalName()を使う
                    $form["pics".strval($i+1)]=$images[$i]->storeAs('public/images', $filename);// 画像を保存
                  };
                }
                //$form
                unset($form['pics0']);
               //CSR対策　
                unset($form['_token']);
                //$fromの中のuser_idの中に新しいユーザーを入れる
                $form['user_id']=Auth::id();
                $trip->fill($form)->save(); //データーベースに保存先を格納している
                return redirect('/');
            }
    //ブログページ
    public function comment(Request $request)
           {
             $trip= Trip::find($request->id);
             return view('blog', ['trip' => $trip]);
           }
    //編集ページ
    public function edit(Request $request)
           {
              $trip=Trip::find($request->id);
              
              return view('edit',compact('trip'));
           }
    //更新ページ
    public function update(tripRequest $request)
           {
            
            $trip= Trip::find($request->id);
            $form=$request->all();
            //imagesの中に写真のデータを入れる
            $images = [
              $request->file('pics0'),
              $request->file('pics1'),
              $request->file('pics2'),
              $request->file('pics3'),
            ]; 
            unset($form['pics1']);
            unset($form['pics2']);
            unset($form['pics3']);
            //for文で画像の保存
            for ($i = 0 ; $i < count($images); $i++){
              //画像が複数ではない場合
              if($images[$i] != null){
                $filename = $images[$i]->getClientOriginalName();//アップロードするファイル名を取得するため、getClientOriginalName()を使う
                $form["pics".strval($i+1)]=$images[$i]->storeAs('public/images', $filename);// 画像を保存
              };
            }
            //$form
            unset($form['pics0']);
            unset($form['__token']);
            $trip->fill($form)->save();
            return redirect('/');
           }   
    //マイページ
    public function mypage(Request $request)
           {
             $user = Auth::user();
             $id = Auth::id();
            // dd($id);
             $trip=Trip::where('user_id','=',$id)->latest()->paginate(6);
           //  dd($trip);
           //  Trip// ビューの描画
            return view('mypage', ['trips' => $trip]);
           }
    //記事削除
    public function remove(Request $request)
           {
           Trip::find($request->id)->delete();
           return redirect('/mypage');
           }
    //検索       
    public function search(Request $request) 
           {
              $keyword_title= $request->search;
              $keyword_contents=$request->search;
              $query = Trip::query();
              $trip = $query->where('title','like', '%' .$keyword_title. '%',)
              ->orWhere('contents', 'like','%' .$keyword_contents. '%' )->paginate(6);
              return view('trip',['trips'=> $trip]);
           }

    //いいね機能
    public function good(Request $request)
           {
            
            $user= good::where('trip_id', $request->trip_id)->where('user_id',Auth::id())->first();
            //ユーザーは一回だけしかいいねできない
            if(!$user){//もし該当ユーザーがなかったら。
              $good = new Good;
              $good->trip_id = $request->trip_id;
              $good->user_id = Auth::id();
              $good->save();
            }else{
              $user->delete();
            }
            $trip= Trip::find($request->trip_id);
            return back();
            }
    //コメント
    public function articles(commentRequest $request)
            {
                $comment = new Comment();
                $comment->comment= $request->comment;
                $comment->trip_id = $request->trip_id;
                $comment->name_id = Auth::id();
                $comment->save();
              return redirect('/blog?id='.$request->trip_id);
            }
    //コメント削除
    public function destroy(Request $request)
            {
                $comment = Comment::find($request->id);
                if($comment->name_id == Auth::id()){
                  $comment->delete();
                }
                  return redirect('/blog?id='.$request->trip_id);
              
            }
    //退会確認画面
    public function delete_confirm(Request $request)
            {
                return view('/delete_confirm');
            }
    //退会
    public function users_destroy(Request $request)
            {
              $user = Auth::user();
              $user->delete();
              Auth::logout();
              return redirect(route('login'));
            }
}