<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-dark-100">{{ __('Transactions') }}</h2>
    </x-slot>

    <div class="animate-fade-in">
        @if ($message = Session::get('success'))
            <div class="alert-success mb-6 flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ $message }}
            </div>
        @endif

        <div class="glass-card overflow-hidden">
            <table class="table-dark">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td class="font-medium text-dark-300">#{{ $transaction->id }}</td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-accent/20 flex items-center justify-center">
                                        <span class="text-accent text-sm font-semibold">{{ substr($transaction->user->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-dark-100">{{ $transaction->user->name }}</p>
                                        <p class="text-xs text-dark-400">{{ $transaction->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="font-semibold text-emerald-400">${{ number_format($transaction->total_amount, 2) }}</td>
                            <td>
                                @if($transaction->status === 'completed')
                                    <span class="badge-success">{{ ucfirst($transaction->status) }}</span>
                                @elseif($transaction->status === 'pending')
                                    <span class="badge-warning">{{ ucfirst($transaction->status) }}</span>
                                @elseif($transaction->status === 'cancelled')
                                    <span class="bg-red-500/20 text-red-400 px-3 py-1 rounded-full text-sm font-medium">{{ ucfirst($transaction->status) }}</span>
                                @else
                                    <span class="badge-info">{{ ucfirst($transaction->status) }}</span>
                                @endif
                            </td>
                            <td class="text-dark-400">{{ $transaction->created_at->format('d M Y H:i') }}</td>
                            <td class="text-right">
                                <a href="{{ route('transactions.show', $transaction->id) }}" class="p-2 text-dark-400 hover:text-accent transition-colors rounded-lg hover:bg-dark-700 inline-flex">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-dark-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <p class="text-dark-400">No transactions yet</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
