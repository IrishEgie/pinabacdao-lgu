<a href="<?php echo esc_url( get_permalink() ); ?>" class="block">
  <div class="rounded-lg border bg-card text-card-foreground shadow-sm group hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden cursor-pointer border-l-4 border-l-blue-500">
    
    <div class="relative overflow-hidden">
      <img 
        src="https://images.unsplash.com/photo-1488590528505-98d2b5aba04b?w=400&amp;h=250&amp;fit=crop" 
        alt="Road Infrastructure Project Update" 
        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
      >
      
      <div class="absolute top-4 left-4">
        <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent text-primary-foreground bg-blue-600 hover:bg-blue-700">
          News
        </div>
      </div>

      <div class="absolute top-4 right-4">
        <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 bg-white/90 text-gray-800">
          Infrastructure
        </div>
      </div>
    </div>

    <div class="flex flex-col space-y-1.5 p-6 pb-2">
      <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600 transition-colors duration-300 line-clamp-2">
        <?php the_title(); ?>
      </h3>
    </div>

    <div class="p-6 pt-0 space-y-4">
      <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
        <?php echo wp_trim_words( get_the_excerpt(), 30 ); ?>
      </p>

      <div class="flex items-center justify-between text-sm text-gray-500">
        <div class="flex items-center space-x-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M8 2v4"></path>
            <path d="M16 2v4"></path>
            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
            <path d="M3 10h18"></path>
          </svg>
          <span><?php echo get_the_date(); ?></span>
        </div>

        <div class="flex items-center space-x-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path>
            <circle cx="12" cy="12" r="3"></circle>
          </svg>
          <span><?php echo get_post_meta( get_the_ID(), 'post_views_count', true ) ?: '0'; ?> views</span>
        </div>
      </div>
    </div>
    
  </div>
</a>
