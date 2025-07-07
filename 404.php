<?php
/**
 * The template for displaying 404 pages (Not Found)
 */
get_header(); ?>

<div class="flex items-center justify-center px-4 sm:px-6 lg:px-8 py-24">
    <div class="max-w-2xl text-center">
        <div class="mb-8">
            <h1 class="text-9xl md:text-[12rem] font-bold text-primary-600 opacity-20 leading-none">404</h1>
        </div>
        <div class="space-y-6">
            <div class="space-y-4">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Page Not Found</h2>
                <p class="text-lg text-gray-600 max-w-lg mx-auto leading-relaxed">
                    Sorry, we couldn't find the page you're looking for. 
                    It might have been moved, deleted, or you entered the wrong URL.
                </p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium h-11 rounded-md px-8 bg-primary-600 hover:bg-primary-700 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 mr-2">
                        <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path>
                        <path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    </svg>
                    Go to Homepage
                </a>
                <a href="<?php echo esc_url(home_url('/search')); ?>" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium h-11 rounded-md px-8 border border-gray-300 bg-white hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 mr-2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </svg>
                    Search Site
                </a>
            </div>
            <div class="pt-4">
                <button onclick="history.back()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium h-10 px-4 py-2 text-primary-600 hover:text-primary-700 hover:bg-primary-50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
                        <path d="m12 19-7-7 7-7"></path>
                        <path d="M19 12H5"></path>
                    </svg>
                    Go Back
                </button>
            </div>
        </div>
        <div class="mt-16">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">Popular Pages</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <a href="<?php echo esc_url(home_url('/services')); ?>" class="p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 hover:scale-105 group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-primary-600 mx-auto mb-2 group-hover:scale-110 transition-transform">
                        <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                        <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                        <path d="M10 9H8"></path>
                        <path d="M16 13H8"></path>
                        <path d="M16 17H8"></path>
                    </svg>
                    <p class="font-medium text-gray-800">Services</p>
                    <p class="text-sm text-gray-600">Government services</p>
                </a>
                <a href="<?php echo esc_url(home_url('/government')); ?>" class="p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 hover:scale-105 group">
                    <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                        <span class="text-white font-bold text-sm">G</span>
                    </div>
                    <p class="font-medium text-gray-800">Government</p>
                    <p class="text-sm text-gray-600">Officials &amp; offices</p>
                </a>
                <a href="<?php echo esc_url(home_url('/news')); ?>" class="p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 hover:scale-105 group">
                    <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                        <span class="text-white font-bold text-sm">N</span>
                    </div>
                    <p class="font-medium text-gray-800">News &amp; Events</p>
                    <p class="text-sm text-gray-600">Latest updates</p>
                </a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>