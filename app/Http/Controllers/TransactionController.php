<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\SaleDetails;
use App\Models\Stock_Detail;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Stock;
use Carbon\Carbon;
// use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\PDF;
use Illuminate\Support\Facades\DB;
use Rmunate\Utilities\SpellNumber;

class TransactionController extends Controller
{
    public function index()
    {
        $sales = SaleDetails::get();
        return view('backend.sale.index', compact('sales'));
    }
    public function create()
    {
        $customers = Customer::all();
        $books = Book::all();
        $stockDetails = Stock_Detail::with('book')->get();
        return view('backend.sale.pos_application', compact('customers', 'stockDetails', 'books'));
    }

    public function searchBooks(Request $request)
    {
        // $query = $request->get('query');
        // $books = Book::where('book_bangla_name', 'LIKE', "%{$query}%")
        //              ->orWhere('book_english_name', 'LIKE', "%{$query}%")
        //              ->get();

        // return response()->json($books);
        // $stockDetail = Stock_Detail::get();
        // if(){

        // }
        $query = $request->get('query');
        $stockDetails = Stock_Detail::whereHas('book', function ($q) use ($query) {
            $q->where('book_bangla_name', 'LIKE', "%{$query}%")
                ->orWhere('book_english_name', 'LIKE', "%{$query}%");
        })->with('book')->get();

        // dd($stockDetails);

        return response()->json($stockDetails);
    }

    public function store(Request $request)
    {
        $books = $request->input('books');
        // dd($books);

        // Validate request data
        $request->validate([
            'books' => 'required|array',
            'books.*.book_id' => 'required|exists:books,id',
            'books.*.quantity' => 'required|integer|min:1',
            'books.*.subtotal' => 'required|numeric|min:0',
        ]);


        // Handle customer selection or creation
        $customerId = $request->input('customer_id');
        $check = Customer::where('id', $customerId)->first();

        if (!$check) {
            $customer = [
                'name' => 'unknown',
                'phone' => 0,
                'address' => 'unknown',
                // 'user_id' => auth()->id(),
            ];
            $cus = Customer::create($customer);
            $customerId = $cus->id;
        }

        // Calculate total quantity and total price
        $totalQuantity = 0;
        $totalPrice = 0;

        foreach ($books as $book) {
            $totalQuantity += $book['quantity'];
            $totalPrice += $book['subtotal'];
        }

        // Create the sale
        $sale = Sale::create([
            'total_quantity' => $totalQuantity,
            'total_price' => $totalPrice,
            'discount' => $request->input('discount', 0),
            'customer_id' => $customerId,
            // 'user_id' => auth()->id(),
        ]);

        // Create sale details and update stock
        foreach ($books as $book) {
            SaleDetails::create([
                'book_id' => $book['book_id'],
                'sales_id' => $sale->id,
                // 'uni_code' => $uniCode,
                'customer_id' => $customerId,
                'quantity' => $book['quantity'],
                'price' => $book['price'],
                'subtotal' => $book['subtotal'],
            ]);

            // Update the stock
            $stock = Stock::where('book_id', $book['book_id'])->first();
            if ($stock) {
                if ($stock->total_quantity < $book['quantity']) {
                    return redirect()->back()->withErrors(['message' => 'Not enough stock for book ID ' . $book['book_id']]);
                }
                $stock->total_quantity -= $book['quantity'];
                $stock->total_price -= $book['quantity'] * $book['price'];
                $stock->save();
            } else {
                DB::rollBack();
                return redirect()->back()->withErrors(['message' => 'Stock detail not found for book ID ' . $book['book_id']]);
            }

            // Update the stock_details
            $stock_details = Stock_Detail::where('book_id', $book['book_id'])->first();
            if ($stock_details) {
                if ($stock_details->quantity < $book['quantity']) {
                    return redirect()->back()->withErrors(['message' => 'Not enough stock for book ID ' . $book['book_id']]);
                }
                $stock_details->quantity -= $book['quantity'];
                // $stock->price -= $book['quantity'] * $book['price'];
                $stock_details->save();
            } else {
                DB::rollBack();
                return redirect()->back()->withErrors(['message' => 'Stock detail not found for book ID ' . $book['book_id']]);
            }
        }
        return redirect()->route('transactions.print_show')->with('success', 'Transaction created successfully.');
    }
    public function print_show()
    {
        return view('backend.invoice.finished');
    }

    public function big_note(Request $request)
    {
        // dd($request->all());
        // Find the sales transaction using the ID stored in the session
        $sale = Sale::find(session('id'));
        // dd($sale);

        // If the sales transaction is not found, return a 404 error
        if (!$sale) {
            abort(404);
        }

        // Retrieve the details of the sales transaction and load related product information
        $details = SaleDetails::with('book')
            ->where('sale_id', session('id'))
            ->get();

            // dd($details);

        // Convert the total price to words using the SpellNumber class
        $spell = SpellNumber::value($sale->total_price)
            ->locale('en') 
            ->currency('Taka')
            ->fraction('Paisa')
            ->toMoney();

        $spell = ucfirst($spell);

        // Get the current date
        $currentDate = Carbon::now()->toFormattedDateString(); // e.g., May 31, 2024

        // Load the view for the large invoice and pass the retrieved data to it
        $pdf = PDF::loadView('backend.invoice.invo', compact('sale', 'details', 'spell', 'currentDate'));
        dd($pdf);

        // Set the dimensions and orientation of the PDF
        $pdf->setPaper([0, 0, 609, 440], 'portrait');

        // Stream the generated PDF to the browser with a dynamic filename
        return $pdf->stream('Transaction-' . date('Y-m-d-his') . '.pdf');
    }
}
