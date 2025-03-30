<?php

namespace App\Http\Controllers;

use App\Models\FeedBack;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Redirecciona a la vista dashboard
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function home()
    {
        return redirect('dashboard');
    }

    /**
     * Redirecciona a la vista dashboard
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function dashboard($status = 'success', $message = null, $view = false)
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $transactions = Transaction::where('status', 1)->get();
        $feedbacks = Feedback::orderBy('id', 'DESC')->limit(100)->get();
        $currentYear = date('Y');

        $salesByMonth = Transaction::selectRaw('MONTH(created_at) as month, SUM(price) as total')
            ->where('status', 1)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        $salesData = array_fill(0, 12, 0);

        foreach ($salesByMonth as $month => $total) {
            $salesData[$month - 1] = $total;
        }

        $completed = 0;
        $pending = 0;
        $failed = 0;
        $declined = 0;
        $cancelled = 0;

        foreach ($transactions as  $transaction) {
            if ($transaction->transaction_status == 'completed') {
                $completed += $transaction->price;
            } elseif ($transaction->transaction_status == 'pending') {
                $pending += $transaction->price;
            } elseif ($transaction->transaction_status == 'failed') {
                $failed += $transaction->price;
            } elseif ($transaction->transaction_status == 'declined') {
                $declined += $transaction->price;
            } elseif ($transaction->transaction_status == 'cancelled') {
                $cancelled += $transaction->price;
            }
        }
        $grantTotal = $completed + $pending + $failed + $declined + $cancelled;

        $completed = number_format($completed, 0, ',', '.');
        $pending = number_format($pending, 0, ',', '.');
        $failed = number_format($failed, 0, ',', '.');
        $declined = number_format($declined, 0, ',', '.');
        $grantTotal = number_format($grantTotal, 0, ',', '.');

        if ($view == false) {
            $message = '';
        } else {
            $message = !empty($message) ? $message : 'Bienvenido.';
        }

        return getResponse(
            'dashboard',
            compact(
                'transactions',
                'totalUsers',
                'totalProducts',
                'completed',
                'pending',
                'failed',
                'declined',
                'cancelled',
                'grantTotal',
                'salesData',
                'months',
                'currentYear',
                'feedbacks',
            ),
            $status,
            $message
        );
    }

    /**
     * Obtiene los 10 productos más vendidos
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function getTopTenProducts()
    {

        $date = request()->date;
        $targetDate = date("Y-m-d", strtotime($date));
        $status = 'success';

        $topProducts = DB::table('items')
            ->join('transactions', 'items.transaction_id', '=', 'transactions.id')
            ->join('products', 'items.product_id', '=', 'products.id')
            ->select(
                'items.product_id',
                'products.name',
                DB::raw('SUM(items.quantity) as total_quantity') // Suma de cantidades
            )
            ->whereDate('transactions.created_at', $targetDate)
            ->groupBy('items.product_id', 'products.name', 'products.image')
            ->orderBy('total_quantity', 'desc') // Orden descendente (de mayor a menor)
            ->take(10)
            ->get();

        if ($topProducts->isEmpty()) {
            $topProducts = DB::table('items')
                ->join('transactions', 'items.transaction_id', '=', 'transactions.id')
                ->join('products', 'items.product_id', '=', 'products.id')
                ->select(
                    'items.product_id',
                    'products.name',
                    DB::raw('SUM(items.quantity) as total_quantity') // Suma de cantidades
                )
                ->whereBetween('transactions.created_at', [
                    now()->subDays(30),
                    now()
                ])
                ->groupBy('items.product_id', 'products.name', 'products.image')
                ->orderBy('total_quantity', 'desc') // Orden descendente (de mayor a menor)
                ->take(10)
                ->get();
        }

        return response()->json(['status' => $status, 'data' => $topProducts]);
    }
}
