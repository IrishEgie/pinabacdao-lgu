<?php
/**
 * Template Name: Pinabacdao Single Post
 * Description: WordPress template matching SinglePost component
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
                
<main class="py-8 max-w-4xl mx-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex">
            <div class="w-full">
                <div class="space-y-8">
                    <!-- Header Section -->
                    <div class="text-center py-8 bg-gradient-to-br from-primary/5 to-secondary/5 rounded-lg border">
                        <?php 
                        echo display_service_icon('shield', 'w-16 h-16 mx-auto mb-4 text-primary');
                        ?>
                        <h1 class="text-3xl font-bold text-foreground mb-2">Privacy Policy</h1>
                        <p class="text-muted-foreground max-w-2xl mx-auto">
                            Your privacy is important to us. This policy explains how we collect, use, and protect your personal information 
                            in accordance with the Data Privacy Act of 2012 (Republic Act No. 10173) of the Philippines.
                        </p>
                        <div class="mt-4 text-sm text-muted-foreground">Last updated: <?php echo date('n/j/Y'); ?></div>
                    </div>

                    <!-- Principles Cards Grid -->
                    <div class="grid md:grid-cols-3 gap-6">
                        <?php
                        // Principle 1: Transparency
                        echo highlight_card(array(
                            'icon' => get_service_icon_svg('eye', 'text-primary-500'),
                            'icon_classes' => 'w-8 h-8 mx-auto mb-3 text-blue-600',
                            'title' => 'Transparency',
                            'content' => "We're clear about what data we collect and why",
                            'additional_classes' => 'text-center p-6 bg-card rounded-lg border'
                        ));
                        
                        // Principle 2: Security
                        echo highlight_card(array(
                            'icon' => get_service_icon_svg('lock', 'text-primary-500'),
                            'icon_classes' => 'w-8 h-8 mx-auto mb-3 text-green-600',
                            'title' => 'Security',
                            'content' => 'Your data is protected with industry-standard security',
                            'additional_classes' => 'text-center p-6 bg-card rounded-lg border'
                        ));
                        
                        // Principle 3: Your Rights
                        echo highlight_card(array(
                            'icon' => get_service_icon_svg('user-check', 'text-primary-500'),
                            'icon_classes' => 'w-8 h-8 mx-auto mb-3 text-purple-600',
                            'title' => 'Your Rights',
                            'content' => 'You have control over your personal information',
                            'additional_classes' => 'text-center p-6 bg-card rounded-lg border'
                        ));
                        ?>
                    </div>

                    <!-- Policy Sections -->
                    <div class="prose prose-gray max-w-none">
                        <div class="bg-card p-6 rounded-lg border space-y-6">
                            <!-- Content  -->
                        <?php the_content()?>

                        </div>
                        <!-- Footer Note -->
                        <div class="text-center p-6 bg-muted/50 rounded-lg border mt-4">
                            <?php 
                            echo display_service_icon('clock', 'w-6 h-6 mx-auto mb-2 text-muted-foreground');
                            ?>
                            <p class="text-sm text-muted-foreground">
                                This privacy policy complies with the Data Privacy Act of 2012 (Republic Act No. 10173) 
                                and its implementing rules and regulations.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
                
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</div>  