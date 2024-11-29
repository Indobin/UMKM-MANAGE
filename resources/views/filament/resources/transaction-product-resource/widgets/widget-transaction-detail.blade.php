<div class="p-6">
    <div class="p-4 bg-white rounded-lg shadow">
        <h2 class="mb-4 text-lg font-bold">Detail Transaksi</h2>

        <!-- Informasi Transaksi -->
        <div class="mb-6">
            <p><strong>Nama Pembeli:</strong> {{ $transaction->nama_pembeli }}</p>
            <p><strong>Tanggal Transaksi:</strong> {{ \Carbon\Carbon::parse($transaction->tanggal_transaksi)->format('d-m-Y') }}</p>
        </div>

        <!-- Tabel Produk -->
        <table class="w-full border border-gray-200 table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">Nama Produk</th>
                    <th class="px-4 py-2 border">Jumlah</th>
                    <th class="px-4 py-2 border">Harga</th>
                    <th class="px-4 py-2 border">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalAmount = 0;
                @endphp
                @foreach ($transaction->details as $detail)
                    @php
                        $totalPrice = $detail->jumlah * $detail->harga;
                        $totalAmount += $totalPrice;
                    @endphp
                    <tr>
                        <td class="px-4 py-2 border">{{ $detail->product->nama }}</td>
                        <td class="px-4 py-2 border">{{ $detail->jumlah }}</td>
                        <td class="px-4 py-2 border">{{ number_format($detail->harga, 2) }}</td>
                        <td class="px-4 py-2 border">{{ number_format($totalPrice, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Keseluruhan -->
        <div class="mt-4 text-right">
            <strong>Total Keseluruhan:</strong>
            <span>{{ number_format($totalAmount, 2) }}</span>
        </div>
    </div>
</div>
