<?php
/**
 * Template Name: Pinabacdao Front Page
 * Description: The front page template for the Pinabacdao LGU theme.
 * This template includes a hero section, quick actions, services, news, government officials, and 
 * other essential components.
 */
get_header();
require_once get_template_directory() . '/template-parts/cards/news-card.php';
?>
<?php get_template_part('template-parts/header'); ?>

<?php get_template_part('template-parts/heroes/hero-section'); ?>

<main class="bg-gray-50">
  <div class="grid gap-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="min-h-screen bg-gray-50">
      <!-- Quick Actions -->
      <div class="py-12">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-800 mb-4">Quick Actions</h2>
          <p class="text-lg text-gray-600">Comprehensive government services for our community</p>
        </div>
        <?php
        display_quick_access_section([
          'items' => [
            [
              'icon' => 'clock',
              'title' => 'Recent Documents',
              'description' => 'Added in last 30 days',
              'color' => 'primary-600',
              'link' => get_recent_documents_link()
            ],
            [
              'icon' => 'gavel',
              'title' => 'Ordinances',
              'description' => 'Local laws and regulations',
              'color' => 'yellow-600',
              'link' => add_query_arg('document_type', 'ordinance', get_post_type_archive_link('document'))
            ],
            [
              'icon' => 'file-text',
              'title' => 'Resolutions',
              'description' => 'Official decisions',
              'color' => 'orange-600',
              'link' => add_query_arg('document_type', 'resolution', get_post_type_archive_link('document'))
            ],
            [
              'icon' => 'star',
              'title' => 'Executive Orders',
              'description' => 'Executive directives',
              'color' => 'blue-600',
              'link' => add_query_arg('document_type', 'executive-order', get_post_type_archive_link('document'))
            ],
          ],
          'mt_class' => 'mt-12'
        ]);
        ?>
      </div>

      <!-- Services Section -->
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Services</h2>
        <p class="text-lg text-gray-600">Comprehensive government services for our community</p>
      </div>
      <?php
      // Set limit for homepage display
      $services_limit = 6; // Show only 6 services on homepage
      include get_template_directory() . '/template-parts/sections/services-section.php';
      ?>

      <!-- View All -->
      <div class="text-center my-12">
        <a href="<?php echo esc_url(home_url('/services')); ?>"
          class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 hover:bg-primary-500 text-white font-medium rounded-md transition-colors duration-300">
          View All Services
          <?php echo get_service_icon_svg('arrow-right', 'ml-2 text-white w-5 h-5'); ?>
        </a>
      </div>

      <!-- News & Announcements -->
      <section id="news">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex items-center justify-between mb-12">
            <div>
              <h2 class="text-3xl font-bold text-gray-800 mb-4">Latest News & Updates</h2>
              <p class="text-lg text-gray-600">Stay informed with the latest happenings</p>
            </div>
            <?php echo get_service_icon_svg('bell', 'text-primary-600 h-9 w-9') ?>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $news_query = new WP_Query(array(
              'post_type' => 'news',
              'posts_per_page' => 3,
            ));

            if ($news_query->have_posts()) {
              while ($news_query->have_posts()) {
                $news_query->the_post();
                render_post_card(get_post_card_args());
              }
              wp_reset_postdata();
            } else {
              echo '<p>No news articles found.</p>';
            }
            ?>
          </div>

          <div class="text-center mt-12">
            <a href="<?php echo esc_url(home_url('/news')); ?>"
              class="inline-flex items-center justify-center px-6 py-3 border border-blue-600 text-blue-600 hover:bg-blue-50 font-medium rounded-md transition-colors duration-300">
              View All News
              <?php echo get_service_icon_svg('arrow-right', 'ml-2 text-blue-600 w-5 h-5'); ?>
            </a>
          </div>
        </div>
      </section>

      <!-- Government Officials -->
      <section id="government" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Municipal Leadership</h2>
            <p class="text-lg text-gray-600">Meet our dedicated public servants</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <?php
            $executive_officials = new WP_Query([
              'post_type' => 'official',
              'posts_per_page' => 2,
              'orderby' => 'menu_order',
              'order' => 'ASC',
              'meta_query' => [
                [
                  'key' => 'official_type',
                  'value' => 'Executive Officials',
                  'compare' => '=',
                ]
              ],
            ]);

            if ($executive_officials->have_posts()) {
              while ($executive_officials->have_posts()) {
                $executive_officials->the_post();
                officialCard(['post_id' => get_the_ID()]);
              }
              wp_reset_postdata();
            } else {
              echo '<p class=" text-center col-span-full text-gray-500">No executive officials found.</p>';
            }
            ?>
          </div>
        </div>
      </section>

      <div class="text-center my-12">
        <a href="/government"
          class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 hover:bg-primary-500 text-white font-medium rounded-md transition-colors duration-300">
          View Local Government
          <?php echo get_service_icon_svg('arrow-right', 'ml-2 text-white w-5 h-5'); ?>
        </a>

      </div>


      <!-- Transparency Section -->
      <section id="transparency" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Transparency & Downloads</h2>
            <p class="text-lg text-gray-600">Access public documents and reports</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            // Query for documents
            $documents_query = new WP_Query([
              'post_type' => 'document',
              'posts_per_page' => 6,
              'orderby' => 'date',
              'order' => 'DESC',
              'meta_query' => [
                [
                  'key' => 'document_file',
                  'compare' => 'EXISTS'
                ]
              ]
            ]);

            if ($documents_query->have_posts()) {
              while ($documents_query->have_posts()) {
                $documents_query->the_post();

                // Get document data
                $document_file = get_field('document_file');
                $document_type = wp_get_post_terms(get_the_ID(), 'document_type');
                $type_name = !empty($document_type) ? $document_type[0]->name : 'Document';
                $document_number = get_field('document_number');
                $date_issued = get_field('document_date_issued');

                if ($document_file) {
                  $doc_data = [
                    'title' => $document_number ? $document_number . ' - ' . get_the_title() : get_the_title(),
                    'type' => $type_name,
                    'description' => get_the_excerpt(),
                    'fileType' => pathinfo($document_file['filename'], PATHINFO_EXTENSION),
                    'fileSize' => size_format($document_file['filesize'], 1),
                    'date' => $date_issued ? date('M j, Y', strtotime($date_issued)) : get_the_date('M j, Y'),
                    'downloadUrl' => $document_file['url'],
                    'showType' => true,
                    'showSize' => true
                  ];

                  // Use your existing doc-card template
                  get_template_part('template-parts/cards/doc-card', null, ['doc' => $doc_data]);
                }
              }
              wp_reset_postdata();
            } else {
              echo '<p class="col-span-full text-center text-gray-500">No documents found.</p>';
            }
            ?>
          </div>

          <div class="text-center mt-12">
            <a href="<?php echo esc_url(home_url('/documents')); ?>"
              class="inline-flex items-center justify-center px-6 py-3 border border-primary-600 text-primary-600 hover:bg-primary-50 font-medium rounded-md transition-colors duration-300">
              View All Documents
              <?php echo get_service_icon_svg('arrow-right', 'ml-2 text-primary-600 w-5 h-5'); ?>
            </a>
          </div>
        </div>
      </section>

    </div>
  </div>

</main>

<!-- Emergency Contacts -->
<section class="py-16 bg-red-600 text-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center">
      <h2 class="text-3xl font-bold mb-8">Emergency Contacts</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
          <h3 class="text-xl font-semibold mb-4">Police</h3>
          <p class="text-2xl font-bold text-white">117</p>
        </div>
        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
          <h3 class="text-xl font-semibold mb-4">Fire Department</h3>
          <p class="text-2xl font-bold text-white">116</p>
        </div>
        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
          <h3 class="text-xl font-semibold mb-4">Medical Emergency</h3>
          <p class="text-2xl font-bold text-white">911</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>