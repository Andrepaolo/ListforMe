<div class="fixed bottom-6 left-6 z-50">
    <a href="{{ route('cart') }}" 
       class="relative flex items-center justify-center w-16 h-16 bg-[#8f9779] text-white rounded-full shadow-lg hover:bg-[#a4b07a] transition-all duration-300 transform hover:scale-110 focus:outline-none focus:ring-4 focus:ring-[#8f9779] focus:ring-opacity-50">
        <i class="fas fa-shopping-cart text-2xl"></i>
        @if($itemCount > 0)
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                {{ $itemCount }}
            </span>
        @endif
    </a>
</div>