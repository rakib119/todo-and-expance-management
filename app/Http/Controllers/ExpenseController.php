<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        if (session('exp_cat_id')) {

            // return session('exp_cat_id');
            $expense = Expense::all()->where('created_by', auth()->id())->where('exp_cat_id', session('exp_cat_id'));
            Session::forget('exp_cat_id');
        } else {
            $expense = Expense::all()->where('created_by', auth()->id());
        }

        return view('Expense.index', [
            "noOfExpense" => Expense::count(),
            'expenses' => $expense,
            'total_spend_amount' => $expense->sum('spend_amount'),
            'categories' => Category::all()->where('status', 1)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Expense.create', [
            'categories' => Category::all()->where('status', 1)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'spend_amount' => 'required|numeric',
            'exp_cat_id' => 'required|numeric',
            'purpose' => 'required',
            'created_at' => 'nullable',
            'receipt' => 'nullable'
        ]);
        if ($request->hasFile('receipt')) {
            $request->validate([
                'receipt' => 'mimes:jpg,jpeg'
            ]);
            $extension = $request->file('receipt')->getClientOriginalExtension();
            $file_name = Str::random(8) . auth()->id() . "." . $extension;
            $save_link = base_path('public/assets/uploads/receipt/' . $file_name);
            Image::make($request->file('receipt'))->save($save_link);
        } else {
            $file_name = "";
        }
        if ($request->created_at != "") {
            $created_at = $request->created_at;
        } else {
            $created_at = Carbon::now();
        }
        Expense::insert([
            'spend_amount' => $request->spend_amount,
            'exp_cat_id' => $request->exp_cat_id,
            'purpose' => $request->purpose,
            'created_at' => $created_at,
            'created_by' => auth()->id(),
            'receipt' => $file_name
        ]);
        return redirect('expense')->with('success', 'Expense added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        return view('Expense.edit', [
            'expense_details' => $expense,
            'categories' => Category::all()->where('status', 1)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'spend_amount' => 'required|numeric',
            'exp_cat_id' => 'required|numeric',
            'purpose' => 'required',
            'created_at' => 'nullable',
            'receipt' => 'nullable'
        ]);
        if ($request->hasFile('receipt')) {
            $request->validate([
                'receipt' => 'mimes:jpg,jpeg'
            ]);
            if ($expense->receipt) {
                unlink(base_path('public/assets/uploads/receipt/' . $expense->receipt));
            }
            $extension = $request->file('receipt')->getClientOriginalExtension();
            $file_name = Str::random(8) . auth()->id() . "." . $extension;
            $save_link = base_path('public/assets/uploads/receipt/' . $file_name);
            Image::make($request->file('receipt'))->save($save_link);
            $expense->receipt = $file_name;
            $expense->save();
        }
        $expense->spend_amount = $request->spend_amount;
        $expense->exp_cat_id = $request->exp_cat_id;
        $expense->purpose = $request->purpose;
        $expense->created_at = $request->created_at;
        $expense->save();
        return redirect('expense')->with('success', 'Expense update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect('expense')->with('success', 'Expense deleted successfully');
    }
    public function sortByCategory(Request $request)
    {
        Session::put('exp_cat_id', $request->exp_cat_id);
        return response()->json($request);

        //
        // session('exp_cat_id',)
        // echo "hello";
        // return response()->json($request);
    }
}
