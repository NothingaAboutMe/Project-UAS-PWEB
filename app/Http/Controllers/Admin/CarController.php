<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Http\Requests\Admin\CarStoreRequest;
use App\Http\Requests\Admin\CarUpdateRequest;
use Illuminate\Support\Str;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cars = Car::latest()->get();
        return view('admin.cars.index',compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarStoreRequest $request)
    {
        //
        if ($request->validated()){
            $gambar = $request -> file('gambar')->store('asset/car', 'public');
            $slug = Str::slug('$request->nama_mobil', '-');
            Car::create($request->except('gambar') + ['gambar' => $gambar, 'slug' => $slug]);
        }

        return redirect()->route('admin.cars.index')->with([
            'massage' => 'Data sukses dibuat',
            'alert-type' => 'Succes'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //
        return view('admin.cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarUpdateRequest $request, Car $car)
    {
        //
        if ($request->validated()){
            $slug = Str::slug($request->nama_mobil, '-');
            $car->update($request->validated() + ['slug' => $slug]);
        }

        return redirect()->route('admin.cars.index')->with([
            'massage' => 'Data berhasil di edit',
            'alert-type' => 'Info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
        if($car->gambar){
            unlink('storage/'. $car->gambar);
        }
        $car->delete();

        return redirect()->back()->with([
            'massage' => 'Data berhasil di hapus',
            'alert-type' => 'Danger'
        ]);
    }

    public function updateImage(Request $request, $carId)       
    {
        $request->validate([
            'gambar' => 'required|image'
        ]);
        $car = Car::findOrFail($carId);
        if ($request->gambar){
            unlink('storage/'. $car->gambar);
            $gambar = $request->file('gambar')->store('asset/car', 'public');

            $car->update(['gambar'=>$gambar]);
        }
        return redirect()->back()->with([
            'message' => 'Gambar berhasil diedit',
            'alert-type' => 'Info'
        ]);
    }
}
