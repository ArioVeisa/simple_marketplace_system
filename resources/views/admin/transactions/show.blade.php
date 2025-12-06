<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('transactions.index') }}" class="text-dark-400 hover:text-dark-200 transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-dark-100">Transaction #{{ $transaction->id }}</h2>
        </div>
    </x-slot>

    <div class="max-w-4xl animate-fade-in space-y-6">
        <!-- Transaction Info -->
        <div class="glass-card p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <p class="text-dark-500 text-sm mb-1">Customer</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-accent/20 flex items-center justify-center">
                            <span class="text-accent font-semibold">{{ substr($transaction->user->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="font-medium text-dark-100">{{ $transaction->user->name }}</p>
                            <p class="text-sm text-dark-400">{{ $transaction->user->email }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="text-dark-500 text-sm mb-1">Status</p>
                    @if($transaction->status === 'completed')
                        <span class="badge-success">{{ ucfirst($transaction->status) }}</span>
                    @elseif($transaction->status === 'pending')
                        <span class="badge-warning">{{ ucfirst($transaction->status) }}</span>
                    @else
                        <span class="badge-info">{{ ucfirst($transaction->status) }}</span>
                    @endif
                </div>
                <div>
                    <p class="text-dark-500 text-sm mb-1">Date</p>
                    <p class="font-medium text-dark-200">{{ $transaction->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Update Status -->
        <div class="glass-card p-6">
            <h3 class="text-lg font-bold text-dark-100 mb-4">Update Status</h3>
            <form action="{{ route('transactions.updateStatus', $transaction->id) }}" method="POST" class="flex items-center gap-4">
                @csrf
                <select name="status" class="input-dark px-4 py-3 flex-1">
                    <option value="pending" {{ $transaction->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $transaction->status === 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ $transaction->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $transaction->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <x-primary-button>Update</x-primary-button>
            </form>
        </div>

        <!-- Order Items -->
        <div class="glass-card overflow-hidden">
            <div class="p-6 border-b border-dark-700/50">
                <h3 class="text-lg font-bold text-dark-100">Order Items</h3>
            </div>
            <table class="table-dark">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction->details as $detail)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    @if($detail->product && $detail->product->image)
                                        <img src="/images/{{ $detail->product->image }}" alt="" class="w-10 h-10 rounded-lg object-cover">
                                    @else
                                        <div class="w-10 h-10 rounded-lg bg-dark-700 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-dark-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg>
                                        </div>
                                    @endif
                                    <span class="font-medium text-dark-100">{{ $detail->product->name ?? 'Product Deleted' }}</span>
                                </div>
                            </td>
                            <td class="text-dark-300">${{ number_format($detail->price, 2) }}</td>
                            <td class="text-dark-300">{{ $detail->quantity }}</td>
                            <td class="text-right font-semibold text-emerald-400">${{ number_format($detail->price * $detail->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t border-dark-600">
                        <td colspan="3" class="text-right font-bold text-dark-200">Total</td>
                        <td class="text-right text-2xl font-bold text-emerald-400">${{ number_format($transaction->total_amount, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-app-layout>
