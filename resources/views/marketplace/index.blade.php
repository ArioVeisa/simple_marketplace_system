<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-dark-100">{{ __('Marketplace') }}</h2>
    </x-slot>

    <div class="animate-fade-in">
        <!-- Hero Section -->
        <div class="glass-card p-8 mb-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-accent/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            <div class="relative z-10">
                <h1 class="text-3xl font-bold text-dark-100 mb-2">Discover Amazing Products</h1>
                <p class="text-dark-400 mb-6">Browse our curated collection of premium products at great prices</p>
                
                <form action="{{ route('marketplace.index') }}" method="GET" class="flex gap-4 max-w-2xl">
                    <div class="flex-1 relative">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-dark-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}" class="input-dark w-full pl-12 py-3">
                    </div>
                    <button type="submit" class="btn-primary">Search</button>
                </form>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Categories Sidebar -->
            <div class="lg:w-64 shrink-0">
                <div class="glass-card p-4 sticky top-4">
                    <h3 class="text-lg font-bold text-dark-100 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        Categories
                    </h3>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('marketplace.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg {{ !request('category') ? 'bg-accent/10 text-accent' : 'text-dark-400 hover:text-dark-200 hover:bg-dark-700/50' }} transition-colors">
                                <span>All Products</span>
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('marketplace.index', ['category' => $category->slug]) }}" class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request('category') === $category->slug ? 'bg-accent/10 text-accent' : 'text-dark-400 hover:text-dark-200 hover:bg-dark-700/50' }} transition-colors">
                                    <span>{{ $category->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="flex-1">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @forelse($products as $product)
                        <div class="glass-card-hover group overflow-hidden">
                            <div class="aspect-square bg-dark-700 relative overflow-hidden">
                                @if($product->image)
                                    <img src="/images/{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-16 h-16 text-dark-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-3 left-3">
                                    <span class="badge-info">{{ $product->category->name }}</span>
                                </div>
                            </div>
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-dark-100 mb-2 line-clamp-1">{{ $product->name }}</h3>
                                <p class="text-dark-400 text-sm mb-4 line-clamp-2">{{ Str::limit($product->description, 80) }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-bold text-emerald-400">${{ number_format($product->price, 2) }}</span>
                                    <a href="{{ route('marketplace.show', $product->slug) }}" class="px-4 py-2 rounded-xl bg-accent/20 text-accent font-medium hover:bg-accent/30 transition-colors">
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div class="glass-card p-12 text-center">
                                <svg class="w-16 h-16 text-dark-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                <p class="text-dark-400 text-lg">No products found</p>
                                <p class="text-dark-500 mt-2">Try adjusting your search or filters</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
