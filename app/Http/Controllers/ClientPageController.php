<?php

namespace App\Http\Controllers;

use App\Models\CodeVoucher;
use App\Models\Technology;
use App\Models\Transaction;
use App\Models\UploadFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class ClientPageController extends Controller
{
    public function home(DataController $data)
    {
        $data = [
            'sources' => $data->globalSourceCode(10, true),
        ];
        return view('pages.Client.home', $data)->with('pages', 'home');
    }

    public function contact(DataController $data)
    {
        $data = [
            'sources' => $data->globalSourceCode(10, true),
        ];
        return view('pages.Client.contact', $data)->with('pages', 'contact');
    }

    public function source_code(DataController $data, Request $request)
    {
        $data = [
            'technologies' => $data->globalTechnologies(10),
            'categories' => $data->globalCategories(100),
            'sources' => $data->globalSourceCode(10, false, $request->query('query')),
        ];
        return view('pages.Client.source_code', $data)->with('pages', 'source code');
    }

    public function detail_source_code(DataController $data, Request $request, $slug)
    {
        $data = [
            'technologies' => $data->globalTechnologies(10),
            'categories' => $data->globalCategories(100),
            'sources' => $data->globalSourceCode(10, false, $request->query('query')),
            'detail' => $data->showSourceCode($slug),
        ];
        return view('pages.Client.detail_source_code', $data)->with('pages', 'detail source code');
    }

    public function source_payment(DataController $data, Request $request, $crsf, $slug)
    {
        if ($crsf !== csrf_token()) {
            abort(403, 'HALAMAN KADALUARSA, MOHOM KEMBALI');
        }

        $detail = $data->showSourceCode($slug);
        $userId = Auth::id();

        try {
            $transaction = Transaction::where('user_id', $userId)->where('source_code', $detail->id)->latest()->first();

            if ($transaction && $transaction->transaction_status === 'success') {
                return view('pages.Client.source_payment', [
                    'technologies' => $data->globalTechnologies(10),
                    'categories' => $data->globalCategories(100),
                    'sources' => $data->globalSourceCode(10, false, $request->query('query')),
                    'detail' => $detail,
                    'CLIENT_KEY' => env('CLIENT_KEY'),
                    'SNAP_TOKEN' => null,
                    'transaction' => $transaction,
                ])->with('pages', 'source code payment');
            }

            if (!$transaction) {
                $order_id = 'INV-' . time() . '-' . $userId;

                $transaction = Transaction::create([
                    'user_id' => $userId,
                    'source_code' => $detail->id,
                    'price' => $detail->price,
                    'gross_amount' => $detail->price,
                    'order_id' => $order_id,
                    'transaction_status' => 'pending',
                    'currency' => 'IDR',
                ]);
            } else {
                $order_id = $transaction->order_id;
            }

            // Konfigurasi Midtrans
            \Midtrans\Config::$serverKey = env('SNAP_TOKEN');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $gross_amount = $transaction->price;
            if (!empty($transaction->percent)) {
                $gross_amount -= $transaction->price * ($transaction->percent / 100);
            }

            $params = [
                'transaction_details' => [
                    'order_id' => $order_id,
                    'gross_amount' => $gross_amount,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
            ];


            $SNAP_TOKEN = \Midtrans\Snap::getSnapToken($params);

            return view('pages.Client.source_payment', [
                'technologies' => $data->globalTechnologies(10),
                'categories' => $data->globalCategories(100),
                'sources' => $data->globalSourceCode(10, false, $request->query('query')),
                'detail' => $detail,
                'CLIENT_KEY' => env('CLIENT_KEY'),
                'SNAP_TOKEN' => $SNAP_TOKEN,
                'transaction' => $transaction,
            ])->with('pages', 'source code payment');
        } catch (\Exception $e) {
            return view('pages.Client.source_payment', [
                'technologies' => $data->globalTechnologies(10),
                'categories' => $data->globalCategories(100),
                'sources' => $data->globalSourceCode(10, false, $request->query('query')),
                'detail' => $detail,
                'CLIENT_KEY' => env('CLIENT_KEY'),
                'SNAP_TOKEN' => null,
                'transaction' => $transaction,
                'error' => $e->getMessage(),
            ])->with('pages', 'source code payment');
        }
    }

    public function voucher(DataController $data, Request $request, $crsf, $slug)
    {
        $voucher = CodeVoucher::where('code', $request->voucher)->first();
        if (!$voucher) {
            return redirect()->back()->with('error', 'Voucher tidak ditemukan, pakai voucher yang lain.');
        }
        if ($crsf !== csrf_token()) {
            abort(403, 'HALAMAN KADALUARSA');
        }

        $detail = $data->showSourceCode($slug);
        $transaction = Transaction::where('user_id', Auth::id())->where('source_code', $detail->id)->latest()->first();
        if (!$transaction) {
            abort(404);
        }
        $transaction->update([
            'voucher' => $voucher->id,
            'percent' => $voucher->percent,
        ]);
        return redirect()
            ->back()
            ->with('success', 'Voucher ditemukan, dengan potongan harga sebesar ' . $voucher->percent . ' %');
    }

    public function payment(Request $request)
    {
        try {
            $request->validate([
                'transaction_id' => 'required',
                'order_id' => 'required',
                'payment_type' => 'required',
                'gross_amount' => 'required|numeric',
                'transaction_status' => 'required',
                'fraud_status' => 'nullable',
                'signature_key' => 'nullable',
                'approval_code' => 'nullable',
            ]);

            $transaction = Transaction::where('order_id', $request->order_id)->first();

            if (!$transaction) {
                return response()->json(['error' => 'Transaksi tidak ditemukan'], 404);
            }

            $transaction->update([
                'transaction_id' => $request->transaction_id,
                'payment_type' => $request->payment_type,
                'gross_amount' => $request->gross_amount,
                'transaction_status' => $request->transaction_status,
                'fraud_status' => $request->fraud_status ?? null,
                'signature_key' => $request->signature_key ?? null,
                'approval_code' => $request->approval_code ?? null,
            ]);

            if ($request->transaction_status == 'settlement') {
                $message = 'Pembayaran berhasil!';
            } elseif ($request->transaction_status == 'pending') {
                $message = 'Pembayaran sedang diproses.';
            } elseif ($request->transaction_status == 'deny') {
                $message = 'Pembayaran ditolak.';
            } elseif ($request->transaction_status == 'expire') {
                $message = 'Pembayaran kadaluarsa.';
            } elseif ($request->transaction_status == 'cancel') {
                $message = 'Pembayaran dibatalkan.';
            } else {
                $message = 'Status pembayaran tidak dikenal.';
            }

            return response()->json([
                'message' => $message,
                'transaction' => $transaction,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function download($order_id)
    {
        $transaction = Transaction::with('source')->where('order_id', $order_id)->first();

        if (!$transaction || $transaction->transaction_status !== 'success') {
            return response()->json([
                'success' => false,
                'message' => 'File tidak tersedia. Pastikan transaksi berhasil sebelum mengunduh.',
            ]);
        }

        $filePath = 'storage/' . $transaction->source->file_url;

        if (!Storage::exists(str_replace('storage/', 'public/', $filePath))) {
            return response()->json([
                'success' => false,
                'message' => 'File tidak ditemukan!',
            ]);
        }

        return response()->download(public_path($filePath));
    }

    public function invoice($order_id)
    {
        $transaction = Transaction::where('order_id', $order_id)->first();
        if (!$transaction) {
            abort(404);
        }
        $technologies = Technology::all();
        return view('pages.Client.invoice', compact('transaction', 'technologies'))->with('pages', 'Invoice');
    }
}
