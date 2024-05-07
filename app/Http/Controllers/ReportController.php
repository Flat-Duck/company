<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Extoutbox;
use App\Models\Inbox;
use App\Models\Intoutbox;
use App\Models\MainFolder;
use App\Models\Memo;
use App\Models\OutboxReport;
use App\Models\SubFolder;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Invoice;
use App\Models\Issue;
use App\Models\Item;
use App\Models\Office;
use App\Models\Order;
use App\Models\User;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $mains = MainFolder::all();
        $subs = SubFolder::all();
        return view('app.reports.index', compact('mains', 'subs'));
    }
    /**
     * Display a listing of the resource.
     */
    public function messages(Request $request): View
    {
        $report = $request->type;
        $type = "تقرير رسائل ";
        $items = [];
        if($report == "inbox"){
            $type = "تقرير رسائل الوارد";
            $items = Inbox::all();
        }
        if($report == "extoutboxes"){
            $type = "تقرير رسائل الصادر الخارجي";
            $items =  Extoutbox::all();
        }
        if($report == "intoutboxes"){
            $type = "تقرير رسائل الصادر الداخلي";
            $items = Intoutbox::all();
        }
        if($report == "memos"){
            $type = "تقرير رسائل المعاملات الأخرى";
            $items = Memo::all();
        }
        if($report == "outboxes"){
            $type = "تقرير رسائل الصادر داخلي وخارجي";

            $exts = Extoutbox::all();
            $extsWithFlag = $exts->map(function ($ext) {
                unset($ext->id);
                $ext->type = $ext::NAME;
                return $ext;
            });

            $ints = Intoutbox::all();
            $intsWithFlag = $ints->map(function ($int) {
                unset($int->id);
                $int->type = $int::NAME;
                return $int;
            });
                    
            $mergedCollection = collect($intsWithFlag->toArray())->merge($extsWithFlag->toArray());
            $items = $mergedCollection->map(function ($attributes) {
                return new OutboxReport($attributes);
            });
             
             
            $items = $items->sortBy('created_at');


        }
        
        return view('app.reports.messages', compact('items', 'type'));
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
    public function  users(Request $request): View
    {
        $type = "تقرير المستخدمين";
        
        $items = User::all();

        return view('app.reports.users', compact('items', 'type'));
    }

    /**
     * Display a listing of the resource.
     */
    public function main_folders(Request $request): View
    {
        $type = "تقرير المجلدات الرئيسية";
        
        $items = MainFolder::all();

        return view('app.reports.folders', compact('items', 'type'));
    }

    /**
     * Display a listing of the resource.
     */
    public function activity(Request $request): View
    {
        $type = "تقرير نشاطات المستخدمين";
        
        $items = Activity::all();

        return view('app.reports.activity', compact('items', 'type'));
    }

    /**
     * Display a listing of the resource.
     */
    public function sub_folders(Request $request): View
    {
        $type = "تقرير المجلدات الفرعية";

        $main = $request->mainid;
        if($main == 0){
            $items = SubFolder::all();
            return view('app.reports.folders', compact('items', 'type'));
        }
        
        $mainf = MainFolder::find($main);
        $type = $type. " لمجلد "  .$mainf->name;
        $items = $mainf->subFolders;
        return view('app.reports.folders', compact('items', 'type'));

        
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
