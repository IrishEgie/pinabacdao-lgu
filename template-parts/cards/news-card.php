<?php
/**
 * Static Event Card Template
 *
 * @package YourThemeName
 */
?>

<a href="/events/municipal-anniversary-celebration" class="block">
    <div class="rounded-lg border bg-card text-card-foreground shadow-sm group hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden cursor-pointer border-l-4 border-l-green-500">
        <div class="relative overflow-hidden h-48">
            <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=400&h=250&fit=crop" alt="Municipal Anniversary Celebration" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            
            <div class="absolute top-4 left-4">
                <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent text-primary-foreground bg-green-600 hover:bg-green-700">
                    Event
                </span>
            </div>
            
            <div class="absolute top-4 right-4">
                <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 bg-white/90 text-gray-800">
                    Celebration
                </span>
            </div>
        </div>
        
        <div class="flex flex-col space-y-1.5 p-6 pb-2">
            <h3 class="tracking-tight text-lg font-semibold text-gray-800 group-hover:text-green-600 transition-colors duration-300 line-clamp-2">
                Municipal Anniversary Celebration
            </h3>
        </div>
        
        <div class="p-6 pt-0 space-y-4">
            <p class="text-gray-600 text-sm leading-relaxed line-clamp-2">
                Join us for a grand celebration of our municipality's founding with various activities, cultural shows, and community programs.
            </p>
            
            <div class="space-y-2 text-sm text-gray-500">
                <div class="flex items-center space-x-2">
                    <?php echo get_service_icon_svg('calendar', 'w-4 h-4'); ?>
                    <span>January 15, 2025</span>
                </div>
                
                <div class="flex items-center space-x-2">
                    <?php echo get_service_icon_svg('clock', 'w-4 h-4'); ?>
                    <span>8:00 AM - 6:00 PM</span>
                </div>
                
                <div class="flex items-center space-x-2">
                    <?php echo get_service_icon_svg('location', 'w-4 h-4'); ?>
                    <span>Municipal Plaza</span>
                </div>
                
                <div class="flex items-center space-x-2">
                    <?php echo get_service_icon_svg('users', 'w-4 h-4'); ?>
                    <span>500 expected attendees</span>
                </div>
            </div>
        </div>
    </div>
</a>