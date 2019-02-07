<?php

namespace App\Http\Controllers\Expences;

use App\Expence;

use App\Http\Requests\Expences\StoreExpenceRequest;

use App\Http\Requests\Expences\UpdateExpenceRequest;

use App\Transformers\ExpenceTransformer;

use Cyvelnet\Laravel5Fractal\Facades\Fractal;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ExpenceController extends Controller
{
    public function index() {
        // $expences = Expence::all();
        // return Fractal::includes('author')->collection($expences, new ExpenceTransformer);
        return Expence::where('author_id', auth()->user()->id)->get();
    }

    public function store(StoreExpenceRequest $request){
        $expence = new Expence;
        $expence->author_id = $request->user()->id;
        $expence->title=$request->title;
        $expence->summ=$request->summ;
        $expence->date=$request->date;
        $expence->comment=$request->comment;
        $expence->slug = str_slug($request->title);
        $expence->body = $request->body;
        $expence->save();

        return Fractal::includes('author')->item($expence, new ExpenceTransformer);
    }

    public function show(Expence $expence){
        return Fractal::includes('author')->item($expence, new ExpenceTransformer);
    }

    public function update(UpdateExpenceRequest $request, Expence $expence){

        if($expence->author_id !== auth()->user()->id) {

            return response()->json("Unauthorized", 401);

        }

        $expence->title = $request->get('title', $expence->title);
        $expence->date = $request->get('date', $expence->date);
        $expence->summ = $request->get('summ', $expence->summ);
        $expence->comment = $request->get('comment', $expence->comment);
        $expence->slug = ($request->has('title')) ? str_slug($request->get('title')) : $expence->slug;
        $expence->body = $request->get('body', $expence->body);

        $expence->save();

        return Fractal::includes('author')->item($expence, new ExpenceTransformer);
    }

    public function destroy(Expence $expence){

        if($expence->author_id !== auth()->user()->id) {

            return response()->json("Unauthorized", 401);
            
        }

        $expence->delete();
        return response(null, 200);
    }

    public function destroySeveral(Expence $expence, Request $request){

        $expencesDelete = $request->expences;

        $authorExpencesIds = auth()->user()->expences->map(function($expence){

            return $expence->id;

        });

        $valid = collect($expencesDelete)->every(function($value, $key) use ($authorExpencesIds) {

            return $expence->id;

        });

        if(!$valid) {

          return response()->json('Unauthorized', 200);

        }

        $request->validate([

            'expences'=>'required|array',

        ]);
 
        Expence::destroy($request->expences);
        
        return response("Deleted", 200);

    }
    
}
