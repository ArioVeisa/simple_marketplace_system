<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-dark-100">{{ $product->name }}</h2>
    </x-slot>

    <div class="animate-fade-in">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Product Image -->
            <div class="glass-card overflow-hidden">
                <div class="aspect-square bg-dark-700">
                    @if($product->image)
                        <img src="/images/{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-24 h-24 text-dark-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="space-y-6">
                <div class="glass-card p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="badge-info">{{ $product->category->name }}</span>
                        @if($product->stock > 0)
                            <span class="badge-success">In Stock</span>
                        @else
                            <span class="bg-red-500/20 text-red-400 px-3 py-1 rounded-full text-sm font-medium">Out of Stock</span>
                        @endif
                    </div>

                    <h1 class="text-3xl font-bold text-dark-100 mb-4">{{ $product->name }}</h1>
                    
                    <p class="text-dark-400 leading-relaxed mb-6">{{ $product->description }}</p>

                    <div class="flex items-baseline gap-2 mb-6">
                        <span class="text-4xl font-bold text-emerald-400">${{ number_format($product->price, 2) }}</span>
                        <span class="text-dark-500">USD</span>
                    </div>

                    @auth
                        @if($product->stock > 0)
                            <form action="{{ route('checkout.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                <div class="flex items-center gap-4">
                                    <label class="text-dark-300">Quantity:</label>
                                    <div class="flex items-center gap-2">
                                        <button type="button" onclick="decrementQty()" class="w-10 h-10 rounded-lg bg-dark-700 text-dark-200 hover:bg-dark-600 transition-colors flex items-center justify-center">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                            </svg>
                                        </button>
                                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-20 text-center input-dark py-2">
                                        <button type="button" onclick="incrementQty()" class="w-10 h-10 rounded-lg bg-dark-700 text-dark-200 hover:bg-dark-600 transition-colors flex items-center justify-center">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                    </div>
                                    <span class="text-dark-500 text-sm">{{ $product->stock }} available</span>
                                </div>

                                <button type="submit" class="btn-primary w-full flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Purchase Now
                                </button>
                            </form>
                        @else
                            <button disabled class="w-full py-3 px-6 rounded-xl bg-dark-700 text-dark-500 font-medium cursor-not-allowed">
                                Out of Stock
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn-primary w-full text-center block">
                            Login to Purchase
                        </a>
                    @endauth
                </div>

                <!-- Back to Marketplace -->
                <a href="{{ route('marketplace.index') }}" class="inline-flex items-center gap-2 text-dark-400 hover:text-accent transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Marketplace
                </a>
            </div>
        </div>
    </div>

    <script>
        function incrementQty() {
            const input = document.getElementById('quantity');
            const max = parseInt(input.max);
            const current = parseInt(input.value);
            if (current < max) {
                input.value = current + 1;
            }
        }
        function decrementQty() {
            const input = document.getElementById('quantity');
            const current = parseInt(input.value);
            if (current > 1) {
                input.value = current - 1;
            }
        }
    </script>
</x-app-layout>
