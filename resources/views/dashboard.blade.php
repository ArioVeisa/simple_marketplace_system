<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-dark-100">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="space-y-8 animate-fade-in">
        <!-- Welcome Section -->
        <div class="glass-card p-8">
            <h3 class="text-2xl font-bold text-dark-100 mb-2">
                Welcome back, <span class="text-gradient">{{ Auth::user()->name }}</span>! 👋
            </h3>
            <p class="text-dark-400">
                @if(Auth::user()->hasRole('admin'))
                    Here's an overview of your marketplace. Manage your products, categories, and orders below.
                @else
                    Explore our marketplace and find amazing products at great prices.
                @endif
            </p>
        </div>

        @if(Auth::user()->hasRole('admin'))
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="{{ route('categories.index') }}" class="stats-card group hover:border-cyan-500/30 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-cyan-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-dark-500 group-hover:text-accent transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <h4 class="text-dark-400 text-sm font-medium">Categories</h4>
                    <p class="text-2xl font-bold text-dark-100">Manage</p>
                </a>

                <a href="{{ route('products.index') }}" class="stats-card group hover:border-emerald-500/30 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-emerald-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-dark-500 group-hover:text-accent transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <h4 class="text-dark-400 text-sm font-medium">Products</h4>
                    <p class="text-2xl font-bold text-dark-100">Manage</p>
                </a>

                <a href="{{ route('transactions.index') }}" class="stats-card group hover:border-amber-500/30 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-amber-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-dark-500 group-hover:text-accent transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <h4 class="text-dark-400 text-sm font-medium">Transactions</h4>
                    <p class="text-2xl font-bold text-dark-100">View</p>
                </a>

                <a href="{{ route('reports.index') }}" class="stats-card group hover:border-rose-500/30 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-rose-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-dark-500 group-hover:text-accent transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <h4 class="text-dark-400 text-sm font-medium">Reports</h4>
                    <p class="text-2xl font-bold text-dark-100">Export</p>
                </a>
            </div>

            <!-- User & Role Management -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('users.index') }}" class="stats-card group hover:border-purple-500/30 transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-purple-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-dark-100 font-semibold">Users Management</h4>
                            <p class="text-dark-400 text-sm">Manage user accounts and permissions</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('roles.index') }}" class="stats-card group hover:border-indigo-500/30 transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-indigo-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-dark-100 font-semibold">Roles Management</h4>
                            <p class="text-dark-400 text-sm">Define and manage user roles</p>
                        </div>
                    </div>
                </a>
            </div>
        @else
            <!-- Customer View -->
            <div class="glass-card p-6">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-dark-100">Start Shopping</h3>
                        <p class="text-dark-400">Explore our curated collection of products</p>
                    </div>
                    <a href="{{ route('marketplace.index') }}" class="btn-primary flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Go to Marketplace
                    </a>
                </div>
            </div>
            
            <!-- Recent Transactions -->
            <div class="glass-card overflow-hidden">
                <div class="p-6 border-b border-dark-700/50">
                    <h4 class="text-lg font-bold text-dark-100">Your Recent Transactions</h4>
                </div>
                <div class="overflow-x-auto">
                    <table class="table-dark">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(Auth::user()->transactions()->latest()->take(5)->get() as $transaction)
                                <tr>
                                    <td class="font-medium">#{{ $transaction->id }}</td>
                                    <td>${{ number_format($transaction->total_amount, 2) }}</td>
                                    <td>
                                        @if($transaction->status === 'completed')
                                            <span class="badge-success">{{ ucfirst($transaction->status) }}</span>
                                        @elseif($transaction->status === 'pending')
                                            <span class="badge-warning">{{ ucfirst($transaction->status) }}</span>
                                        @else
                                            <span class="badge-info">{{ ucfirst($transaction->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-dark-400">{{ $transaction->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-dark-400 py-8">
                                        No transactions yet. Start shopping!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
