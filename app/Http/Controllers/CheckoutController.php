<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CheckoutController extends Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $paymentMethods = $this->InitiatePayment()->json('Data.PaymentMethods', []);

        return view('checkout', get_defined_vars());
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @throws \Throwable
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $data = $request->except('user');
        $data['user_id'] = auth()->id();
        $data['coupon_id'] = data_get(session('coupon'), 'id');

        if ($userData = data_get($request->all(), 'user')) {
            if (isset($userData['email']) && User::whereEmail($userData['email'])->exists()) {
                $customer = Customer::firstOrCreate([
                    'email' => $userData['email'],
                ], $userData);
            } else {
                $customer = Customer::firstOrCreate([
                    'phone' => $userData['phone'],
                ], $userData);
            }

            $data['user_id'] = $customer->id;
            $data['name'] = $userData['name'];
            $data['phone'] = $userData['phone'];
        }

        $order = Order::create($data);

        foreach (session('cart', []) as $item) {
            $order->items()->create($item);
        }

        DB::commit();

        session()->forget('cart');
        session()->forget('coupon');

        return $this->executePayment($order);
    }

    public function InitiatePayment()
    {
        $total = array_sum(
            array_map(
                function ($item) {
                    $type = $item['item_type'];

                    return $type::find($item['item_id'])->getPrice() * $item['qty'];
                },
                session('cart', [])
            )
        ) - (data_get(session('coupon'), 'discount') ?? 0);

        $token = $this->getToken();

        $basURL = "https://apitest.myfatoorah.com/";

        $response = Http::withToken($token)
            ->post("$basURL/v2/InitiatePayment", [
                'InvoiceAmount' => $total,
                'CurrencyIso' => currency()->code ?: 'KWD',
            ])
            ->onError(function () {
                throw ValidationException::withMessages([
                    'payment' => [__('لا يمكنك الدفع عن طرق ماى فاتوره من فضلك راجع البائع')],
                ]);
            });

        return $response;
    }

    public function executePayment($order)
    {
        $token = $this->getToken();
        $basURL = "https://apitest.myfatoorah.com/";

        $response = Http::withToken($token)
            ->post("$basURL/v2/InitiatePayment", [
                'InvoiceAmount' => $order->total,
                'CurrencyIso' => currency()->code ?: 'KWD',
            ])
            ->onError(function () {
                return redirect('/')->withErrors([
                    'payment' => __('لا يمكن الدفع عن طريق ماى فاتورة حاليا'),
                ]);
            });

        if ($response->successful() && $response->json('IsSuccess')) {
            $data = [
                'PaymentMethodId' => $order->payment_method,
                'CustomerName' => $order->name,
                'DisplayCurrencyIso' => currency()->code ?: 'KWD',
                'MobileCountryCode' => '+965',
                'CustomerMobile' => $order->phone,
                'CustomerEmail' => $order->customer->email,
                'InvoiceValue' => $order->total,
                'CallBackUrl' => url('/'),
                'ErrorUrl' => url('payment/failed'),
                'Language' => app()->getLocale(),
                'CustomerReference' => "customer-{$order->user_id}",
                'ExpireDate' => '',
                'CustomerAddress' => [
                    'Block' => '',
                    'Street' => $order->street,
                    'HouseBuildingNo' => '',
                    'Address' => $order->address,
                    'AddressInstructions' => $order->city,
                ],
            ];
            $response = Http::withToken($token)->post("$basURL/v2/ExecutePayment", $data);

            if ($response->successful() && $response->json('IsSuccess')) {
                flash(__('Order has been added successfully.'));

                return redirect()->away($response->json('Data.PaymentURL'));
            }
        }

        $order->delete();

        return redirect('/')->withErrors([
            'payment' => __('لا يمكن الدفع عن طريق ماى فاتورة حاليا'),
        ]);
    }

    public function paymentFailed()
    {
        return redirect('/')->withErrors([
            'payment' => __('لا يمكن الدفع عن طريق ماى فاتورة حاليا'),
        ]);
    }

    /**
     * @return string
     */
    private function getToken()
    {
        return "rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL";
    }
}
