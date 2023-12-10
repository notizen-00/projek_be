<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Produk;
use App\Http\Requests\ProdukRequest;
class ProdukController extends BaseController
{

    public function index()
    {
        $data = Produk::paginate();
        return $this->sendResponse('List Data Produk',[$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdukRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('upload_foto', $fileName, 'public'); 
            $validated['foto'] = $fileName;
        }

        try{
            $produk = Produk::create($validated);
            return $this->sendResponse('Data Berhasil Di Insert',$produk);
        }catch(Exception $e){
            return $this->sendError('Data Gagal di Insert',['error'=> $e.message() ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Produk::findOrFail($id);

        return $this->sendResponse('Detail Produk'.$id,$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdukRequest $request, string $id)
    {
        return response()->json($id);
        // try {
        //     $validated = $request->validated();
        //     $produk = Produk::findOrFail($id);
        //     if ($request->hasFile('foto')) {
        //         $file = $request->file('foto');
        //         $fileName = time() . '_' . $file->getClientOriginalName();
        //         $file->storeAs('upload_foto', $fileName, 'public');
        //         $validated['foto'] = $fileName;
        //     }

        //     $produk->update($validated);

        //     return $this->sendResponse('Data Berhasil Di Update', $produk);
        // } catch (ValidationException $validationException) {
        //     return $this->sendError('Data Gagal di Update', ['error' => $validationException->errors()]);
        // } catch (Exception $e) {
        //     return $this->sendError('Data Gagal di Update', ['error' => $e->getMessage()]);
        // }
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);

        if($produk->delete()){
            return $this->sendResponse('Data Produk dengan Id = '.$id.' , Berhasil Di hapus ',$produk);
        }


    }
}
