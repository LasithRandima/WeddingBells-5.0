<?php

namespace App\Http\Controllers;

use App\Mail\WeddingBellsPackages;
use App\Models\Payment;
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{

    private $gateway;

    public function __construct() {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function pay(Request $request)
    {
        try {
            \Log::info('Request Data 1 : ' . print_r($request->all(), true));

            // Store values in the session
            $request->session()->put('payment_data', [
                'package_id' => $request->package_id,
                'amount' => $request->amount,
                'v_id' => $request->v_id,
                'actual_v_id' => $request->actual_v_id,
                'v_email' => $request->v_email,
                'image_count' => $request->image_count,
                'ads_count' => $request->ads_count,
                'top_ads_count' => $request->top_ads_count,
            ]);

            $response = $this->gateway->purchase(array(
                'amount' => $request->amount,
                'package_id' => $request->package_id,
                'v_id' => $request->v_id,
                'actual_v_id' => $request->actual_v_id,
                'v_email' => $request->v_email,
                'package_id' => $request->package_id,
                'image_count' => $request->image_count,
                'ads_count' => $request->ads_count,
                'top_ads_count' => $request->top_ads_count,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error')
            ))->send();

            if ($response->isRedirect()) {
                $response->redirect();
            } else {
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }




    public function success(Request $request)
    {
        try {
            \Log::info('Payment success callback received.');

            // Retrieve values from the session
            $paymentData = $request->session()->get('payment_data');

            if (!$paymentData) {
                \Log::error('Payment data not found in the session.');
                return 'An error occurred.';
            }

            $paymentId = $request->input('paymentId');
            $payerId = $request->input('PayerID');

            if ($paymentId && $payerId) {
                \Log::info('Payment ID: ' . $paymentId);
                \Log::info('Payer ID: ' . $payerId);
                \Log::info('User ID: ' . $paymentData['v_id']);

                $transaction = $this->gateway->completePurchase([
                    'payer_id' => $payerId,
                    'transactionReference' => $paymentId,
                ]);

                $response = $transaction->send();

                if ($response->isSuccessful()) {
                    $arr = $response->getData();
                    \Log::info('PayPal response data: ' . print_r($arr, true));

                    // Check if required fields are present
                    if ($paymentData['v_id'] && $paymentData['actual_v_id'] && $paymentData['v_email'] && $paymentData['package_id']) {
                        // Find or create the existing Payment instance
                        $payment = Payment::updateOrCreate(
                            ['v_id' => $paymentData['v_id']],
                            [
                                'payment_id' => $arr['id'],
                                'payer_id' => $arr['payer']['payer_info']['payer_id'],
                                'payer_email' => $arr['payer']['payer_info']['email'],
                                'actual_v_id' => $paymentData['actual_v_id'],
                                'v_email' => $paymentData['v_email'],
                                'package_id' => $paymentData['package_id'],
                                'amount' => $arr['transactions'][0]['amount']['total'],
                                'currency' => env('PAYPAL_CURRENCY'),
                                'image_count' => $paymentData['image_count'],
                                'ads_count' => $paymentData['ads_count'],
                                'top_ads_count' => $paymentData['top_ads_count'],
                                'payment_status' => $arr['state'],
                            ]
                        );

                        $vendorName = DB::table('vendors')->select('v_name')->where('id', '=', $paymentData['actual_v_id'])->value('v_name');
                        $packageName = DB::table('site_packages')->select('pkg_name')->where('id', '=', $paymentData['package_id'])->value('pkg_name');
                        $boughtDate = now()->format('Y-m-d');
                        $expirationDate = now()->addYear()->format('Y-m-d');

                        // Send email notification to the vendor
                        Mail::to($paymentData['v_email'])->send(new WeddingBellsPackages($vendorName, $packageName,  $paymentData['image_count'], $paymentData['ads_count'], $paymentData['top_ads_count'],$boughtDate, $expirationDate));


                        return redirect()->route('dashboard')
                            ->with('success', 'Payment is Successful. Package Added Successfully. Vendor will be notified via email.');
                    } else {
                        \Log::error('Required fields are missing.');
                        return 'Required fields are missing.';
                    }
                } else {
                    \Log::error('PayPal response error: ' . $response->getMessage());
                    return $response->getMessage();
                }
            } else {
                \Log::error('Payment ID or Payer ID is missing.');
                return 'Payment declined!!';
            }
        } catch (\Exception $e) {
            \Log::error('Error in success method: ' . $e->getMessage());
            return 'An error occurred.';
        } finally {
            // Clear the session after use
            $request->session()->forget('payment_data');
        }
    }






    public function error()
    {
        return 'User declined the payment!';
    }




    public function freepayment(Request $request)
    {
        // dd($request->all());
        try {
            // Retrieve values from the form
            $packageId = $request->package_id;
            $amount = $request->amount;
            $vId = $request->v_id;
            $actualVId = $request->actual_v_id;
            $vEmail = $request->v_email;
            $imageCount = $request->image_count;
            $adsCount = $request->ads_count;
            $topAdsCount = $request->top_ads_count;

            // Check if the user is already subscribed to a package
            $payment = DB::table('payments')->where('v_id', '=', $vId)->first();

            // if ($payment) {
            //     // User is already subscribed, you can show a message or redirect if needed
            //     return redirect()->back()->with('error', 'You are already subscribed to a package.');
            // }

            // User is not subscribed, create a new payment record
            $paymentss = Payment::updateOrCreate(
                ['v_id' => $vId],
                [
                    'payment_id' => 'free_payment',
                    'payer_id' => 'free_payment',
                    'payer_email' => 'freepayment@gmail.com',
                    'actual_v_id' => $actualVId,
                    'v_email' => $vEmail,
                    'package_id' => $packageId,
                    'amount' => $amount,
                    'currency' => 'USD',
                    'image_count' => $imageCount,
                    'ads_count' => $adsCount,
                    'top_ads_count' => $topAdsCount,
                    'payment_status' => 'free_account',
                ]
            );

            $vendorName = DB::table('vendors')->select('v_name')->where('id', '=', $actualVId)->value('v_name');
            $packageName = DB::table('site_packages')->select('pkg_name')->where('id', '=', $packageId)->value('pkg_name');
            $boughtDate = now()->format('Y-m-d');
            $expirationDate = now()->addYear()->format('Y-m-d');

            // Send email notification to the vendor
            Mail::to($vEmail)->send(new WeddingBellsPackages($vendorName, $packageName, $imageCount, $adsCount, $topAdsCount, $boughtDate, $expirationDate));

            // Redirect or show a success message as needed
            return redirect()->route('dashboard')->with('success', 'Subscription to free plan successful.');
        } catch (\Exception $e) {
            // Handle exceptions as needed
            \Log::error('Error in freepayment method: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
    }








}
