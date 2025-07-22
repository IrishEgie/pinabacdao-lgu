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

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex">
            <div class="w-full">
                <div class="space-y-8">
                    <!-- Header Section -->
                    <div class="text-center py-8 bg-gradient-to-br from-primary/5 to-secondary/5 rounded-lg border">
                        <?php 
                        echo display_service_icon('shield', 'w-16 h-16 mx-auto mb-4 text-primary');
                        ?>
                        <h1 class="text-3xl font-bold text-foreground mb-2"><?php the_title()?></h1>
                        <p class="text-gray-600 max-w-2xl mx-auto">
                            Your privacy is important to us. This policy explains how we collect, use, and protect your personal information 
                            in accordance with the Data Privacy Act of 2012 (Republic Act No. 10173) of the Philippines.
                        </p>
                        <div class="mt-4 text-sm text-gray-600">Last updated: <?php echo date('n/j/Y'); ?></div>
                    </div>

                    <!-- Principles Cards Grid -->
                    <div class="grid md:grid-cols-3 gap-6">
                        <?php
                        // Principle 1: Service Agreement
                        echo highlight_card(array(
                            'icon' => get_service_icon_svg('file', 'text-primary-500'),
                            'icon_classes' => 'w-8 h-8 mx-auto mb-3 text-blue-600',
                            'title' => 'Service Agreement',
                            'content' => "By using our services, you agree to these terms",
                            'additional_classes' => 'text-center p-6 bg-card rounded-lg border'
                        ));
                        
                        // Principle 2: User Responsibilities
                        echo highlight_card(array(
                            'icon' => get_service_icon_svg('user', 'text-primary-500'),
                            'icon_classes' => 'w-8 h-8 mx-auto mb-3 text-green-600',
                            'title' => 'User Responsibilities',
                            'content' => 'Guidelines for appropriate use of our platform',
                            'additional_classes' => 'text-center p-6 bg-card rounded-lg border'
                        ));
                        
                        // Principle 3: Legal Compliance
                        echo highlight_card(array(
                            'icon' => get_service_icon_svg('gavel', 'text-primary-500'),
                            'icon_classes' => 'w-8 h-8 mx-auto mb-3 text-purple-600',
                            'title' => 'Legal Compliance',
                            'content' => 'Governed by Philippine laws and regulations',
                            'additional_classes' => 'text-center p-6 bg-card rounded-lg border'
                        ));
                        ?>
                    </div>

                    <!-- Policy Sections -->
                    <div class="prose prose-gray max-w-none">
                        <div class="content-area  bg-white p-6 rounded-lg border space-y-6">
                            <!-- Content  -->
                        <?php the_content()?>

                        </div>
                        <!-- Footer Note -->
                        <div class="text-center p-6 bg-gray/50 rounded-lg border mt-6">
                            <?php 
                            echo get_service_icon_svg('check-circle', 'w-6 h-6 mx-auto mb-2 text-gray-600');
                            ?>
                            <p class="text-sm text-gray-600">
                                By using this website and our services, you acknowledge that you have read and agree to these Terms of Use and understand your rights and obligations under Philippine law.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

    <?php get_footer(); ?>
</div>  