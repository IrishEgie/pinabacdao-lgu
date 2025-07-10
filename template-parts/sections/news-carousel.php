<?php
/**
 * Featured Carousel Block for WordPress
 */

function featured_carousel_block() {
    // Static data that matches your example
    $featured_items = array(
        array(
            'id' => '1',
            'title' => 'Holiday Schedule Advisory',
            'excerpt' => 'Municipal offices will observe special holiday schedules during the Christmas and New Year period. Essential services remain available.',
            'date' => 'December 10, 2024',
            'category' => 'Announcement',
            'type' => 'announcement',
            'imageUrl' => 'https://images.unsplash.com/photo-1714791831455-33f641a7aa04?q=80&w=1631&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' // Replace with actual image URL
        ),
        // Add more items as needed
    );
    ?>

        <div class="relative w-full" x-data="{
            currentIndex: 0,
            items: <?php echo count($featured_items); ?>,
            next() {
                this.currentIndex = (this.currentIndex + 1) % this.items;
            },
            prev() {
                this.currentIndex = (this.currentIndex - 1 + this.items) % this.items;
            }
        }">
            <div class="relative overflow-hidden">
                <div class="flex transition-transform duration-300" 
                     :style="'transform: translateX(-' + (currentIndex * 100) + '%)'">
                    <?php foreach ($featured_items as $item): ?>
                    <div class="w-full flex-shrink-0">
                        <a href="<?php echo $item['type'] === 'announcement' ? '/news/' : '/' . $item['type'] . '/'; ?><?php echo $item['id']; ?>" class="block">
                            <div class="group cursor-pointer overflow-hidden border-0 shadow-xl hover:shadow-2xl transition-all duration-300 rounded-lg">
                                <div class="relative h-80 md:h-96">
                                    <img
                                        src="<?php echo $item['imageUrl']; ?>"
                                        alt="<?php echo esc_attr($item['title']); ?>"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    />
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                                    
                                    <div class="absolute top-6 left-6">
                                        <span class="<?php 
                                            echo $item['type'] === 'news' ? 'bg-blue-600 hover:bg-blue-700' :
                                            ($item['type'] === 'event' ? 'bg-green-600 hover:bg-green-700' :
                                            'bg-orange-600 hover:bg-orange-700');
                                        ?> text-white font-semibold px-4 py-2 rounded-md text-sm">
                                            <?php echo $item['type'] === 'announcement' ? 'Announcement' : 
                                                 ($item['type'] === 'event' ? 'Event' : 'News'); ?>
                                        </span>
                                    </div>
                                    
                                    <div class="absolute top-6 right-6">
                                        <span class="bg-white/90 text-gray-800 font-medium border border-gray-200 rounded-md px-3 py-1 text-sm">
                                            <?php echo $item['category']; ?>
                                        </span>
                                    </div>
                                    
                                    <div class="absolute bottom-6 left-6 right-6">
                                        <h3 class="text-2xl md:text-3xl font-bold text-white mb-3 line-clamp-2">
                                            <?php echo $item['title']; ?>
                                        </h3>
                                        <p class="text-white/90 text-base md:text-lg leading-relaxed line-clamp-2 mb-4">
                                            <?php echo $item['excerpt']; ?>
                                        </p>
                                        <div class="flex items-center text-white/80 text-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span><?php echo $item['date']; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-2 shadow-md">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-2 shadow-md">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>
    <?php
}