<?php

namespace Modules\Buy\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Buy\Entities\Buy;
use Modules\Store\Entities\Store;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgError;
use function App\Providers\ReturnMsgSuccess;

class BuyController extends Controller
{
//نمایش لیست درخواست های خرید نمایندگان
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $checkUsers = Buy::whereNull('replay')->get();
            return DataTables::of($checkUsers)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    $users = User::where('id', $row->user_id)->get();
                    foreach ($users as $user)
                        return $user->name;
                })
                ->addColumn('code', function ($row) {
                    $stores = Store::where('id', $row->store_id)->get();
                    foreach ($stores as $store)
                        return $email = "<label class=\"btn btn-danger\">{$store->code}</label>";
                })
                ->addColumn('number', function ($row) {
                    return $email = "<label class=\"btn btn-primary\">{$row->number}</label>";
                })
                ->addColumn('created_at', function ($row) {
                    $created_at = Jalalian::forge($row->created_at)->ago();
                    return $created_at = "<label class=\"btn btn-info\">{$created_at}</label>";

                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.buy.user.success', $row->id) . '"><img src="/icon/icons8-ok-48.png" title="تایید درخواست" width="30" height="30"></a>';
                    $btn .= '<a href="' . route('admin.buy.user.error', $row->id) . '"><img src="/icon/icons8-delete-48.png" title="در کردن درخواست" width="30" height="30"></a>';
                    $btn .= '<a href="' . route('admin.store.user.details', $row->id) . '"><img src="/icon/icons8-view-64.png" title="مشاهده جزییات" width="30" height="30"></a>';

                    return $btn;
                })
                ->rawColumns(['action', 'code', 'number', 'created_at'])
                ->make(true);
        }


        return view('buy::index');
    }

    //موافقت با درخواست خرید نماینده و ثبت در پروفایل
    public function success(Buy $id)
    {
        $buys = Buy::where('id', $id->id)->get();
        foreach ($buys as $buy)
            Buy::find($buy->id)->update([
                'replay' => 1,
            ]);
        $client = new \GuzzleHttp\Client();
        $client->request('POST', 'http://127.0.0.1:8000/api/buy',
            ['form_params' => [
                'id' => $buy->id,
            ]
            ]);


        return ReturnMsgSuccess('با درخواست خرید نماینده موافقت شد');
    }

    //رد کردن درخواست خرید نماینده و ثبت در پروفایل
    public function error(Buy $id)
    {
        $buys = Buy::where('id', $id->id)->get();
        foreach ($buys as $buy)
            Buy::find($buy->id)->update([
                'replay' => 0,
            ]);
        $client = new \GuzzleHttp\Client();
        $client->request('POST', 'http://127.0.0.1:8000/api/error',
            ['form_params' => [
                'id' => $buy->id,
            ]
            ]);
        return ReturnMsgError('با درخواست خرید نماینده موافقت نشد');
    }

    //نمایش لیست درخواست خرید های بایگانی شده
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $checkUsers = Buy::whereNotNull('replay')->get();
            return DataTables::of($checkUsers)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    $users = User::where('id', $row->user_id)->get();
                    foreach ($users as $user)
                        return $user->name;
                })
                ->addColumn('code', function ($row) {
                    $stores = Store::where('id', $row->store_id)->get();
                    foreach ($stores as $store)
                        return $email = "<label class=\"btn btn-danger\">{$store->code}</label>";
                })
                ->addColumn('number', function ($row) {
                    return $email = "<label class=\"btn btn-primary\">{$row->number}</label>";
                })
                ->addColumn('created_at', function ($row) {
                    $created_at = Jalalian::forge($row->created_at)->ago();
                    return $created_at = "<label class=\"btn btn-info\">{$created_at}</label>";

                })
                ->addColumn('action', function ($row) {
                    if ($row->replay == "1") {
                        return $email = "<label class=\"btn btn-success\">تایید شده</label>";

                    } elseif ($row->replay == "0") {
                        return $email = "<label class=\"btn btn-danger\">تایید نشده</label>";

                    } else
                        return $email = "<label class=\"btn btn-info\">در انتظار پاسخ</label>";
                })
                ->rawColumns(['action', 'code', 'number', 'created_at'])
                ->make(true);
        }

        return view('buy::show');

    }

}
