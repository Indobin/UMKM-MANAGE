
<div class="p-6 bg-black">
    <img src="{{ asset('images/umkm-logo.png') }}" alt="Logo UMKM" class="w-20 mb-4">
    {{-- <h1 class="text-lg font-bold">Detail Transaksi</h1> --}}
    <p>Nama Pembeli: {{ $transaction->nama_pembeli }}</p>
    <p>Tanggal Transaksi: {{ \Carbon\Carbon::parse($transaction->tanggal_transaksi)->format('d M Y') }}</p>


    <table class="w-full mt-4 border border-collapse border-gray-200">
        <thead>
            <tr class="bg-black">
                <th class="px-4 py-2 border border-gray-200">Nama Produk</th>
                <th class="px-4 py-2 border border-gray-200">Jumlah</th>
                <th class="px-4 py-2 border border-gray-200">Harga Satuan</th>
                <th class="px-4 py-2 border border-gray-200">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction->details as $detail)
                <tr>
                    <td class="px-4 py-2 border border-gray-200">{{ $detail->product->nama }}</td>
                    <td class="px-4 py-2 border border-gray-200">{{ $detail->jumlah }}</td>
                    <td class="px-4 py-2 border border-gray-200">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border border-gray-200">Rp {{ number_format($detail->jumlah * $detail->harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="font-bold">
                <td colspan="3" class="px-4 py-2 text-right border border-gray-200">Total Keseluruhan</td>
                <td class="px-4 py-2 text-gray-900 border border-gray-200">
                    Rp {{ number_format($transaction->details->sum(fn ($detail) => $detail->jumlah * $detail->harga), 0, ',', '.') }}
                </td>
            </tr>
        </tfoot>

    </table>
</div>

