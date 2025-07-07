<?php
get_header();
?>

<div class="min-h-screen bg-gray-50">
  <?php get_template_part('template-parts/header'); ?>

  <?php get_template_part('template-parts/heroes/hero-section'); ?>

  <!-- Quick Actions -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Quick Actions</h2>
        <p class="text-lg text-gray-600">Common services and requests</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <a href="<?php echo esc_url(home_url('/pay-taxes')); ?>"
          class="h-20 text-left bg-secondary-600 hover:bg-secondary-500 transition-all duration-300 transform hover:scale-105 flex items-center px-6 rounded-md">
          <div>
            <div class="font-semibold text-white">Pay Taxes</div>
            <div class="text-sm opacity-90 text-white">Online payment</div>
          </div>
        </a>
        <a href="<?php echo esc_url(home_url('/apply-permit')); ?>"
          class="h-20 text-left bg-green-600 hover:bg-green-500 transition-all duration-300 transform hover:scale-105 flex items-center px-6 rounded-md">
          <div>
            <div class="font-semibold text-white">Apply Permit</div>
            <div class="text-sm opacity-90 text-white">Business license</div>
          </div>
        </a>
        <a href="<?php echo esc_url(home_url('/get-certificate')); ?>"
          class="h-20 text-left bg-purple-600 hover:bg-purple-500 transition-all duration-300 transform hover:scale-105 flex items-center px-6 rounded-md">
          <div>
            <div class="font-semibold text-white">Get Certificate</div>
            <div class="text-sm opacity-90 text-white">Civil documents</div>
          </div>
        </a>
        <a href="<?php echo esc_url(home_url('/report-issue')); ?>"
          class="h-20 text-left bg-orange-600 hover:bg-orange-500 transition-all duration-300 transform hover:scale-105 flex items-center px-6 rounded-md">
          <div>
            <div class="font-semibold text-white">Report Issue</div>
            <div class="text-sm opacity-90 text-white">Community concerns</div>
          </div>
        </a>
      </div>
    </div>
  </section>

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
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        class="lucide lucide-arrow-right ml-2 w-5 h-5">
        <path d="M5 12h14" />
        <path d="m12 5 7 7-7 7" />
      </svg>
    </a>
  </div>

  <!-- News & Announcements -->
  <section id="news" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between mb-12">
        <div>
          <h2 class="text-3xl font-bold text-gray-800 mb-4">Latest News & Updates</h2>
          <p class="text-lg text-gray-600">Stay informed with the latest happenings</p>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="lucide lucide-bell w-8 h-8 text-primary-600">
          <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
          <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
        </svg>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php
        $news_query = new WP_Query(array(
          'post_type' => 'post',
          'posts_per_page' => 3,
          'category_name' => 'news'
        ));

        if ($news_query->have_posts()) {
          while ($news_query->have_posts()) {
            $news_query->the_post();
            $views = get_post_meta(get_the_ID(), 'views', true) ?: 0;
            $categories = get_the_category();
            $category = !empty($categories) ? esc_html($categories[0]->name) : 'Uncategorized';

            echo '
            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-300">
              <div class="p-6">
                <div class="flex items-center text-sm text-gray-500 mb-2">
                  <span>' . esc_html($category) . '</span>
                  <span class="mx-2">•</span>
                  <span>' . get_the_date('F j, Y') . '</span>
                </div>
                <h3 class="text-xl font-semibold mb-3">' . get_the_title() . '</h3>
                <p class="text-gray-600 mb-4">' . wp_trim_excerpt(get_the_excerpt()) . '</p>
                <div class="flex items-center justify-between text-sm text-gray-500">
                  <span>' . esc_html($views) . ' views</span>
                  <a href="' . get_permalink() . '" class="text-secondary-600 hover:text-secondary-800">Read more</a>
                </div>
              </div>
            </div>';
          }
          wp_reset_postdata();
        } else {
          echo '<p>No news articles found.</p>';
        }
        ?>
      </div>

      <div class="text-center mt-12">
        <a href="<?php echo esc_url(home_url('/news')); ?>"
          class="inline-flex items-center justify-center px-6 py-3 border border-primary-600 text-primary-600 hover:bg-primary-50 font-medium rounded-md transition-colors duration-300">
          View All News
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-arrow-right ml-2 w-5 h-5">
            <path d="M5 12h14" />
            <path d="m12 5 7 7-7 7" />
          </svg>
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

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <?php
        $officials = array(
          array(
            'name' => 'Hon. Maria Santos',
            'position' => 'Municipal Mayor',
            'email' => 'mayor@pinabacdao.gov.ph',
            'phone' => '+63 (55) 123-4567'
          ),
          array(
            'name' => 'Hon. Juan Dela Cruz',
            'position' => 'Vice Mayor',
            'email' => 'vicemayor@pinabacdao.gov.ph',
            'phone' => '+63 (55) 123-4568'
          )
        );

        foreach ($officials as $official) {
          echo '
          <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 overflow-hidden">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full text-gray-400">
                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-1">' . esc_html($official['name']) . '</h3>
            <p class="text-secondary-600 font-medium mb-4">' . esc_html($official['position']) . '</p>
            <div class="text-gray-600 space-y-2">
              <p class="flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail mr-2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                ' . esc_html($official['email']) . '
              </p>
              <p class="flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone mr-2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                ' . esc_html($official['phone']) . '
              </p>
            </div>
          </div>';
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Projects Section -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between mb-12">
        <div>
          <h2 class="text-3xl font-bold text-gray-800 mb-4">Ongoing Projects</h2>
          <p class="text-lg text-gray-600">Building a better future together</p>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="lucide lucide-trending-up w-8 h-8 text-secondary-600">
          <polyline points="22 7 13.5 15.5 8.5 10.5 2 17" />
          <polyline points="16 7 22 7 22 13" />
        </svg>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <?php
        $projects = array(
          array(
            'title' => 'Municipal Hospital Expansion',
            'description' => 'Expansion of the municipal hospital to include new emergency department and specialized care units.',
            'status' => 'ongoing',
            'progress' => 75,
            'budget' => '₱50,000,000',
            'location' => 'Poblacion, Pinabacdao',
            'startDate' => 'Jan 2024',
            'endDate' => 'Dec 2024'
          ),
          array(
            'title' => 'Rural Road Network Improvement',
            'description' => 'Upgrading and paving of rural roads to improve transportation and economic opportunities.',
            'status' => 'ongoing',
            'progress' => 60,
            'budget' => '₱25,000,000',
            'location' => 'Various Barangays',
            'startDate' => 'Mar 2024',
            'endDate' => 'Jun 2025'
          )
        );

        foreach ($projects as $project) {
          echo '
          <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-300">
            <div class="p-6">
              <div class="flex justify-between items-start mb-4">
                <h3 class="text-xl font-semibold">' . esc_html($project['title']) . '</h3>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-100 text-primary-600">
                  ' . ucfirst($project['status']) . '
                </span>
              </div>
              <p class="text-gray-600 mb-6">' . esc_html($project['description']) . '</p>
              
              <div class="mb-4">
                <div class="flex justify-between text-sm text-gray-600 mb-1">
                  <span>Progress</span>
                  <span>' . esc_html($project['progress']) . '%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                  <div class="bg-primary h-2.5 rounded-full" style="width: ' . esc_attr($project['progress']) . '%"></div>
                </div>
              </div>
              
              <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                  <p class="text-gray-500">Budget</p>
                  <p class="font-medium">' . esc_html($project['budget']) . '</p>
                </div>
                <div>
                  <p class="text-gray-500">Location</p>
                  <p class="font-medium">' . esc_html($project['location']) . '</p>
                </div>
                <div>
                  <p class="text-gray-500">Start Date</p>
                  <p class="font-medium">' . esc_html($project['startDate']) . '</p>
                </div>
                <div>
                  <p class="text-gray-500">End Date</p>
                  <p class="font-medium">' . esc_html($project['endDate']) . '</p>
                </div>
              </div>
            </div>
          </div>';
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Transparency Section -->
  <section id="transparency" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Transparency & Downloads</h2>
        <p class="text-lg text-gray-600">Access public documents and reports</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php
        $documents = array(
          array(
            'title' => 'Annual Budget Report 2024',
            'description' => 'Comprehensive financial report outlining municipal budget allocation and expenditures.',
            'fileType' => 'PDF',
            'fileSize' => '2.5 MB',
            'uploadDate' => 'Dec 1, 2024',
            'category' => 'Budget'
          ),
          array(
            'title' => 'Business Permit Application Form',
            'description' => 'Official form for new business permit applications and renewals.',
            'fileType' => 'PDF',
            'fileSize' => '450 KB',
            'uploadDate' => 'Nov 28, 2024',
            'category' => 'Forms'
          )
        );

        foreach ($documents as $doc) {
          echo '
          <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="flex justify-between items-start mb-4">
              <div>
                <span class="inline-block px-3 py-1 text-xs font-semibold bg-secondary-100 text-secondary-800 rounded-full mb-2">
                  ' . esc_html($doc['category']) . '
                </span>
                <h3 class="text-lg font-semibold">' . esc_html($doc['title']) . '</h3>
              </div>
              <span class="inline-flex items-center px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded">
                ' . esc_html($doc['fileType']) . '
              </span>
            </div>
            <p class="text-gray-600 mb-4">' . esc_html($doc['description']) . '</p>
            <div class="flex justify-between items-center text-sm text-gray-500">
              <span>' . esc_html($doc['fileSize']) . ' • ' . esc_html($doc['uploadDate']) . '</span>
              <a href="#" class="text-secondary-600 hover:text-secondary-800 font-medium">Download</a>
            </div>
          </div>';
        }
        ?>
      </div>

      <div class="text-center mt-12">
        <a href="<?php echo esc_url(home_url('/documents')); ?>"
          class="inline-flex items-center justify-center px-6 py-3 border border-secondary-600 text-secondary-600 hover:bg-secondary-50 font-medium rounded-md transition-colors duration-300">
          View All Documents
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-arrow-right ml-2 w-5 h-5">
            <path d="M5 12h14" />
            <path d="m12 5 7 7-7 7" />
          </svg>
        </a>
      </div>
    </div>
  </section>

  <!-- Emergency Contacts -->
  <section class="py-16 bg-red-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <h2 class="text-3xl font-bold mb-8">Emergency Contacts</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
            <h3 class="text-xl font-semibold mb-4">Police</h3>
            <p class="text-2xl font-bold">117</p>
          </div>
          <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
            <h3 class="text-xl font-semibold mb-4">Fire Department</h3>
            <p class="text-2xl font-bold">116</p>
          </div>
          <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
            <h3 class="text-xl font-semibold mb-4">Medical Emergency</h3>
            <p class="text-2xl font-bold">911</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php get_footer(); ?>
</div>