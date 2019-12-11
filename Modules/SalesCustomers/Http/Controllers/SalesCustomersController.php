<?php

namespace Modules\SalesCustomers\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\SalesCustomers\Entities\SalesCustomers;
use Morilog\Jalali\Jalalian;
use PhpParser\Node\Expr\BinaryOp\Spaceship;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgError;
use function App\Providers\ReturnMsgSuccess;
use function App\Providers\ReturnMsgInfo;

class SalesCustomersController extends Controller
{
    //نمایش لیست نمایندگان فروش در انتظار پاسخ
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $checkUsers = SalesCustomers::whereNull('success')->get();
            return DataTables::of($checkUsers)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('email', function ($row) {
                    return $email = "<label class=\"btn btn-success\">{$row->email}</label>";
                })
                ->addColumn('created_at', function ($row) {
                    $created_at = Jalalian::forge($row->created_at)->ago();
                    return $created_at = "<label class=\"btn btn-info\">{$created_at}</label>";

                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.sales.user.success', $row->id) . '"><img src="/icon/icons8-ok-48.png" title="تایید نماینده" width="30" height="30"></a>';
                    $btn .= '<a href="' . route('admin.sales.user.error', $row->id) . '"><img src="/icon/icons8-delete-48.png" title="رد درخواست" width="30" height="30"></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'email', 'created_at'])
                ->make(true);
        }
        return view('salescustomers::index');
    }

    //موافقت با درخواست نماینده فروش و ارسال پاسخ به پروفایل نماینده و ارسال پیامک به شماره همراه نماینده
    public function success(SalesCustomers $id)
    {
        $users = SalesCustomers::where('id', $id->id)->get();
        foreach ($users as $user)
            $sales = SalesCustomers::find($user->id)->update([
                'success' => 1,

            ]);

        $client = new \GuzzleHttp\Client();
        $client->request('POST', 'http://127.0.0.1:8000/api/success',
            ['form_params' => [
                'agent_id' => $user->agent_id,
            ]
            ]);

        return ReturnMsgSuccess('نماینده فروش تایید شد و پیام تایید شدن برای نماینده ارسال میشود');
    }

    //در درخواست نماینده فروش و ارسال پاسخ به پروفایل نماینده و ارسال پیامک به شماره همراه نماینده
    public function error(SalesCustomers $id)
    {
        $users = SalesCustomers::where('id', $id->id)->get();
        foreach ($users as $user)
            $sales = SalesCustomers::find($user->id)->update([
                'success' => 0,

            ]);

        $client = new \GuzzleHttp\Client();
        $client->request('POST', 'http://127.0.0.1:8000/api/error',
            ['form_params' => [
                'agent_id' => $user->agent_id,
            ]
            ]);
        return ReturnMsgError('درخواست نماینده فروش رد شد و پیام برای نماینده ارسال خواهد شد');
    }

    //نمایش لیست نمایندگان فروش
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $checkUsers = SalesCustomers::where('success', 1)->get();
            return DataTables::of($checkUsers)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('email', function ($row) {
                    return $email = "<label class=\"btn btn-success\">{$row->email}</label>";
                })
                ->addColumn('created_at', function ($row) {
                    $created_at = Jalalian::forge($row->created_at)->ago();
                    return $created_at = "<label class=\"btn btn-info\">{$created_at}</label>";

                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.sales.user.wizard', $row->id) . '"><img src="/icon/icons8-update-64.png" title="ویرایش" width="30" height="30"></a>';
                    $btn .= '<a href="' . route('admin.sales.user.error', $row->id) . '"><img src="/icon/man (1).png" title="سلب امتیاز نماینده" width="30" height="30"></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'email', 'created_at'])
                ->make(true);
        }
        return view('salescustomers::show');
    }

    //فرم نمایش اطلاعات پرسنل
    public function wizard(SalesCustomers $id)
    {
        return view('salescustomers::wizard', compact('id'));
    }

    //ویرایش اطلاعات نماینده و ارسال اطلاعات ویرایش شده به پروفایل و اطلاع رسانی به نماینده از طریق پیامک
    public function store(Request $request)
    {

        $users = SalesCustomers::where('id', $request['id'])->get();
        foreach ($users as $user)
            if ($request['password'] == null) {
                $pass = $user->password;
            } else {
                $pass = Hash::make($request['password']);
            }
        SalesCustomers::find($user->id)->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'success' => $request['success'],
            'password' => $pass,
        ]);
        $sales = SalesCustomers::where('id', $user->id)->get();
        foreach ($sales as $sale)
            $client = new \GuzzleHttp\Client();
        $client->request('POST', 'http://127.0.0.1:8000/api/EditUser',
            ['form_params' => [
                'agent_id' => $sale->agent_id,
                'name' => $sale->name,
                'email' => $sale->email,
                'password' => $sale->password,
                'success' => $sale->success,
            ]
            ]);

        return redirect()->route('admin.sales.user.show', ReturnMsgSuccess('اطلاعات نماینده با موفقیت ویرایش شد و از طریق پیامک به نماینده اطلاع داده میشود'));

    }

}
