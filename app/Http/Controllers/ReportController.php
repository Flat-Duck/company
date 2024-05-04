<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Invoice;
use App\Models\Issue;
use App\Models\Item;
use App\Models\Office;
use App\Models\Order;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $offices = Office::pluck('name', 'id');
        return view('app.reports.index', compact('offices'));
    }
    /**
     * Display a listing of the resource.
     */
    public function inventory(Request $request): View
    {
        $type = $request->type;
        
        $items = Item::latest()->paginate(150)->withQueryString();

        return view('app.reports.inventory', compact('items', 'type'));
    }

    /**
     * Display a listing of the resource.
     */
    public function  invoices(Request $request): View
    {
        $type = $request->type;
        
        $invoices = Invoice::where('type', $request->type)->latest()->paginate(150)->withQueryString();

        return view('app.reports.invoices', compact('invoices', 'type'));
    }

    /**
     * Display a listing of the resource.
     */
    public function  issues(Request $request): View
    {
        $type = "أذونات الصرف";
        
        $issues = Issue::latest()->paginate(150)->withQueryString();

        return view('app.reports.issues', compact('issues', 'type'));
    }

        /**
     * Display a listing of the resource.
     */
    public function  orders(Request $request): View
    {
        if ($request->office_id == 0) {
            $type = "متطلبات جميع المكاتب"; 
            $orders = Order::latest()->paginate(150)->withQueryString();
            return view('app.reports.orders', compact('orders', 'type'));
        }
        $office = Office::find($request->office_id)->name;
        $type = " متطلبات مكتب " .$office; 
        
        $orders = Order::where('office_id', $request->office_id)->latest()->paginate(150)->withQueryString();

        return view('app.reports.orders', compact('orders', 'type'));
    }
}
