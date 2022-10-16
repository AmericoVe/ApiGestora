<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class DocumentController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $documents = $this->user->documents()->get(["id", "coddoc", "descrip", "created_by"])->toArray();
       $documents = Document::all()->toArray();

        return $documents;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "coddoc" => "required",
            "descrip" => "required",
            "ctacompra" => "required",
            "ctaventa" => "required",
            "aux0001" => "required",
            "aux0002" => "required",
            "aux0003" => "required",
            "aux0004" => "required",
            "aux0005" => "required",
        ]);
    
        $documents = new Document();
        $documents->coddoc = $request->coddoc;
        $documents->descrip = $request->descrip;
        $documents->ctacompra = $request->ctacompra;
        $documents->ctaventa = $request->ctaventa;
        $documents->aux0001 = $request->aux0001;
        $documents->aux0002 = $request->aux0002;
        $documents->aux0003 = $request->aux0003;
        $documents->aux0004 = $request->aux0004;
        $documents->aux0005 = $request->aux0005;
    
        if ($this->user->documents()->save($documents)) {
            return response()->json([
                "status" => true,
                "task" => $documents
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Ops, task could not be saved."
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        $this->validate($request, [
            "coddoc" => "required",
            "descrip" => "required",
            "ctacompra" => "required",
            "ctaventa" => "required",
            "aux0001" => "required",
            "aux0002" => "required",
            "aux0003" => "required",
            "aux0004" => "required",
            "aux0005" => "required",
        ]);
     
        $document->coddoc = $request->coddoc;
        $document->descrip = $request->descrip;
        $document->ctacompra = $request->ctacompra;
        $document->ctaventa = $request->ctaventa;
        $document->aux0001 = $request->aux0001;
        $document->aux0002 = $request->aux0002;
        $document->aux0003 = $request->aux0003;
        $document->aux0004 = $request->aux0004;
        $document->aux0005 = $request->aux0005;
    
        if ($this->user->documents()->save($document)) {
            return response()->json([
                "status" => true,
                "task" => $document
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Ops, task could not be updated."
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        if ($document->delete()) {
            return response()->json([
                "status" => true,
                "task" => $document
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Ops, task could not be deleted."
            ]);
        }
    }
}
