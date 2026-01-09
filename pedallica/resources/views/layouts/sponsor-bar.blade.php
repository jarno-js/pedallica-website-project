<!-- Sponsor Bar -->
@if(isset($globalSponsors) && $globalSponsors->count() > 0)
<div class="bg-gradient-to-r from-orange-50 via-white to-orange-50 border-b border-gray-200 py-4 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-center">
            <!-- Label -->
            <div class="flex-shrink-0 mr-6 hidden md:block">
                <span class="text-sm font-semibold text-gray-700 uppercase tracking-wider">
                    Met dank aan onze sponsors
                </span>
            </div>

            <!-- Sponsor logos -->
            <div class="flex items-center space-x-8 flex-wrap justify-center">
                @foreach($globalSponsors as $sponsor)
                    <a href="{{ $sponsor->website }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="flex-shrink-0 transition-all duration-300 hover:scale-110"
                       title="{{ $sponsor->name }}">
                        @if($sponsor->logo)
                            <img src="{{ asset($sponsor->logo) }}"
                                 alt="{{ $sponsor->name }}"
                                 class="h-10 w-auto object-contain filter grayscale opacity-70 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                        @else
                            <span class="text-sm text-gray-700 font-medium px-3 py-1 bg-white rounded-md shadow-sm hover:shadow-md transition-shadow">
                                {{ $sponsor->name }}
                            </span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
