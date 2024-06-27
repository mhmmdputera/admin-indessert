<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Telegram;
use Illuminate\Http\Request;

class TelegramController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $telegrams = Telegram::latest()->when(request()->q, function($telegrams) {
            $telegrams = $telegrams->where('title', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.telegram.index', compact('telegrams'));
    }

    public function edit($id)
    {
        $notification = Telegram::findOrFail($id);
        return view('admin.telegram.edit', compact('notification'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'token' => 'required|string',
            'user' => 'required|string',
            'chat_id' => 'required|string',
        ]);

        $notification = Telegram::findOrFail($id);
        $notification->update($request->all());

        if($notification){
            //redirect dengan pesan sukses
            return redirect()->route('admin.telegram.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.telegram.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
}
