<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Stock;
use App\Models\Stock_Detail;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    //

    public function index()
    {
        $stock = Stock::orderBy('id', 'DESC' )->get();
        return view('backend.stock.total_stock', compact('stock'));
    }

    public function create()
    {
        $book = Book::all();
        return view('backend.stock.restore', compact('book'));
    }

    public function restock(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required',
            'quantity' => 'required|integer|min:1', // Assuming quantity should be a positive integer
            'price' => 'required|numeric|min:0', // Assuming price should be a non-negative number
        ]);
    
        // Generate unique code for the stock detail
        $uuid = IdGenerator::generate(['table' => 'stock_details', 'field' => 'uni_code', 'length' => 7, 'prefix' => 'IN#']);
    
        // Create new stock detail
        $stockDetail = Stock_Detail::create([
            'book_id' => $request->book_id,
            'uni_code' => $uuid,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);

        
        $check = Book::where('id', $request->book_id)->first();
        // dd($check);
        $price = $request->price;
        // Book::update($request->id);
        // dd($price);
        if($check)
        {

            $check->price += $price;
            $check->save;
        }
    
        $stock = Stock::where('book_id', $request->book_id)->first();
    
        if (!$stock) {
            Stock::create([
                'book_id' => $request->book_id,
                'stock_detail_id' => $stockDetail->id,
                'total_quantity' => $request->quantity,
                'total_price' => $request->quantity * $request->price,
            ]);
        } else {
            // Update existing stock record
            $stock->total_quantity += $request->quantity;
            $stock->total_price += $request->quantity * $request->price;
            $stock->save();
        }
    
        return redirect()->route('stocks')->with('success', 'Book has been restocked.');
    }
    
    
    public function in_stock()
    {
        $stock_detail = Stock_Detail::orderBy('id', 'DESC' )->get();
        return view('backend.stock.in_stock', compact('stock_detail'));
    }

    public function edit($id)
    {
        $stock = Stock_Detail::find($id);
        $book = Book::all();
        return view('backend.stock.instock_edit', compact('stock', 'book'));
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'book_id' => 'required',
            'quantity' => 'required|integer|min:1', // Assuming quantity should be a positive integer
            'price' => 'required|numeric|min:0', // Assuming price should be a non-negative number
        ]);
        // Create new stock detail
        $data = [
            'book_id' => $request->book_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ];

       $stockDetail = Stock_Detail::find($request->id);

        
        $check = Book::where('id', $request->book_id)->first();
        
        dd($check);
        $price = $request->price;
        // Book::update($request->id);
        // dd($price);
        if($check)
        {

            $check->price += $price;
            $check->save;
        }
    
        $stock = Stock::where('book_id', $request->book_id)->first();
    
        if (!$stock) {
            Stock::create([
                'book_id' => $request->book_id,
                'stock_detail_id' => $stockDetail->id,
                'total_quantity' => $request->quantity,
                'total_price' => $request->quantity * $request->price,
            ]);
        } else {
            // Update existing stock record
            $stock->total_quantity += $request->quantity;
            $stock->total_price += $request->quantity * $request->price;
            $stock->save();
        }
    
        return redirect()->route('stocks')->with('success', 'Book has been updated.');
    }
}
