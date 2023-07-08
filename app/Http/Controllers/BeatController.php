<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BeatController extends Controller
{

    public function store(Request $request)
    {
        $user = Auth::user();

        $beat = new Beat();
        $beat->title = $request->input('title');
        $beat->free_file = $request->input('free_file');

         /* Vérifier si l'utilisateur est autorisé à définir le champ premium_file
        en admettant que seul les admins le peuvent*/
        if (Gate::any(['isAdmin'], $user)) {
            $beat->premium_file = $request->input('premium_file');
        }
        $beat->user_id = $user->id;
        $beat->save();

        return response()->json(['message' => 'Beat created successfully']);
    }

    public function likeBeat(Beat $beat)
{
    $user = Auth::user();

    $like = new Like();
    $like->user_id = $user->id;

    $beat->likes()->save($like);

    return response()->json(['message' => 'Beat liked successfully']);
}

}
