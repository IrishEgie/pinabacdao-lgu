<footer class="border-t border-gray-200 bg-secondary-bg text-black">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <!-- Main Footer Content -->
    <div class="flex flex-col items-center py-8 gap-6 sm:flex-row sm:justify-between sm:gap-4">
      
      <!-- Logo - Fixed 150px width that scales down -->
      <div class="w-[150px] max-w-full flex-shrink-0">
        <?php
        $footer_logo = get_theme_mod('footer_logo_primary');
        if ($footer_logo) {
          echo '<img src="' . esc_url($footer_logo) . '" 
               alt="' . esc_attr(get_theme_mod('footer_municipality_name', 'Republic Seal')) . '"
               class="w-full h-auto object-contain">';
        } else {
          echo '<div class="w-full aspect-square bg-gray-200 flex items-center justify-center rounded-sm">
                  <span class="text-xs text-gray-500">Seal</span>
                </div>';
        }
        ?>
      </div>
      
      <!-- Links - Stacked on mobile, row on desktop -->
      <div class="flex flex-col items-center gap-4 sm:flex-row sm:gap-8">
        <a href="#" class="text-sm font-bold text-primary-text hover:text-primary transition-colors">Footer 1</a>
        <a href="#" class="text-sm font-bold text-primary-text hover:text-primary transition-colors">Footer 2</a>
        <a href="#" class="text-sm font-bold text-primary-text hover:text-primary transition-colors">Footer 3</a>
        <a href="#" class="text-sm font-bold text-primary-text hover:text-primary transition-colors">Footer 4</a>
      </div>
      
    </div>
    
    <!-- Optional Copyright - Always centered -->
    <div class="py-4 border-t border-gray-200 text-center text-xs text-gray-500">
      © <?php echo date('Y'); ?> <?php echo get_theme_mod('footer_municipality_name', 'Municipality'); ?>. All rights reserved.
    </div>
  </div>
</footer>