<?php

namespace Modules\Store\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\DetailsStore\Entities\DetailsStore;
use Modules\SalesCustomers\Entities\SalesCustomers;
use Modules\Store\Entities\Store;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgSuccess;

class StoreController extends Controller
{
    //نمایش فرم ثبت محصولات در انبار
    public function wizard()
    {
        return view('store::wizard');
    }

    //ثبت محصولات در انبار و ارسال برای پنل نمایندگان
    public function store(Request $request)
    {
        $stores = Store::where('code', $request->code)->get();
        foreach ($stores as $store)
            if (!empty($store)) {
                $nums = Store::where('id', $store->id)->get();
                foreach ($nums as $num)
                    Store::find($num->id)->update([
                        'number' => $store->number + $request->number,
                    ]);
                $sum = $num->number + (int)$request['number'];
                DetailsStore::create($request->all());
                $client = new \GuzzleHttp\Client();
                $client->request('POST', 'http://127.0.0.1:8000/api/store',
                    ['form_params' => [
                        'name' => $num->name,
                        'code' => $num->code,
                        'number' => $sum,
                    ]
                    ]);
                return ReturnMsgSuccess('مشخصات محصول با موفقیت در سیستم ثبت شد');
            }
        $number = Store::create([
            'name' => $request['name'],
            'code' => $request['code'],
            'number' => $request['number'],
        ]);
        DetailsStore::create($request->all());
        $client = new \GuzzleHttp\Client();
        $client->request('POST', 'http://127.0.0.1:8000/api/store',
            ['form_params' => [
                'name' => $number->name,
                'code' => $number->code,
                'number' => $number->number,
            ]
            ]);
        return ReturnMsgSuccess('مشخصات محصول با موفقیت در سیستم ثبت شد');

    }

    //نمایش لیست جمع موجودی انبار
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $checkUsers = Store::get();
            return DataTables::of($checkUsers)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('code', function ($row) {
                    return $email = "<label class=\"btn btn-danger\">{$row->code}</label>";
                })
                ->addColumn('number', function ($row) {
                    return $email = "<label class=\"btn btn-primary\">{$row->number}</label>";
                })
                ->addColumn('created_at', function ($row) {
                    $created_at = Jalalian::forge($row->created_at)->ago();
                    return $created_at = "<label class=\"btn btn-info\">{$created_at}</label>";

                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.sales.user.wizard', $row->id) . '"><img src="/icon/icons8-update-64.png" title="ویرایش" width="30" height="30"></a>';
                    $btn .= '<a href="' . route('admin.store.user.details', $row->id) . '"><img src="/icon/icons8-view-64.png" title="مشاهده جزییات" width="30" height="30"></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'code', 'number', 'created_at'])
                ->make(true);
        }
        return view('store::show');
    }

    //نمایش لیست جزییات محصولات تولید شده و ثبت شده در انبار
    public function details(Store $id)
    {

        $stores = DetailsStore::where('code', $id->code)->get();
        return view('store::detail', compact('stores'));
    }

}
