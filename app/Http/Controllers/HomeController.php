<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function TampilHome()
    {
        // Check if the user is an admin
        $isAdmin = Auth::user()->role === 'admin';

        // Query to group products by date
        $produkPerHariQuery = Produk::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc');

        // Filter by user_id if the user is not an admin
        if (!$isAdmin) {
            $produkPerHariQuery->where('user_id', Auth::id());
        }

        // Execute the query to get products grouped by date
        $produkPerHari = $produkPerHariQuery->get();

        // Prepare data for the chart
        $dates = $produkPerHari->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('Y-m-d');
        });
        $totals = $produkPerHari->pluck('total');

        // Create a bar chart
        $chart = LarapexChart::barChart()
            ->setTitle('Produk Ditambahkan Per Hari')
            ->setSubtitle('Data Penambahan Produk Harian')
            ->addData('Jumlah Produk', $totals->toArray())
            ->setXAxis($dates->toArray());

        // Additional data for the view
        $totalProductsQuery = Produk::query();
        if (!$isAdmin) {
            $totalProductsQuery->where('user_id', Auth::id());
        }

        $data = [
            'dates' => $dates,                  // Dates for the chart x-axis
            'totals' => $totals,                // Totals for the chart y-axis
            'totalProducts' => $totalProductsQuery->count(), // Total product count based on role
            'salesToday' => 130,                // Example additional data
            'totalRevenue' => 'Rp 75,000,000',  // Example additional data
            'registeredUsers' => 350,           // Example additional data
            'chart' => $chart                   // Pass chart to view
        ];

        // Return data to the home view
        return view('home', $data);
    }

    public function ViewProduk()
    {
        // Retrieve all products or filter by user_id if needed
        $produk = Auth::user()->role === 'admin' ? Produk::all() : Produk::where('user_id', Auth::id())->get();

        // Send product data to the view
        return view('produk', compact('produk'));
    }
}
