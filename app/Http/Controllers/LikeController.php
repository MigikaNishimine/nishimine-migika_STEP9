<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle($id)
    {
        $userId = Auth::id();

        $like = DB::table('likes')
            ->where('user_id', $userId)
            ->where('product_id', $id)
            ->first();

        if ($like) {
            DB::table('likes')
                ->where('id', $like->id)
                ->delete();
        } else {          
            DB::table('likes')->insert([
                'user_id' => $userId,
                'product_id' => $id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return back();
    }
}
