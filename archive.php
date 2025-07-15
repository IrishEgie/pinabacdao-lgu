<?php
/**
 * Template Name: Pinabacdao Single Post
 * Description: WordPress template matching SinglePost component
 */

get_header();
?>

<div class="min-h-screen bg-gray-50">
    <!-- Dynamic Page Banner -->
    <div><?php pageBanner([
    'type' => 'author',
    'title' => 'Posts by ' . get_the_author()
    ]); ?></div>

    <!-- Dynamic Breadcrumbs -->
    <?php the_breadcrumbs(); ?>

    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex gap-8">
                <!-- Main Content Area -->
                <div class="w-full">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <!-- Archive Header -->
                        <div class="bg-gradient-to-r from-primary-600 via-primary-500 to-primary-600 p-6">
                            <h1 class="text-3xl font-bold text-white">Our Archives</h1>
                            <p class="text-primary-100 mt-2">Browse through our collection of past posts and articles</p>
                        </div>
                        
                        <!-- Archive Filters -->
                        <div class="border-b border-gray-200 p-4 bg-gray-50">
                            <div class="flex flex-wrap items-center gap-4">
                                <div class="relative w-full md:w-auto">
                                    <select class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                        <option>All Categories</option>
                                        <option>News</option>
                                        <option>Events</option>
                                        <option>Announcements</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                       
                                    <?php get_service_icon_svg('arrow-down')?>
                                    </div>
                                </div>
                                <div class="relative w-full md:w-auto">
                                    <select class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                        <option>All Years</option>
                                        <option>2023</option>
                                        <option>2022</option>
                                        <option>2021</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <?php get_service_icon_svg('arrow-down')?>
                                    </div>
                                </div>
                                <button class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded transition duration-150 ease-in-out">
                                    Filter
                                </button>
                            </div>
                        </div>
                        
                        <!-- Archive List -->
                        <div class="divide-y divide-gray-200">
                            <!-- Archive Item 1 -->
                            <div class="p-6 hover:bg-gray-50 transition duration-150 ease-in-out">
                                <div class="flex flex-col md:flex-row md:items-center gap-4">
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-primary-100 text-primary-600 font-bold">
                                            15
                                        </span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-medium text-gray-900 hover:text-primary-600 transition duration-150 ease-in-out">
                                            <a href="#">Annual Town Fiesta Celebration 2023</a>
                                        </h3>
                                        <p class="text-sm text-gray-500 mt-1">Posted in <span class="text-primary-600">Events</span> on June 15, 2023</p>
                                        <p class="mt-2 text-gray-600">Join us for the colorful celebration of our town fiesta featuring cultural shows, food fairs, and more.</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <a href="#" class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-primary-700 bg-primary-100 hover:bg-primary-200 transition duration-150 ease-in-out">
                                            Read More
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Archive Item 2 -->
                            <div class="p-6 hover:bg-gray-50 transition duration-150 ease-in-out">
                                <div class="flex flex-col md:flex-row md:items-center gap-4">
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-green-100 text-green-600 font-bold">
                                            28
                                        </span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-medium text-gray-900 hover:text-primary-600 transition duration-150 ease-in-out">
                                            <a href="#">New Municipal Building Groundbreaking</a>
                                        </h3>
                                        <p class="text-sm text-gray-500 mt-1">Posted in <span class="text-green-600">News</span> on May 28, 2023</p>
                                        <p class="mt-2 text-gray-600">The construction of our new municipal building has officially begun with a ceremonial groundbreaking.</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <a href="#" class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 transition duration-150 ease-in-out">
                                            Read More
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Archive Item 3 -->
                            <div class="p-6 hover:bg-gray-50 transition duration-150 ease-in-out">
                                <div class="flex flex-col md:flex-row md:items-center gap-4">
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-purple-100 text-purple-600 font-bold">
                                            10
                                        </span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-medium text-gray-900 hover:text-primary-600 transition duration-150 ease-in-out">
                                            <a href="#">Scholarship Program Announcement</a>
                                        </h3>
                                        <p class="text-sm text-gray-500 mt-1">Posted in <span class="text-purple-600">Announcements</span> on May 10, 2023</p>
                                        <p class="mt-2 text-gray-600">Applications are now open for the Mayor's Scholarship Program for deserving students.</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <a href="#" class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-purple-700 bg-purple-100 hover:bg-purple-200 transition duration-150 ease-in-out">
                                            Read More
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Archive Item 4 -->
                            <div class="p-6 hover:bg-gray-50 transition duration-150 ease-in-out">
                                <div class="flex flex-col md:flex-row md:items-center gap-4">
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 text-yellow-600 font-bold">
                                            22
                                        </span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-medium text-gray-900 hover:text-primary-600 transition duration-150 ease-in-out">
                                            <a href="#">Farmers' Market Every Saturday</a>
                                        </h3>
                                        <p class="text-sm text-gray-500 mt-1">Posted in <span class="text-yellow-600">Events</span> on April 22, 2023</p>
                                        <p class="mt-2 text-gray-600">Support local farmers by visiting our weekly farmers' market featuring fresh produce and handmade goods.</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <a href="#" class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-yellow-700 bg-yellow-100 hover:bg-yellow-200 transition duration-150 ease-in-out">
                                            Read More
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Archive Item 5 -->
                            <div class="p-6 hover:bg-gray-50 transition duration-150 ease-in-out">
                                <div class="flex flex-col md:flex-row md:items-center gap-4">
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-red-100 text-red-600 font-bold">
                                            05
                                        </span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-medium text-gray-900 hover:text-primary-600 transition duration-150 ease-in-out">
                                            <a href="#">Road Construction Advisory</a>
                                        </h3>
                                        <p class="text-sm text-gray-500 mt-1">Posted in <span class="text-red-600">Announcements</span> on April 5, 2023</p>
                                        <p class="mt-2 text-gray-600">Important traffic advisories for the upcoming road construction on Main Street.</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <a href="#" class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 transition duration-150 ease-in-out">
                                            Read More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="bg-gray-50 px-6 py-4 flex items-center justify-between border-t border-gray-200">
                            <div class="flex-1 flex justify-between sm:hidden">
                                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Previous
                                </a>
                                <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Next
                                </a>
                            </div>
                            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700">
                                        Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">24</span> results
                                    </p>
                                </div>
                                <div>
                                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                            <span class="sr-only">Previous</span>
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <a href="#" aria-current="page" class="z-10 bg-primary-50 border-primary-500 text-primary-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                            1
                                        </a>
                                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                            2
                                        </a>
                                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                            3
                                        </a>
                                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                            ...
                                        </span>
                                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                            8
                                        </a>
                                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                            <span class="sr-only">Next</span>
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</div>