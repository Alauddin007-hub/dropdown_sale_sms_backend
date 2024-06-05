<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\SaleDetails;
use App\Models\Stock_Detail;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Stock;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Rmunate\Utilities\SpellNumber;
use PDF;
use PhpParser\Node\Stmt\Return_;

class TransactionController extends Controller
{
    public function index()
    {
        $sales = Sale::orderBy('id', 'DESC')->get();
        return view('backend.sale.index', compact('sales'));
    }

    public  function todayTransaction()
    {
        // $currentDate = getdate();
        // $date = $currentDate['mday'];

        // $sales = DB::table('Sales')->whereDay('created_at', $date)->orderBy('id', 'DESC')->get();
        
        $currentDate = now()->day; // Use Carbon's now() method to get the current day

        $sales = Sale::whereDay('created_at', $currentDate)
                    ->with('customer') // Eager load the customer relationship
                    ->orderBy('id', 'DESC')
                    ->get();
    
        return view('backend.sale.todaySale', compact('sales'));
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
        $query = $request->get('query');
        $stockDetails = Stock_Detail::whereHas('book', function ($q) use ($query) {
            $q->where('book_bangla_name', 'LIKE', "%{$query}%")
                ->orWhere('book_english_name', 'LIKE', "%{$query}%");
        })->with('book')->get();

        return response()->json($stockDetails);
    }

    public function store(Request $request)
    {
        $books = $request->input('books');

        $request->validate([
            'books' => 'required|array',
            'books.*.book_id' => 'required|exists:books,id',
            'books.*.quantity' => 'required|integer|min:1',
            'books.*.subtotal' => 'required|numeric|min:0',
        ]);

        $customerId = $request->input('customer_id');
        $check = Customer::where('id', $customerId)->first();

        if (!$check) {
            $customer = [
                'name' => 'unknown',
                'phone' => 0,
                'address' => 'unknown',
                'user_id' => auth()->id(),
            ];
            $cus = Customer::create($customer);
            $customerId = $cus->id;
        }

        $invoice = IdGenerator::generate(['table' => 'sales', 'field' => 'invoiceID', 'length' => 7, 'prefix' => 'INVO#']);

        $totalQuantity = 0;
        $totalPrice = 0;

        foreach ($books as $book) {
            $totalQuantity += $book['quantity'];
            $totalPrice += $book['subtotal'];
        }

        $sale = Sale::create([
            'total_quantity' => $totalQuantity,
            'total_price' => $totalPrice,
            'invoiceID' => $invoice,
            'discount' => $request->input('discount', 0),
            'customer_id' => $customerId,
            'user_id' => auth()->id(),
        ]);

        foreach ($books as $book) {
            $details = SaleDetails::create([
                'book_id' => $book['book_id'],
                'sales_id' => $sale->id,
                'customer_id' => $customerId,
                'quantity' => $book['quantity'],
                'price' => $book['price'],
                'subtotal' => $book['subtotal'],
            ]);

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

            $stock_details = Stock_Detail::where('book_id', $book['book_id'])->first();
            if ($stock_details) {
                if ($stock_details->quantity < $book['quantity']) {
                    return redirect()->back()->withErrors(['message' => 'Not enough stock for book ID ' . $book['book_id']]);
                }
                $stock_details->quantity -= $book['quantity'];
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
        $sale = Sale::orderBy('id', 'DESC')->first();

        if ($sale) {
            $sale_id = $sale->id;
            $details = SaleDetails::where('sales_id', $sale_id)->get(); // Get all sale details
        } else {
            $details = collect(); // Empty collection
        }

        return view('backend.invoice.finished', compact('details', 'sale'));
    }

    public function invoice(Request $request, $id)
    {
        // dd($request->id);

        $sale = Sale::where('id', $request->id)->first();
        // dd($sale);

        $details = SaleDetails::where('sales_id', $request->id)->get(); // Get all sale details
        // dd($details);

        $customer = Customer::where('id', $sale->customer_id)->first();
        // dd($customer);

        $currentDate = Carbon::now()->toFormattedDateString();

        return view('backend.invoice.invoice', compact('details', 'currentDate', 'sale', 'customer'));
    }



    public function reportPDF(Request $request)
    {
        $result = $request->id;

        // Find the sale by ID
        $sale = Sale::where('id', $result)->first();
        if (!$sale) {
            return redirect()->back()->withErrors(['message' => 'Sale not found.']);
        }

        $customer = Customer::where('id', $sale->customer_id)->first();
        // dd($customer);

        // Find sale details by sales_id
        $details = SaleDetails::where('sales_id', $result)->get();
        if ($details->isEmpty()) {
            return redirect()->back()->withErrors(['message' => 'Sale details not found.']);
        }

        $currentDate = Carbon::now()->toFormattedDateString();

        $pdf = PDF::loadView('backend.invoice.pdf', compact('sale', 'details', 'currentDate', 'customer'))->setPaper('a4', 'landscape');
        return $pdf->download('ReportDetailSales' . '.pdf');
    }

    public function print(Request $request)
    {
        $result = $request->id;

        $sale = Sale::where('id', $request->id)->first();
        // dd($sale);

        $details = SaleDetails::where('sales_id', $request->id)->get(); // Get all sale details
        // dd($details);

        $customer = Customer::where('id', $sale->customer_id)->first();
        // dd($customer);

        $currentDate = Carbon::now()->toFormattedDateString();

        return view('backend.invoice.print', compact('details', 'currentDate', 'sale', 'customer'));
    }

    // public function reportPDF(Request $request)
    // {
    //     $result = $request->id;
    //     // dd($result);

    //     $payrolles = DB::table('payrolles')->where('id', $request->id)->first();
    //     $employees = DB::table('employees')->where('id', $payrolles->employee_id)->first(); 

    //     $spell = SpellNumber::value($payrolles->net_salary)
    //         ->locale('en') 
    //         ->currency('Taka')
    //         ->fraction('Paisa')
    //         ->toMoney();

    //         $spell = ucfirst($spell);

    //         $pdf = PDF::loadView('backend.slip_generate.pdf',compact('payrolles','employees','spell'))->setPaper('a4', 'landscape');
    //         return $pdf->download('ReportDetailSalary'.'.pdf');
    // }


}
