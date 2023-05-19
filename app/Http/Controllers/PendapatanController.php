<?php

namespace App\Http\Controllers;
//import Model "Post
use App\Models\Pendapatans;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class PendapatanController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get posts
        $pendapatans = Pendapatans::latest()->paginate(5);

        //render view with posts
        return view('pendapatans.index', compact('pendapatans'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('pendapatans.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            
            'ket'     => 'required|min:5',
            'jumlah'   => 'required|min:1'
        ]);



        //create post
        Pendapatans::create([

            'ket'     => $request->ket,
            'jumlah'   => $request->jumlah
        ]);

        //redirect to index
        return redirect()->route('pendapatans.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
 /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get post by ID
        $pendapatan = Pendapatans::findOrFail($id);

        //render view with post
        return view('pendapatans.show', compact('pendapatan'));
    }

 /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get post by ID
        $pendapatan = Pendapatans::findOrFail($id);

        //render view with post
        return view('pendapatans.edit', compact('pendapatan'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'ket'     => 'required|min:5',
            'jumlah'   => 'required|min:1'
        ]);

        //get post by ID
        $pendapatan = Pendapatans::findOrFail($id);




            //update post with new image
            $pendapatan->update([
                'ket'     => $request->ket,
                'jumlah'   => $request->jumlah
            ]);

        //redirect to index
        return redirect()->route('pendapatans.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
/**
     * destroy
     *
     * @param  mixed $pendapatan
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $pendapatan = Pendapatans::findOrFail($id);

        //delete post
        $pendapatan->delete();

        //redirect to index
        return redirect()->route('pendapatans.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}