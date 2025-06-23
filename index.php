<?php
/**
 * Template Name: React-Style Single Post
 * Description: WordPress template matching SinglePost React component
 */

get_header();
?>

<div class="min-h-screen bg-gray-50">
    <!-- Dynamic Page Banner -->
    <div><?php pageBanner(); ?></div>

    <!-- Dynamic Breadcrumbs -->
    <?php the_breadcrumbs(); ?>

    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex gap-8">
                <!-- Main Content Area -->
                <div class="flex-1">
                    <div class="max-w-4xl mx-auto">
                        <!-- Back Button -->
                        <a href="javascript:history.go(-1)"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 rounded-lg mb-6 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back
                        </a>

                        <!-- Article Header -->
                        <div class="mb-8">
                            <div class="flex items-center gap-4 mb-4">
                                <!-- Category Badge -->
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-600 text-white">
                                    Static Category
                                </span>

                                <div class="flex items-center text-gray-500 text-sm gap-4">
                                    <!-- Date -->
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>June 15, 2023</span>
                                    </div>

                                    <!-- Views -->
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span>1,234 views</span>
                                    </div>

                                    <!-- Author -->
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span>Static Author</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-between items-start mb-6">
                                <div class="flex-1">
                                    <p class="text-lg text-gray-600 leading-relaxed">
                                        This is a static subtitle that would normally come from post meta data.
                                    </p>
                                </div>
                                <button
                                    class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-sm bg-white hover:bg-gray-50 ml-4">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                    Share
                                </button>
                            </div>

                            <!-- Custom Metadata -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                        <div class="font-medium text-gray-800">Duration</div>
                                        <div class="text-gray-600">30 minutes</div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <div>
                                        <div class="font-medium text-gray-800">Difficulty</div>
                                        <div class="text-gray-600">Intermediate</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Image with Gradient Fallback (Dynamic Version) -->
                        <div class="mb-8">
                            <div class="w-full h-96 rounded-lg shadow-lg overflow-hidden relative">
                                <?php if (has_post_thumbnail()): ?>
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>"
                                        alt="<?php echo esc_attr(get_the_title()); ?>" class="w-full h-full object-cover"
                                        onerror="this.parentElement.classList.add('bg-gradient-to-r', 'from-primary-600', 'to-primary-800')" />
                                <?php else: ?>
                                    <div
                                        class="w-full h-full bg-gradient-to-r from-primary to-primary-800 flex items-center justify-center">
                                        <span
                                            class="text-white text-xl font-medium"><?php echo esc_html(get_the_title()); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="prose prose-lg max-w-none mb-8">
                            <h2>Static Post Content Heading</h2>
                            <p>This is static content that would normally be pulled from the WordPress editor. The
                                structure matches your React component but with hardcoded content for now.</p>
                            <p>You can replace this with dynamic content using
                                <code>&lt;?php the_content(); ?&gt;</code> when ready.
                            </p>
                            <ul>
                                <li>Static list item 1</li>
                                <li>Static list item 2</li>
                                <li>Static list item 3</li>
                            </ul>
                        </div>

                        <!-- Tags -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-3">Tags</h3>
                            <div class="flex flex-wrap gap-2">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Static Tag 1
                                </span>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Static Tag 2
                                </span>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Static Tag 3
                                </span>
                            </div>
                        </div>

                        <!-- Article Footer -->
                        <div class="pt-6 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <div class="text-sm text-gray-500">
                                    Last updated: June 15, 2023
                                </div>
                                <div class="flex space-x-2">
                                    <button
                                        class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-sm bg-white hover:bg-gray-50">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                        </svg>
                                        Share Article
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Static Sidebars Container -->
                <div class="w-80 hidden lg:block space-y-6">
                    <!-- First Sidebar -->
                    <aside class="bg-white p-6 rounded-lg shadow-sm sticky top-8">
                        <h3 class="font-bold text-lg text-gray-800 mb-4 border-b pb-2">Related Posts</h3>
                        <div class="space-y-4">
                            <div class="border-b pb-4">
                                <h4 class="font-medium text-gray-700 mb-1"><a href="#"
                                        class="hover:text-primary-600">Static Related Post 1</a></h4>
                                <p class="text-sm text-gray-500">June 10, 2023</p>
                            </div>
                            <div class="border-b pb-4">
                                <h4 class="font-medium text-gray-700 mb-1"><a href="#"
                                        class="hover:text-primary-600">Static Related Post 2</a></h4>
                                <p class="text-sm text-gray-500">June 5, 2023</p>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-700 mb-1"><a href="#"
                                        class="hover:text-primary-600">Static Related Post 3</a></h4>
                                <p class="text-sm text-gray-500">May 28, 2023</p>
                            </div>
                        </div>
                    </aside>

                    <!-- Second Sidebar -->
                    <aside class="bg-white p-6 rounded-lg shadow-sm sticky top-[calc(8rem+var(--sidebar-height))]">
                        <h3 class="font-bold text-lg text-gray-800 mb-4 border-b pb-2">Categories</h3>
                        <div class="space-y-2">
                            <a href="#"
                                class="block py-2 px-3 rounded hover:bg-gray-50 text-gray-700 hover:text-primary-600">Technology</a>
                            <a href="#"
                                class="block py-2 px-3 rounded hover:bg-gray-50 text-gray-700 hover:text-primary-600">Business</a>
                            <a href="#"
                                class="block py-2 px-3 rounded hover:bg-gray-50 text-gray-700 hover:text-primary-600">Design</a>
                            <a href="#"
                                class="block py-2 px-3 rounded hover:bg-gray-50 text-gray-700 hover:text-primary-600">Marketing</a>
                        </div>

                        <h3 class="font-bold text-lg text-gray-800 mt-6 mb-4 border-b pb-2">Newsletter</h3>
                        <div class="space-y-3">
                            <p class="text-sm text-gray-600">Subscribe to our newsletter for updates.</p>
                            <input type="email" placeholder="Your email"
                                class="w-full px-3 py-2 border rounded-md text-sm">
                            <button
                                class="w-full bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-md text-sm transition-colors">
                                Subscribe
                            </button>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</div>  