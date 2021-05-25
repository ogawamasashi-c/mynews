<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;
// 以下を追記
use App\ProfileHistory;
use Carbon\Carbon;



class ProfileController extends Controller
{
    public function add()
    {
        return view('admin.Profile.create');
    }

    public function create(Request $request)
    {

        // Varidationを行う
        $this->validate($request, Profile::$rules);

        $profile = new Profile;
        $form = $request->all();

   

        unset($form['_token']);
     
        // データベースに保存する
        $profile->fill($form);
        $profile->save();

        return redirect('admin/profile/create');
    }

    public function index(Request $request)
    {
        $cond_name = $request->cond_name;
        if ($cond_name != '') {
            $posts = Profile::where('title', $cond_name)->get();
        } else {
            $posts = Profile::all();
        }
        return view('admin.profile.index', ['posts' => $posts, 'cond_name' => $cond_name]);
    }

    // 以下を追記

    public function edit(Request $request)
    {
        // News Modelからデータを取得する
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }


    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Profile::$rules);
        // 
        $profile = Profile::find($request->input('id'));
        // 送信されてきたフォームデータを格納する
        $profile_form = $request->all();
        unset($profile_form['_token']);

        // 該当するデータを上書きして保存する
        $profile->fill($profile_form)->save();
        // 以下を追記/////////////////////////////////
        $profilehistory = new ProfileHistory;
        $profilehistory->profile_id = $profile->id;
        $profilehistory->edited_at = Carbon::now();
        $profilehistory->save();


        return redirect('admin/profile/');
    }
    // 以下を追記
    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $profile = Profile::find($request->id);
        // 削除する
        $profile->delete();
        return redirect('admin/profile/');
    }
}
